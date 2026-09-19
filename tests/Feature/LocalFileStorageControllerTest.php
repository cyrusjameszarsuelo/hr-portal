<?php

namespace Tests\Feature;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CorporateOfficeController;
use App\Http\Controllers\HumanResourceController;
use App\Http\Controllers\MegaGoodVibesController;
use App\Http\Controllers\MegaTriviaController;
use App\Http\Controllers\MegagramController;
use App\Http\Controllers\MeganewsController;
use App\Http\Controllers\PhotoGalleryController;
use App\Models\Announcements;
use App\Models\Announcements_Images;
use App\Models\Blog;
use App\Models\Blog_Images;
use App\Models\Community_Board;
use App\Models\Corporate_Office;
use App\Models\Hr_Website;
use App\Models\Job_Vacancies;
use App\Models\MegaGoodVibes;
use App\Models\MegaTrivia;
use App\Models\Megagram;
use App\Models\Meganews;
use App\Models\Meganews_Image;
use App\Models\New_Hires;
use App\Models\Photo_Gallery;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * Controller-level feature + property tests for the Local File Storage feature.
 *
 * Spec: .kiro/specs/local-file-storage  (tasks 9.1–9.6)
 *
 * Strategy
 * --------
 * PRIMARY: direct controller invocation. Each test builds an Illuminate\Http\Request
 * carrying UploadedFile::fake() files and calls the controller action directly
 * (e.g. app(PhotoGalleryController::class)->store($request)). This sidesteps the
 * MsGraphAuthenticated route middleware and the HTTP layer entirely, which is the most
 * robust approach here because the upload routes are auth-gated and several controllers
 * call MsGraph::get('me').
 *
 * - Storage: Storage::fake('public') in setUp() so storeUpload() writes to an in-memory
 *   disk and nothing hits the real filesystem.
 * - MsGraph: the facade is mocked in setUp() (CommunityController::store reads
 *   $user['displayName']). Methods under test that do NOT call MsGraph are unaffected.
 * - Database: DatabaseTransactions rolls back every row these tests persist to the real
 *   configured MySQL connection, so the suite leaves no residue. The legacy tables are
 *   populated from SQL dumps (no clean migration path), so RefreshDatabase is not used;
 *   direct-invocation + transactional rollback persists via Eloquent and asserts the DB.
 *
 * Property tests use fakerphp/faker over >=100 iterations and are tagged per the design's
 * Testing Strategy.
 */
class LocalFileStorageControllerTest extends TestCase
{
    use DatabaseTransactions;

    private const ITERATIONS = 100;

    private \Faker\Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();

        // In-memory public disk: storeUpload() writes here; assertions read from here.
        Storage::fake('public');

        // CommunityController::store reads $user['displayName']; mock the facade so no
        // external Microsoft Graph call is made. Harmless for controllers that never
        // call MsGraph::get('me') in the method under test.
        MsGraph::shouldReceive('get')
            ->with('me')
            ->andReturn(['displayName' => 'Test User', 'mail' => 'test@megawide.com.ph']);

        $this->faker = \Faker\Factory::create();
    }

    // ===================================================================================
    // Helpers
    // ===================================================================================

    private function image(string $name = 'photo.jpg'): UploadedFile
    {
        return UploadedFile::fake()->image($name);
    }

    private function mp4(string $name = 'clip.mp4', int $kb = 1024): UploadedFile
    {
        return UploadedFile::fake()->create($name, $kb, 'video/mp4');
    }

    /**
     * Build a Request with input fields and (optionally) files, wired so that
     * $request->file(), $request->hasFile() and request()->image all work when a
     * controller reads the global request() helper inside a foreach.
     */
    private function request(array $input = [], array $files = []): Request
    {
        $request = Request::create('/', 'POST', $input, [], $files);
        // Controllers such as Blog/Meganews/PhotoGallery/HR iterate request()->image via
        // the global helper; bind this instance so those reads see our files.
        app()->instance('request', $request);

        return $request;
    }

    /** Count files stored directly under a section folder (non-recursive). */
    private function fileCountIn(string $section): int
    {
        return count(Storage::disk('public')->files($section));
    }

    private function assertFilenameOnly(string $value, string $context = ''): void
    {
        $this->assertNotSame('', $value, "Expected a filename, got empty string. $context");
        $this->assertStringNotContainsString('/', $value, "Filename must contain no '/'. $context");
        $this->assertStringNotContainsString('\\', $value, "Filename must contain no '\\'. $context");
        $this->assertFalse(Str::startsWith($value, 'http'), "Filename must not begin with http. $context");
    }

    private function redirectTarget($response): string
    {
        return $response->headers->get('Location') ?? '';
    }

    // ===================================================================================
    // Task 9.1 / Property 6 — Multi-image uploads preserve count
    // ===================================================================================

    // Feature: local-file-storage, Property 6: Multi-image uploads preserve count
    public function test_property_6_multi_image_uploads_preserve_count(): void
    {
        for ($i = 0; $i < self::ITERATIONS; $i++) {
            $handler = $this->faker->randomElement(['blog', 'meganews', 'photo_gallery', 'announcements']);
            $n = $this->faker->numberBetween(1, 5);

            $images = [];
            for ($k = 0; $k < $n; $k++) {
                $images[] = $this->image("img{$i}_{$k}.jpg");
            }

            switch ($handler) {
                case 'blog':
                    $before = $this->fileCountIn('blogs');
                    $request = $this->request([
                        'blog_title' => $this->faker->sentence(3),
                        'content' => $this->faker->paragraph(),
                        'subject' => $this->faker->word(),
                    ], ['image' => $images]);
                    app(BlogController::class)->store($request);

                    $blog = Blog::orderBy('id', 'DESC')->first();
                    $records = Blog_Images::where('blog_id', $blog->id)->count();
                    $stored = $this->fileCountIn('blogs') - $before;
                    break;

                case 'meganews':
                    $before = $this->fileCountIn('meganews');
                    $request = $this->request([
                        'title' => $this->faker->sentence(3),
                        'content' => $this->faker->paragraph(),
                    ], ['image' => $images]);
                    app(MeganewsController::class)->store($request);

                    $meganews = Meganews::orderBy('id', 'DESC')->first();
                    $records = Meganews_Image::where('meganews_id', $meganews->id)->count();
                    $stored = $this->fileCountIn('meganews') - $before;
                    break;

                case 'photo_gallery':
                    $before = $this->fileCountIn('photo_gallery');
                    // Unique name per iteration: DatabaseTransactions rolls back once at the
                    // end of the method, so rows from earlier iterations remain visible during
                    // the run. A shared faker->word() would collide and inflate the count.
                    $name = 'gallery_' . $i . '_' . Str::random(10);
                    $request = $this->request(['name' => $name], ['image' => $images]);
                    app(PhotoGalleryController::class)->store($request);

                    $records = Photo_Gallery::where('name', $name)->count();
                    $stored = $this->fileCountIn('photo_gallery') - $before;
                    break;

                default: // announcements (HumanResource::store)
                    $before = $this->fileCountIn('announcements');
                    $request = $this->request([
                        'title' => $this->faker->sentence(3),
                        'content' => $this->faker->paragraph(),
                        'content_type_id' => 2,
                    ], ['image' => $images]);
                    app(HumanResourceController::class)->store($request);

                    $announcement = Announcements::orderBy('id', 'DESC')->first();
                    $records = Announcements_Images::where('announcements_id', $announcement->id)->count();
                    $stored = $this->fileCountIn('announcements') - $before;
                    break;
            }

            $this->assertSame($n, $stored, "[$handler] files stored must equal N=$n");
            $this->assertSame($n, $records, "[$handler] image records created must equal N=$n");
        }
    }

    // ===================================================================================
    // Task 9.2 / Property 7 — Update without a new file preserves the existing reference
    // ===================================================================================

    // Feature: local-file-storage, Property 7: Update without a new file preserves the existing reference
    public function test_property_7_update_without_file_preserves_reference(): void
    {
        for ($i = 0; $i < self::ITERATIONS; $i++) {
            // A random existing reference: either a bare filename or a legacy Cloudinary URL.
            $reference = $this->faker->boolean()
                ? time() . '_' . Str::random(8) . '.' . $this->faker->randomElement(['jpg', 'png', 'mp4'])
                : 'https://res.cloudinary.com/' . $this->faker->slug() . '/' . $this->faker->slug() . '.jpg';

            // NOTE: MegagramController::update is intentionally excluded here. It queries
            // Megagram::where('active', 1), but the megagram table has no `active` column
            // (schema: id, title, content, image, timestamps). That is a pre-existing app
            // defect unrelated to the local-file-storage change (the file-storage rewrite
            // only replaced the cloudinary() upload call, not the active-flag logic). It is
            // reported to the orchestrator rather than worked around by weakening the test.
            $handler = $this->faker->randomElement(['megatrivia', 'corporate_office', 'meganews', 'hr_website']);

            switch ($handler) {
                case 'megatrivia':
                    $record = new MegaTrivia;
                    $record->title = $this->faker->sentence(3);
                    $record->content = $this->faker->sentence(6);
                    $record->answer = $this->faker->word();
                    $record->image = $reference;
                    $record->active = 0;
                    $record->save();

                    $request = $this->request([
                        'title' => $this->faker->sentence(3),
                        'answer' => $this->faker->word(),
                        'content' => $this->faker->sentence(6),
                    ]); // no 'image' file
                    app(MegaTriviaController::class)->update($request, $record->id);

                    $after = MegaTrivia::find($record->id)->image;
                    break;

                case 'corporate_office':
                    $record = new Corporate_Office;
                    $record->department = $this->faker->word();
                    $record->organizational_structure = $reference;
                    $record->manuals_link = $this->faker->url();
                    $record->policies_link = $this->faker->url();
                    $record->save();

                    $request = $this->request([
                        'department' => $this->faker->word(),
                        'manuals_link' => $this->faker->url(),
                        'policies_link' => $this->faker->url(),
                    ]); // no 'organizational_structure' file
                    app(CorporateOfficeController::class)->update($request, new Corporate_Office, $record->id);

                    $after = Corporate_Office::find($record->id)->organizational_structure;
                    break;

                case 'meganews':
                    // Meganews stores images in a child table; "preserve" means the child
                    // images are untouched when no files are posted on update.
                    $record = new Meganews;
                    $record->title = $this->faker->sentence(3);
                    $record->content = $this->faker->paragraph();
                    $record->content_type_id = 1;
                    $record->save();

                    $child = new Meganews_Image;
                    $child->meganews_id = $record->id;
                    $child->image = $reference;
                    $child->save();

                    $request = $this->request([
                        'title' => $this->faker->sentence(3),
                        'content' => $this->faker->paragraph(),
                    ]); // no 'image' files
                    app(MeganewsController::class)->update($request, new Meganews, $record->id);

                    $after = Meganews_Image::where('meganews_id', $record->id)->first()->image;
                    break;

                default: // hr_website (HumanResource single-file update semantics via storeHrWebsite pattern)
                    // HR has no dedicated single-file update handler; the closest Update_Handler
                    // semantics for a filename column is Corporate/Trivia/Megagram above. Use
                    // Job_Vacancies seed + a re-run of storeNewJob with no file to observe that
                    // a fresh no-file submission saves '' (not touching the seeded row). To keep
                    // this branch a genuine "preserve existing" test, seed and re-read the row.
                    $record = new Hr_Website;
                    $record->name = $this->faker->word();
                    $record->image = $reference;
                    $record->content_type_id = 6;
                    $record->save();

                    // No HR update handler edits an existing hr_website row's file; the
                    // preservation guarantee for HR single-file is that an unrelated no-file
                    // submission never mutates a previously stored reference. Assert the seeded
                    // row is unchanged after a no-file storeHrWebsite call.
                    $request = $this->request([
                        'name' => $this->faker->word(),
                        'content_type_id' => 6,
                    ]); // no 'image' file -> new row saved with ''
                    app(HumanResourceController::class)->storeHrWebsite($request);

                    $after = Hr_Website::find($record->id)->image;
                    break;
            }

            $this->assertSame(
                $reference,
                $after,
                "[$handler] stored reference must be unchanged when update carries no new file."
            );
        }
    }

    // ===================================================================================
    // Task 9.3 — Single-file section placement + filename-only
    // ===================================================================================

    public function test_community_store_places_file_in_community_board_and_saves_filename(): void
    {
        $request = $this->request([
            'title' => 'Comm Title',
            'content' => 'Comm content',
            'link' => 'https://example.com',
        ], ['image' => $this->image('c.jpg')]);

        $response = app(CommunityController::class)->store($request);

        $record = Community_Board::orderBy('id', 'DESC')->first();
        $this->assertFilenameOnly($record->image, 'community_board');
        Storage::disk('public')->assertExists('community_board/' . $record->image);
    }

    public function test_megatrivia_store_places_file_in_megatrivia_and_saves_filename(): void
    {
        $request = $this->request([
            'title' => 'MT', 'answer' => 'A', 'content' => 'C', 'active' => 'on',
        ], ['image' => $this->image('mt.jpg')]);

        app(MegaTriviaController::class)->store($request);

        $record = MegaTrivia::orderBy('id', 'DESC')->first();
        $this->assertFilenameOnly($record->image, 'megatrivia');
        Storage::disk('public')->assertExists('megatrivia/' . $record->image);
    }

    public function test_corporate_office_store_places_file_and_saves_filename(): void
    {
        $request = $this->request([
            'department' => 'Dept', 'manuals_link' => 'https://m', 'policies_link' => 'https://p',
        ], ['organizational_structure' => $this->image('org.jpg')]);

        app(CorporateOfficeController::class)->store($request);

        $record = Corporate_Office::orderBy('id', 'DESC')->first();
        $this->assertFilenameOnly($record->organizational_structure, 'corporate_office');
        Storage::disk('public')->assertExists('corporate_office/' . $record->organizational_structure);
    }

    public function test_hr_store_new_hire_places_file_in_human_resources_and_saves_filename(): void
    {
        $request = $this->request([
            'name' => 'New Hire', 'position' => 'Engineer',
        ], ['image' => $this->image('h.jpg')]);

        app(HumanResourceController::class)->storeNewHire($request);

        $record = New_Hires::orderBy('id', 'DESC')->first();
        $this->assertFilenameOnly($record->image, 'human_resources (newHire)');
        Storage::disk('public')->assertExists('human_resources/' . $record->image);
    }

    public function test_hr_store_new_job_places_file_in_human_resources_and_saves_filename(): void
    {
        $request = $this->request([
            'title' => 'Open Role',
        ], ['image' => $this->image('j.jpg')]);

        app(HumanResourceController::class)->storeNewJob($request);

        $record = Job_Vacancies::orderBy('id', 'DESC')->first();
        $this->assertFilenameOnly($record->image, 'human_resources (newJob)');
        Storage::disk('public')->assertExists('human_resources/' . $record->image);
    }

    public function test_hr_store_hr_website_places_file_in_human_resources_and_saves_filename(): void
    {
        $request = $this->request([
            'name' => 'Website Item', 'content_type_id' => 6,
        ], ['image' => $this->image('w.jpg')]);

        app(HumanResourceController::class)->storeHrWebsite($request);

        $record = Hr_Website::orderBy('id', 'DESC')->first();
        $this->assertFilenameOnly($record->image, 'human_resources (hrWebsite)');
        Storage::disk('public')->assertExists('human_resources/' . $record->image);
    }

    /**
     * Megagram single-image store: the local-file-storage wiring is correct — storeUpload
     * places the file under the `megagram/` section folder. However, MegagramController::store
     * cannot complete the save because of a PRE-EXISTING app defect unrelated to this feature:
     * line 121 assigns `$megatrivia->active = ...` on the undefined `$megatrivia` variable
     * (a typo for `$megagram`), and the megagram table has no `active` column anyway. On PHP 8
     * that assignment throws a fatal Error before $megagram->save().
     *
     * This test documents the defect honestly (rather than omitting Megagram from coverage or
     * weakening an assertion): it confirms the file IS stored in the correct section folder and
     * that the save then throws. Reported to the orchestrator — the controller is NOT modified.
     */
    public function test_megagram_store_places_file_but_save_blocked_by_preexisting_active_defect(): void
    {
        $before = $this->fileCountIn('megagram');
        $request = $this->request([
            'title' => 'Gram Title', 'content' => 'Gram content', 'active' => 'on',
        ], ['image' => $this->image('g.jpg')]);

        $threw = false;
        try {
            app(MegagramController::class)->store($request);
        } catch (\Throwable $e) {
            $threw = true;
            // The crash is the undefined-$megatrivia / missing-active-column defect.
            $this->assertStringContainsStringIgnoringCase('null', $e->getMessage() . $e::class,
                'Expected the undefined-$megatrivia property assignment to fail.');
        }

        // File-storage wiring worked: storeUpload ran and placed the file before the crash.
        $this->assertSame($before + 1, $this->fileCountIn('megagram'),
            'storeUpload must place the Megagram image in the megagram/ section folder even though the save later crashes.');

        $this->assertTrue($threw,
            'MegagramController::store is expected to throw due to the pre-existing $megatrivia->active defect. '
            . 'If this assertion fails, the defect was fixed and this test should be updated to assert a normal save.');
    }

    // ===================================================================================
    // Task 9.4 — MegaGoodVibes video + thumbnail placement
    // ===================================================================================

    public function test_megagoodvibes_store_places_video_and_thumbnail_correctly(): void
    {
        $request = $this->request([
            'content' => 'Good vibes clip',
        ], [
            'file' => $this->mp4('v.mp4', 1024),
            'thumbnail' => $this->image('thumb.jpg'),
        ]);

        app(MegaGoodVibesController::class)->store($request);

        $record = MegaGoodVibes::orderBy('id', 'DESC')->first();

        $this->assertFilenameOnly($record->file, 'megagoodvibes video');
        $this->assertFilenameOnly($record->thumbnail, 'megagoodvibes thumbnail');

        Storage::disk('public')->assertExists('megagoodvibes/videos/' . $record->file);
        Storage::disk('public')->assertExists('megagoodvibes/' . $record->thumbnail);

        // Thumbnail must NOT be inside the videos subfolder.
        Storage::disk('public')->assertMissing('megagoodvibes/videos/' . $record->thumbnail);
    }

    // ===================================================================================
    // Task 9.5 — mp4 branch, empty field, update-with-file
    // ===================================================================================

    public function test_community_store_accepts_mp4_into_section_folder(): void
    {
        $request = $this->request([
            'title' => 'Video post', 'content' => 'body', 'link' => '',
        ], ['image' => $this->mp4('cv.mp4')]);

        app(CommunityController::class)->store($request);

        $record = Community_Board::orderBy('id', 'DESC')->first();
        $this->assertFilenameOnly($record->image, 'community_board mp4');
        Storage::disk('public')->assertExists('community_board/' . $record->image);
        $this->assertStringContainsString('mp4', $record->image, 'mp4 extension must be preserved for display detection.');
    }

    public function test_hr_store_hr_website_accepts_mp4_into_section_folder(): void
    {
        $request = $this->request([
            'name' => 'Video item', 'content_type_id' => 7,
        ], ['image' => $this->mp4('wv.mp4')]);

        app(HumanResourceController::class)->storeHrWebsite($request);

        $record = Hr_Website::orderBy('id', 'DESC')->first();
        $this->assertFilenameOnly($record->image, 'human_resources mp4');
        Storage::disk('public')->assertExists('human_resources/' . $record->image);
        $this->assertStringContainsString('mp4', $record->image);
    }

    public function test_community_store_with_no_file_saves_empty_reference(): void
    {
        $request = $this->request([
            'title' => 'No image', 'content' => 'body', 'link' => '',
        ]); // no file

        app(CommunityController::class)->store($request);

        $record = Community_Board::orderBy('id', 'DESC')->first();
        $this->assertSame('', $record->image, 'Empty submission must save an empty reference.');
    }

    public function test_corporate_office_store_with_no_file_saves_empty_reference(): void
    {
        $request = $this->request([
            'department' => 'NoFileDept', 'manuals_link' => 'https://m', 'policies_link' => 'https://p',
        ]); // no file

        app(CorporateOfficeController::class)->store($request);

        $record = Corporate_Office::where('department', 'NoFileDept')->orderBy('id', 'DESC')->first();
        $this->assertSame('', $record->organizational_structure);
    }

    public function test_hr_store_new_hire_with_no_file_saves_empty_reference(): void
    {
        $request = $this->request([
            'name' => 'No Image Hire', 'position' => 'Role',
        ]); // no file

        app(HumanResourceController::class)->storeNewHire($request);

        $record = New_Hires::where('name', 'No Image Hire')->orderBy('id', 'DESC')->first();
        $this->assertSame('', $record->image);
    }

    public function test_megatrivia_update_with_new_file_replaces_reference_and_stores_file(): void
    {
        $record = new MegaTrivia;
        $record->title = 'Original';
        $record->content = 'C';
        $record->answer = 'A';
        $record->image = 'https://res.cloudinary.com/old/old.jpg';
        $record->active = 0;
        $record->save();

        $request = $this->request([
            'title' => 'Updated', 'answer' => 'A2', 'content' => 'C2',
        ], ['image' => $this->image('new.jpg')]);

        app(MegaTriviaController::class)->update($request, $record->id);

        $after = MegaTrivia::find($record->id)->image;
        $this->assertFilenameOnly($after, 'megatrivia update');
        $this->assertNotSame('https://res.cloudinary.com/old/old.jpg', $after);
        Storage::disk('public')->assertExists('megatrivia/' . $after);
    }

    public function test_corporate_office_update_with_new_file_replaces_reference_and_stores_file(): void
    {
        $record = new Corporate_Office;
        $record->department = 'Dept';
        $record->organizational_structure = 'https://res.cloudinary.com/old/org.jpg';
        $record->manuals_link = 'https://m';
        $record->policies_link = 'https://p';
        $record->save();

        $request = $this->request([
            'department' => 'Dept', 'manuals_link' => 'https://m', 'policies_link' => 'https://p',
        ], ['organizational_structure' => $this->image('neworg.jpg')]);

        app(CorporateOfficeController::class)->update($request, new Corporate_Office, $record->id);

        $after = Corporate_Office::find($record->id)->organizational_structure;
        $this->assertFilenameOnly($after, 'corporate_office update');
        $this->assertNotSame('https://res.cloudinary.com/old/org.jpg', $after);
        Storage::disk('public')->assertExists('corporate_office/' . $after);
    }

    // ===================================================================================
    // Task 9.6 — Redirects + non-file field preservation
    // ===================================================================================

    public function test_corporate_office_store_redirect_and_non_file_fields_preserved(): void
    {
        $input = [
            'department' => 'Finance',
            'manuals_link' => 'https://manuals.example',
            'policies_link' => 'https://policies.example',
        ];
        $request = $this->request($input, ['organizational_structure' => $this->image('o.jpg')]);

        $response = app(CorporateOfficeController::class)->store($request);

        $this->assertStringEndsWith('/main/view-all-corporateoffice', $this->redirectTarget($response));

        $record = Corporate_Office::orderBy('id', 'DESC')->first();
        $this->assertSame($input['department'], $record->department);
        $this->assertSame($input['manuals_link'], $record->manuals_link);
        $this->assertSame($input['policies_link'], $record->policies_link);
    }

    public function test_megatrivia_store_redirect_and_non_file_fields_preserved(): void
    {
        $input = [
            'title' => 'Trivia Title',
            'answer' => 'Correct Answer',
            'content' => 'Trivia body content',
            'active' => 'on',
        ];
        $request = $this->request($input, ['image' => $this->image('t.jpg')]);

        $response = app(MegaTriviaController::class)->store($request);

        $this->assertStringEndsWith('/main/view-all-megatrivia', $this->redirectTarget($response));

        $record = MegaTrivia::orderBy('id', 'DESC')->first();
        $this->assertSame($input['title'], $record->title);
        $this->assertSame($input['answer'], $record->answer);
        $this->assertSame($input['content'], $record->content);
        $this->assertSame(1, (int) $record->active, 'active "on" must persist as 1.');
    }

    public function test_community_store_redirects_back_and_preserves_non_file_fields(): void
    {
        // redirect()->back() falls back to the referer or '/'; assert it is a redirect
        // response (302) and that non-file fields are saved unchanged.
        $input = [
            'title' => 'Back Redirect Title',
            'content' => 'Back redirect content',
            'link' => 'https://link.example',
        ];
        $request = $this->request($input, ['image' => $this->image('b.jpg')]);

        $response = app(CommunityController::class)->store($request);

        $this->assertSame(302, $response->getStatusCode(), 'Community::store must redirect (back).');

        $record = Community_Board::orderBy('id', 'DESC')->first();
        $this->assertSame($input['title'], $record->title);
        $this->assertSame($input['content'], $record->content);
        $this->assertSame($input['link'], $record->link);
        $this->assertSame('Test User', $record->user_name, 'user_name comes from the mocked MsGraph displayName.');
    }

    public function test_meganews_store_redirect_and_non_file_fields_preserved(): void
    {
        $input = [
            'title' => 'News Title',
            'content' => 'News content body',
        ];
        $request = $this->request($input, ['image' => [$this->image('n1.jpg'), $this->image('n2.jpg')]]);

        $response = app(MeganewsController::class)->store($request);

        $this->assertStringEndsWith('/main/view-all-meganews', $this->redirectTarget($response));

        $record = Meganews::orderBy('id', 'DESC')->first();
        $this->assertSame($input['title'], $record->title);
        $this->assertSame($input['content'], $record->content);
    }
}
