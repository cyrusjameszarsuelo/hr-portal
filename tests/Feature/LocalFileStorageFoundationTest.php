<?php

namespace Tests\Feature;

use App\Http\Controllers\Concerns\HandlesFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Property-based tests for the pure logic of the local file storage foundation:
 * the HandlesFileUploads::storeUpload trait method and the section_asset() helper.
 *
 * Spec: .kiro/specs/local-file-storage
 *
 * Each property is implemented as a PHPUnit test that generates randomized inputs with
 * fakerphp/faker inside a loop of at least 100 iterations. Storage-side properties use
 * Storage::fake('public') so nothing touches the real filesystem, and uploads are built
 * with UploadedFile::fake(). Properties P4/P5 exercise the pure section_asset() helper.
 *
 * Covers tasks 2.1 (P1), 2.2 (P2), 2.3 (P3), 2.4 (P4), 2.5 (P5).
 */
class LocalFileStorageFoundationTest extends TestCase
{
    private const ITERATIONS = 100;

    /**
     * A random, plausible section name (slug-like, no slashes).
     */
    private function randomSection(\Faker\Generator $faker): string
    {
        // Faker slug/word both yield filesystem-safe, slash-free tokens.
        return $faker->boolean()
            ? Str::slug($faker->words(2, true))
            : $faker->word();
    }

    /**
     * Build a fresh upload host that exposes storeUpload() publicly.
     */
    private function uploadHost(): object
    {
        return new class {
            use HandlesFileUploads;

            public function store(UploadedFile $file, string $section, ?string $subfolder = null): string
            {
                return $this->storeUpload($file, $section, $subfolder);
            }
        };
    }

    /**
     * Build a random fake upload: usually an image, sometimes an mp4 video.
     */
    private function randomUpload(\Faker\Generator $faker): array
    {
        if ($faker->boolean(70)) {
            $ext = $faker->randomElement(['jpg', 'png', 'gif', 'jpeg']);

            return [UploadedFile::fake()->image('x.' . $ext), false];
        }

        // Video -> caller may route it to a 'videos' subfolder.
        $kb = $faker->numberBetween(10, 500);

        return [UploadedFile::fake()->create('v.mp4', $kb, 'video/mp4'), true];
    }

    // -----------------------------------------------------------------------------------
    // Property 1 (Task 2.1)
    // -----------------------------------------------------------------------------------

    // Feature: local-file-storage, Property 1: Uploads land under the section (and subfolder) path
    public function test_property_1_uploads_land_under_the_section_and_subfolder_path(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            // Fresh in-memory disk each iteration guarantees the target folder does not
            // previously exist, exercising Requirement 1.3 (auto-create before write).
            Storage::fake('public');
            $host = $this->uploadHost();

            $section = $this->randomSection($faker);
            [$file, $isVideo] = $this->randomUpload($faker);

            // A video is sometimes routed into a 'videos' subfolder (Req 1.6).
            $subfolder = ($isVideo && $faker->boolean()) ? 'videos' : null;

            $returned = $host->store($file, $section, $subfolder);

            $expectedPath = $section . ($subfolder ? '/' . $subfolder : '') . '/' . $returned;

            $this->assertTrue(
                Storage::disk('public')->exists($expectedPath),
                "Stored file must exist at $expectedPath (section=$section, subfolder="
                    . var_export($subfolder, true) . ", returned=$returned)."
            );
        }
    }

    // -----------------------------------------------------------------------------------
    // Property 2 (Task 2.2)
    // -----------------------------------------------------------------------------------

    // Feature: local-file-storage, Property 2: Stored reference is a bare filename
    public function test_property_2_stored_reference_is_a_bare_filename(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            Storage::fake('public');
            $host = $this->uploadHost();

            $section = $this->randomSection($faker);
            [$file, $isVideo] = $this->randomUpload($faker);
            $subfolder = ($isVideo && $faker->boolean()) ? 'videos' : null;

            $returned = $host->store($file, $section, $subfolder);

            $this->assertStringNotContainsString('/', $returned, 'Returned reference must not contain a forward slash.');
            $this->assertStringNotContainsString('\\', $returned, 'Returned reference must not contain a backslash.');
            $this->assertFalse(
                Str::startsWith($returned, 'http'),
                'Returned reference must not begin with http.'
            );
        }
    }

    // -----------------------------------------------------------------------------------
    // Property 3 (Task 2.3)
    // -----------------------------------------------------------------------------------

    // Feature: local-file-storage, Property 3: Generated filenames are unique within a section
    public function test_property_3_generated_filenames_are_unique_within_a_section(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            Storage::fake('public');
            $host = $this->uploadHost();

            $section = $this->randomSection($faker);

            // Store many files into the same section within one run. Because filenames use
            // time().'_'.Str::random(8).'.'.ext, many-per-second stresses the Str::random(8)
            // uniqueness (time() alone would collide within the same second).
            $batch = $faker->numberBetween(20, 40);
            $names = [];
            for ($n = 0; $n < $batch; $n++) {
                $names[] = $host->store(UploadedFile::fake()->image('x.jpg'), $section);
            }

            $this->assertSame(
                count($names),
                count(array_unique($names)),
                "Filenames within section '$section' must be pairwise distinct (batch=$batch)."
            );
        }
    }

    // -----------------------------------------------------------------------------------
    // Property 4 (Task 2.4)
    // -----------------------------------------------------------------------------------

    // Feature: local-file-storage, Property 4: Filenames render to the storage URL
    public function test_property_4_filenames_render_to_the_storage_url(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            $section = $this->randomSection($faker);
            $subfolder = $faker->boolean() ? $this->randomSection($faker) : null;

            // A non-empty filename that does NOT start with http.
            do {
                $value = $faker->boolean()
                    ? time() . '_' . Str::random(8) . '.' . $faker->randomElement(['jpg', 'png', 'mp4'])
                    : $faker->word() . '.' . $faker->randomElement(['jpg', 'png', 'mp4']);
            } while ($value === '' || Str::startsWith($value, 'http'));

            $expected = asset('storage/' . $section . ($subfolder ? '/' . $subfolder : '') . '/' . $value);

            $this->assertSame(
                $expected,
                section_asset($value, $section, $subfolder),
                "section_asset must build the storage URL for filename '$value'."
            );
        }
    }

    // -----------------------------------------------------------------------------------
    // Property 5 (Task 2.5)
    // -----------------------------------------------------------------------------------

    // Feature: local-file-storage, Property 5: Legacy http values pass through unchanged
    public function test_property_5_legacy_http_values_pass_through_unchanged(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < self::ITERATIONS; $i++) {
            $section = $this->randomSection($faker);
            $subfolder = $faker->boolean() ? $this->randomSection($faker) : null;

            // A URL beginning with http or https (legacy Cloudinary-style value).
            $scheme = $faker->randomElement(['http', 'https']);
            $url = $scheme . '://' . $faker->domainName() . '/' . $faker->slug() . '.'
                . $faker->randomElement(['jpg', 'png', 'mp4']);

            $this->assertSame(
                $url,
                section_asset($url, $section, $subfolder),
                "section_asset must return legacy http value unchanged: $url"
            );
        }
    }
}
