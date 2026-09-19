# Implementation Plan: Local File Storage

## Overview

This plan replaces Cloudinary uploads with local storage on Laravel's `public` disk. It builds
the two foundational pieces first (the `HandlesFileUploads` trait and the `section_asset()`
helper), proves their pure logic with property-based tests, then rewires each controller's upload
path, updates the display views, and finishes with property/preservation and example feature tests
plus a checkpoint.

Implementation language is **PHP / Laravel 9** (matching the existing codebase and the design's
concrete code). The design includes a Correctness Properties section (P1–P7), so property-based
tests are included as sub-tasks, implemented as PHPUnit loops with `fakerphp/faker` and
`UploadedFile::fake()` over `Storage::fake('public')`, ≥100 iterations each.

No application code is implemented as part of authoring this plan; the tasks below describe the
work to be executed later.

## Tasks

- [x] 1. Build storage foundation (trait, helper, autoload, symlink)
  - [x] 1.1 Create the `HandlesFileUploads` trait
    - Create `app/Http/Controllers/Concerns/HandlesFileUploads.php` in namespace
      `App\Http\Controllers\Concerns`.
    - Implement `protected function storeUpload(UploadedFile $file, string $section, ?string $subfolder = null): string`
      per design §Components 1: build filename `time().'_'.Str::random(8).'.'.$ext` where
      `$ext = $file->getClientOriginalExtension() ?: $file->guessExtension() ?: 'bin'`; build
      `$dir = $section.($subfolder ? '/'.$subfolder : '')`; call `$file->storeAs($dir, $filename, 'public')`
      (auto-creates the folder); return the filename only (no path, no URL).
    - _Requirements: 1.1, 1.2, 1.3, 1.4, 1.6, 2.1, 2.2_
    - _Properties: P1, P2, P3_

  - [x] 1.2 Create the `section_asset()` helper and register autoload
    - Create `app/helpers.php` with `function section_asset(?string $value, string $section, ?string $subfolder = null): string`
      per design §Components 2: return `''` when empty; return `$value` unchanged when it begins
      with `http` (use `Str::startsWith($value, 'http')` for PHP 7.4 portability); otherwise return
      `asset('storage/'.$section.($subfolder ? '/'.$subfolder : '').'/'.$value)`.
    - Add `"files": ["app/helpers.php"]` to the `autoload` block in `composer.json`, then run
      `composer dump-autoload` so the helper is registered.
    - _Requirements: 5.1, 5.2, 6.1, 6.2, 6.3_
    - _Properties: P4, P5_

  - [x] 1.3 Ensure the `public/storage` symlink exists
    - Verify `public/storage` resolves to `storage/app/public`; if absent, run
      `php artisan storage:link` to create it (already wired into composer `post-install-cmd`).
    - _Requirements: 5.3_

- [x] 2. Write property tests for the pure logic (trait + helper)
  - [x] 2.1 Property test P1 — uploads land under the section (and subfolder) path
    - PHPUnit test using `Storage::fake('public')` and Faker random section (+ sometimes a
      `videos` subfolder) with `UploadedFile::fake()->image()` / `->create('v.mp4', $kb, 'video/mp4')`;
      call `storeUpload` and assert `Storage::disk('public')->exists("$section[/videos]/$returned")`,
      including when the folder did not previously exist. ≥100 iterations.
    - Tag: `// Feature: local-file-storage, Property 1: Uploads land under the section (and subfolder) path`
    - _Requirements: 1.1, 1.2, 1.3, 1.6_
    - _Properties: P1_

  - [x] 2.2 Property test P2 — stored reference is a bare filename
    - For each generated upload assert the returned value contains no `/` and no `\\`, and does not
      begin with `http`. ≥100 iterations over `Storage::fake('public')`.
    - Tag: `// Feature: local-file-storage, Property 2: Stored reference is a bare filename`
    - _Requirements: 2.1, 2.2_
    - _Properties: P2_

  - [x] 2.3 Property test P3 — generated filenames are unique within a section
    - Store many files into one section; collect returned names; assert
      `count(array_unique($names)) === count($names)`. ≥100 iterations.
    - Tag: `// Feature: local-file-storage, Property 3: Generated filenames are unique within a section`
    - _Requirements: 1.4_
    - _Properties: P3_

  - [x] 2.4 Property test P4 — filenames render to the storage URL
    - Faker random non-empty filename (no `http` prefix) + random section/optional subfolder;
      assert `section_asset(...)` equals `asset('storage/'.$section.($subfolder ? '/'.$subfolder : '').'/'.$value)`.
      ≥100 iterations.
    - Tag: `// Feature: local-file-storage, Property 4: Filenames render to the storage URL`
    - _Requirements: 5.1, 5.2, 6.2_
    - _Properties: P4_

  - [x] 2.5 Property test P5 — legacy `http` values pass through unchanged
    - Faker random URL prefixed `http`/`https`; assert `section_asset($url, $section, $subfolder) === $url`
      for random sections/subfolders. ≥100 iterations.
    - Tag: `// Feature: local-file-storage, Property 5: Legacy http values pass through unchanged`
    - _Requirements: 6.1, 6.3, 7.2_
    - _Properties: P5_

- [x] 3. Checkpoint - foundation verified
  - Run `php artisan test` for the P1–P5 property tests; ensure all pass. Ask the user if
    questions arise.

- [x] 4. Rewire single-image / single-file controllers
  - [x] 4.1 CommunityController::store
    - Add `use HandlesFileUploads;`. Replace the mime-branch `cloudinary()->upload/uploadVideo`
      with `$request->hasFile('image') ? $this->storeUpload($request->file('image'), 'community_board') : ''`
      (one call handles image or mp4). Keep the post-save redirect and all non-file fields unchanged.
    - _Requirements: 3.1, 3.3, 3.5, 4.1, 7.1, 8.1, 8.2_

  - [x] 4.2 MegaTriviaController::store and ::update
    - Add `use HandlesFileUploads;`. `store`: replace unconditional `cloudinary()->upload` with
      `$this->storeUpload($request->file('image'), 'megatrivia')`. `update`: inside the existing
      `if ($request->file('image'))` guard, replace with `$this->storeUpload($request->file('image'), 'megatrivia')`;
      leave the column untouched when no file. Redirects and non-file fields unchanged.
    - _Requirements: 3.1, 4.1, 4.2, 7.1, 8.1, 8.2_

  - [x] 4.3 MegagramController::store and ::update
    - Add `use HandlesFileUploads;`. `store`: replace unconditional upload with
      `$this->storeUpload($request->file('image'), 'megagram')`. `update`: inside the existing
      `if ($request->file('image'))` guard, replace with `$this->storeUpload($request->file('image'), 'megagram')`;
      column retained when no file. Redirects and non-file fields unchanged.
    - _Requirements: 3.1, 4.1, 4.2, 7.1, 8.1, 8.2_

  - [x] 4.4 CorporateOfficeController::store and ::update
    - Add `use HandlesFileUploads;`. `store`: replace with
      `$request->hasFile('organizational_structure') ? $this->storeUpload($request->file('organizational_structure'), 'corporate_office') : ''`.
      `update`: inside the existing `hasFile` guard, replace with
      `$this->storeUpload($request->file('organizational_structure'), 'corporate_office')`;
      column untouched otherwise. Redirects and non-file fields unchanged.
    - _Requirements: 3.1, 3.5, 4.1, 4.2, 7.1, 8.1, 8.2_

- [x] 5. Rewire MegaGoodVibes controller (video + thumbnail, null-safe)
  - [x] 5.1 MegaGoodVibesController::store
    - Add `use HandlesFileUploads;`. Replace the `file` video path with
      `$request->hasFile('file') ? $this->storeUpload($request->file('file'), 'megagoodvibes', 'videos') : ''`.
      Replace the previously unconditional `thumbnail` upload with a null-safe guard:
      `$request->hasFile('thumbnail') ? $this->storeUpload($request->file('thumbnail'), 'megagoodvibes') : ''`
      (saves `''` when absent instead of a fatal null call). Redirect and non-file fields unchanged.
    - _Requirements: 3.4, 3.5, 7.1, 8.1, 8.2_

  - [x] 5.2 MegaGoodVibesController::update
    - Inside the existing `if ($request->hasFile('file'))` guard, replace with
      `$this->storeUpload($request->file('file'), 'megagoodvibes', 'videos')`. Inside the existing
      `if ($request->hasFile('thumbnail'))` guard, replace with
      `$this->storeUpload($request->file('thumbnail'), 'megagoodvibes')`. Both columns retained when
      their file is absent. Redirect and non-file fields unchanged.
    - _Requirements: 4.1, 4.2, 7.1, 8.1, 8.2_

- [x] 6. Rewire multi-image controllers
  - [x] 6.1 BlogController::store
    - Add `use HandlesFileUploads;`. In the existing `foreach (request()->image ...)` loop, replace
      `cloudinary()->upload(...)` with `$this->storeUpload($imageData, 'blogs')` and save each
      filename as its own `Blog_Images` record. Redirect and non-file fields unchanged.
    - _Requirements: 3.2, 7.1, 8.1, 8.2_
    - _Properties: P6_

  - [x] 6.2 MeganewsController::store and ::update
    - Add `use HandlesFileUploads;`. `store`: in the `foreach` image loop replace `upload` with
      `$this->storeUpload($image, 'meganews')` per `Meganews_Image`. `update`: inside the existing
      `hasFile` block that deletes old images, replace the `foreach` upload with
      `$this->storeUpload($image, 'meganews')`; leave existing images intact when no files posted.
      Redirects and non-file fields unchanged.
    - _Requirements: 3.2, 4.1, 4.2, 7.1, 8.1, 8.2_
    - _Properties: P6, P7_

  - [x] 6.3 PhotoGalleryController::store
    - Add `use HandlesFileUploads;`. In the `foreach` image loop replace `upload` with
      `$this->storeUpload($image, 'photo_gallery')` per `Photo_Gallery` record. Redirect and
      non-file fields unchanged.
    - _Requirements: 3.2, 7.1, 8.1, 8.2_
    - _Properties: P6_

- [x] 7. Rewire HumanResource controller (five upload sites)
  - [x] 7.1 HumanResource single-file sites: storeNewHire, storeNewJob, storeHrWebsite
    - Add `use HandlesFileUploads;`. For each of `storeNewHire`, `storeNewJob`, and `storeHrWebsite`,
      replace the `cloudinary()` upload (including `storeHrWebsite`'s mp4 mime branch, which collapses
      to one call) with
      `$request->hasFile('image') ? $this->storeUpload($request->file('image'), 'human_resources') : ''`.
      Redirects and non-file fields unchanged.
    - _Requirements: 3.1, 3.3, 3.5, 7.1, 8.1, 8.2_

  - [x] 7.2 HumanResource announcements multi: store and ::update
    - `store`: in the `foreach` image loop replace `upload` with
      `$this->storeUpload($image, 'announcements')` per `Announcements_Images`. `update`: inside the
      existing delete-then-replace `hasFile` block, replace the `foreach` upload with
      `$this->storeUpload($image, 'announcements')`; retain existing images when no files posted.
      Redirects and non-file fields unchanged.
    - _Requirements: 3.2, 4.1, 4.2, 7.1, 8.1, 8.2_
    - _Properties: P6, P7_

- [x] 8. Update display views to use `section_asset()`
  - [x] 8.1 Discover every display site
    - Run the mandatory grep discovery from design §Components 5:
      `grep -rn "->image\|->thumbnail\|->file\|organizational_structure" resources/views` and
      `grep -rn "asset('img/" resources/views`. Map each hit to its Section (and `videos` subfolder
      for MegaGoodVibes video) to produce the complete edit list; do not edit `- Copy` / dated
      stale backups.
    - _Requirements: 5.1, 5.2, 6.1, 6.2, 6.3_

  - [x] 8.2 Wrap each stored-value display with `section_asset()`
    - For every discovered site, feed the URL through `section_asset($value, '<section>')` (or
      `section_asset($item->file, 'megagoodvibes', 'videos')` for MegaGoodVibes video), passing the
      **raw** stored value (never a pre-built `img/...` string, to avoid double-prefixing). Keep the
      existing `stripos($value, 'mp4')` `<video>` vs `<img>`/background detection on the **raw stored
      value**. Covers the confirmed views: `community_board_page.blade.php`,
      `new_main/pages/community-board.blade.php`, `main.blade.php`, `kamegawide_blogs.blade.php` and
      blog-detail views, `new_main/pages/meganewsDetails.blade.php`, `view_hr_website_lists.blade.php`,
      `did_you_know.blade.php`, plus photo gallery, MegaTrivia, Megagram, MegaGoodVibes (thumbnail
      root + `videos`), and Corporate Office views, and any additional sites found in 8.1.
    - _Requirements: 5.1, 5.2, 6.1, 6.2, 6.3_

- [x] 9. Write property/preservation and example feature tests
  - [x] 9.1 Property test P6 — multi-image uploads preserve count
    - For each multi-image route (Blog store, Meganews store, PhotoGallery store, HR announcements
      store), post a random N (1–5) of `UploadedFile::fake()->image()` over `Storage::fake('public')`;
      assert the number of files stored in the section folder equals N and the number of image
      records created equals N. ≥100 iterations.
    - Tag: `// Feature: local-file-storage, Property 6: Multi-image uploads preserve count`
    - _Requirements: 3.2_
    - _Properties: P6_

  - [x] 9.2 Property test P7 — update without a new file preserves the existing reference
    - Seed a record with a random reference (filename or `http://...`) for an Update_Handler
      (e.g. MegaTrivia/Megagram/CorporateOffice/Meganews/HR update); POST an update with no file for
      that field; assert the stored column value is identical to its prior value. ≥100 iterations.
    - Tag: `// Feature: local-file-storage, Property 7: Update without a new file preserves the existing reference`
    - _Requirements: 4.2_
    - _Properties: P7_

  - [x] 9.3 Example feature tests — single-image / single-file section placement
    - Using `Storage::fake('public')`, post `UploadedFile::fake()->image()` to each single-file
      controller (Community, MegaTrivia, Megagram, CorporateOffice, HR `storeNewHire`,
      `storeNewJob`, `storeHrWebsite`); assert the file lands in the correct named section folder and
      the DB column holds the filename only.
    - _Requirements: 1.5, 2.1, 3.1, 8.2_

  - [x] 9.4 Example feature test — MegaGoodVibes video + thumbnail placement
    - Post `UploadedFile::fake()->create('v.mp4', 1024, 'video/mp4')` as `file` and an image as
      `thumbnail`; assert `file` is stored under `megagoodvibes/videos` and `thumbnail` under
      `megagoodvibes`, with both DB columns holding filenames only.
    - _Requirements: 3.4_

  - [x] 9.5 Example feature tests — mp4 branch, empty field, and update-with-file
    - mp4 branch: post a fake mp4 to Community and HR `storeHrWebsite`; assert it lands in the
      section folder (Req 3.3).
    - Empty field: post without a file; assert the column is saved as `''` (Req 3.5).
    - Update-with-file: post an update with a new file; assert the column becomes a new filename and
      the file is stored (Req 4.1).
    - _Requirements: 3.3, 3.5, 4.1_

  - [x] 9.6 Example feature tests — redirects and non-file field preservation
    - For representative controllers, assert the post-save redirect target matches the pre-existing
      target and all non-file posted columns are saved unchanged.
    - _Requirements: 8.1, 8.2_

  - [x] 9.7 Structural + auth tests
    - Structural check: assert no `cloudinary()` call remains in the modified upload code paths
      (grep-based assertion over the nine controllers).
    - Auth route test: assert 1–2 affected routes still enforce the `MsGraphAuthenticated`
      middleware / redirect unauthenticated requests.
    - _Requirements: 7.1, 8.3_

- [x] 10. Final checkpoint - ensure all tests pass
  - Run `php artisan test`; ensure all property, preservation, example, structural, and auth tests
    pass. Ask the user if questions arise.

- [ ] 11. Optional extras
  - [ ]* 11.1 (Optional) Extra edge-case example tests for unusual file extensions
    - Add example tests for uploads with missing/empty extensions and non-standard extensions to
      confirm the `getClientOriginalExtension() ?: guessExtension() ?: 'bin'` fallback produces a
      valid filename.
    - _Requirements: 1.4, 2.1_

  - [ ]* 11.2 (Optional) Extract a shared default-placeholder image for empty references
    - Where views render a default when `section_asset('')` returns `''`, extract a single shared
      placeholder partial/constant to avoid duplicated per-view defaults.
    - _Requirements: 6.2_

## Notes

- Implementation language: PHP / Laravel 9 (matches the existing codebase; design used concrete PHP).
- Tasks marked with `*` and labelled "(Optional)" are genuine nice-to-have extras and can be skipped
  for a required-only run. The core path — trait, helper, autoload, symlink, all controller
  rewrites, view changes, and the property/preservation/example/structural/auth tests — is required.
- Each task references specific requirement clause numbers and, where applicable, design properties
  (P1–P7) for traceability.
- Property tests are PHPUnit loops using `fakerphp/faker` + `UploadedFile::fake()` over
  `Storage::fake('public')`, ≥100 iterations, tagged per the design's Testing Strategy.
- Checkpoints (tasks 3 and 10) provide incremental validation via `php artisan test`.

## Task Dependency Graph

```json
{
  "waves": [
    { "id": 0, "tasks": ["1.1", "1.2", "1.3"] },
    { "id": 1, "tasks": ["2.1", "2.2", "2.3", "2.4", "2.5"] },
    { "id": 2, "tasks": ["4.1", "4.2", "4.3", "4.4", "5.1", "5.2", "6.1", "6.2", "6.3", "7.1", "7.2"] },
    { "id": 3, "tasks": ["8.1"] },
    { "id": 4, "tasks": ["8.2"] },
    { "id": 5, "tasks": ["9.1", "9.2", "9.3", "9.4", "9.5", "9.6", "9.7", "11.1", "11.2"] }
  ]
}
```
