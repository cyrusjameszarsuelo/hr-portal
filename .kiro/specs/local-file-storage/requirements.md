# Requirements Document

## Introduction

This feature replaces the current Cloudinary-based image and file uploads with local file
storage on Laravel's `public` disk (`storage/app/public`). Uploaded files are organized into
one folder per content section (folder name equals the section name, e.g. `community_board`),
served to the browser through the `public/storage` symlink created by `php artisan storage:link`.

The change applies to every upload site across the HR Portal: Community, Blog, Meganews,
MegaTrivia, Megagram, MegaGoodVibes, PhotoGallery, CorporateOffice, and HumanResource. The
database continues to store the reference to each file (as a filename only), and existing content
that references Cloudinary URLs must continue to display without any data migration.

The upload code currently uses `cloudinary()->upload(...)` / `cloudinary()->uploadVideo(...)`
and saves the returned secure URL into the model column (`image`, `thumbnail`, `file`,
`organizational_structure`, etc.). Display views build URLs with helpers such as
`asset('img/<section>/'.$image)`. This feature moves new uploads to the local `public` disk,
stores filename-only values, and updates display logic to build URLs from the storage symlink
while remaining backward compatible with legacy Cloudinary URL values.

## Glossary

- **HR_Portal**: The Laravel intranet application that hosts all upload and display features.
- **Upload_Handler**: The controller logic that receives an uploaded file, persists it to storage,
  and records the reference in the database.
- **Public_Disk**: Laravel's `public` filesystem disk, rooted at `storage/app/public`.
- **Storage_Symlink**: The `public/storage` symbolic link created by `php artisan storage:link`
  that exposes `storage/app/public` under the web root.
- **Section**: A content area of the application that owns uploads (e.g. `community_board`,
  `blogs`, `meganews`, `megatrivia`, `megagram`, `megagoodvibes`, `photo_gallery`,
  `corporate_office`, `human_resources`, `announcements`).
- **Section_Folder**: The subfolder under `storage/app/public/` whose name equals the Section
  name and that holds that Section's uploaded files.
- **Filename**: The base file name only (e.g. `1699999999_photo.jpg`), without any directory path
  or URL scheme.
- **File_Reference**: The value stored in a database column that identifies an uploaded file;
  for new uploads a Filename, for legacy records a full Cloudinary URL.
- **Legacy_Cloudinary_URL**: A File_Reference whose value begins with `http` and points to a
  Cloudinary-hosted asset created before this feature.
- **Display_View**: A Blade template that renders an uploaded file to the browser.
- **Update_Handler**: The controller logic that edits an existing record and conditionally
  replaces an uploaded file.

## Requirements

### Requirement 1: Store uploaded files on the local public disk per section

**User Story:** As a content editor, I want uploaded images and files saved to local storage
organized by section, so that the portal no longer depends on Cloudinary for new uploads.

#### Acceptance Criteria

1. WHEN a file is uploaded through an Upload_Handler, THE HR_Portal SHALL store the file on the
   Public_Disk under the Section_Folder that matches the originating Section.
2. THE HR_Portal SHALL name each Section_Folder identically to its Section name.
3. WHEN an Upload_Handler stores a file and the target Section_Folder does not exist, THE HR_Portal
   SHALL create the Section_Folder before writing the file.
4. WHEN an Upload_Handler stores a file, THE HR_Portal SHALL assign the file a Filename that is
   unique within the Section_Folder.
5. THE HR_Portal SHALL store new uploads for each Section in the following Section_Folder:
   `community_board` for Community, `blogs` for Blog, `meganews` for Meganews, `megatrivia` for
   MegaTrivia, `megagram` for Megagram, `megagoodvibes` for MegaGoodVibes, `photo_gallery` for
   PhotoGallery, `corporate_office` for CorporateOffice, and `human_resources` and `announcements`
   for HumanResource.
6. WHERE a Section stores video files, THE HR_Portal SHALL place video files in a `videos`
   subfolder within that Section_Folder.

### Requirement 2: Persist the filename only in the database

**User Story:** As a developer, I want the database to store just the filename, so that file
references stay portable and independent of the hosting URL.

#### Acceptance Criteria

1. WHEN an Upload_Handler stores a file, THE HR_Portal SHALL save only the Filename into the
   corresponding database column.
2. THE HR_Portal SHALL exclude directory paths and URL schemes from the File_Reference saved for
   new uploads.
3. WHEN an Upload_Handler completes storing a file and its File_Reference, THE HR_Portal SHALL
   persist the owning record to the database.

### Requirement 3: Handle single-image, multi-image, and video upload shapes

**User Story:** As a content editor, I want single images, multiple images, and videos to all
save correctly, so that every existing upload form keeps working.

#### Acceptance Criteria

1. WHEN a single-image upload is submitted through the Community, MegaTrivia, Megagram, or
   CorporateOffice Upload_Handler, THE HR_Portal SHALL store one image file in that Section_Folder
   and save its Filename.
2. WHEN a multi-image upload is submitted through the Blog, Meganews, PhotoGallery, or
   HumanResource Upload_Handler, THE HR_Portal SHALL store each uploaded image file in that
   Section_Folder and save each Filename as a separate record.
3. WHEN a submission through the Community or HumanResource Upload_Handler contains a file whose
   MIME type is `video/mp4`, THE HR_Portal SHALL store the file as a video in that Section.
4. WHEN a submission through the MegaGoodVibes Upload_Handler contains a video file, THE HR_Portal
   SHALL store the video file in the `videos` subfolder of the `megagoodvibes` Section_Folder and
   store the accompanying thumbnail image in the `megagoodvibes` Section_Folder.
5. IF a submission through an Upload_Handler contains no uploaded file for a given field, THEN THE
   HR_Portal SHALL save an empty File_Reference for that field.

### Requirement 4: Preserve existing files during updates

**User Story:** As a content editor, I want updates without a new file to keep the current file,
so that editing text does not erase an existing image or video.

#### Acceptance Criteria

1. WHEN an Update_Handler processes a submission that contains a new uploaded file for a field,
   THE HR_Portal SHALL store the new file and update that field's File_Reference.
2. IF an Update_Handler processes a submission that contains no new uploaded file for a field,
   THEN THE HR_Portal SHALL retain the existing File_Reference for that field.

### Requirement 5: Display files through the storage symlink

**User Story:** As an employee, I want uploaded images and videos to render on the page, so that
I can view portal content.

#### Acceptance Criteria

1. WHEN a Display_View renders a File_Reference that is a Filename, THE HR_Portal SHALL build the
   file URL as `asset('storage/<section>/'.$filename)` using the Section_Folder for that content.
2. WHERE a Display_View renders a video stored in a `videos` subfolder, THE HR_Portal SHALL build
   the video URL to include the `videos` subfolder within the Section_Folder.
3. THE HR_Portal SHALL require the Storage_Symlink at `public/storage` to serve files stored on
   the Public_Disk.

### Requirement 6: Backward compatibility with legacy Cloudinary URLs

**User Story:** As an employee, I want previously uploaded content to keep displaying, so that no
existing images or videos break after the change.

#### Acceptance Criteria

1. WHEN a Display_View renders a File_Reference whose value begins with `http`, THE HR_Portal SHALL
   use the value as the file URL unchanged.
2. WHEN a Display_View renders a File_Reference whose value does not begin with `http`, THE
   HR_Portal SHALL treat the value as a Filename under `storage/<section>/`.
3. THE HR_Portal SHALL display existing Legacy_Cloudinary_URL records without requiring changes to
   the stored data.

### Requirement 7: Retire Cloudinary from the upload code paths

**User Story:** As a developer, I want new uploads to stop calling Cloudinary, so that the upload
paths no longer depend on the external service.

#### Acceptance Criteria

1. WHEN an Upload_Handler or Update_Handler stores a new file, THE HR_Portal SHALL write the file
   to the Public_Disk without calling `cloudinary()`.
2. THE HR_Portal SHALL continue to read and display File_Reference values that hold a
   Legacy_Cloudinary_URL.

### Requirement 8: Preserve non-upload behavior

**User Story:** As an employee, I want the rest of each feature to behave exactly as before, so
that only file storage changes and nothing else regresses.

#### Acceptance Criteria

1. WHEN an Upload_Handler or Update_Handler finishes saving a record, THE HR_Portal SHALL perform
   the same post-save redirect that the corresponding handler performed before this feature.
2. THE HR_Portal SHALL preserve all non-file field values written by each Upload_Handler and
   Update_Handler unchanged.
3. THE HR_Portal SHALL retain the existing authentication and access control behavior for every
   affected route.

## Out of Scope

- Migrating existing Cloudinary-hosted files or rewriting Legacy_Cloudinary_URL records to local
  Filenames.
- Changing the Microsoft 365 / Microsoft Graph authentication mechanism.
- Modifying features unrelated to file upload and display.
- Adding new upload forms or content sections beyond those enumerated above.
