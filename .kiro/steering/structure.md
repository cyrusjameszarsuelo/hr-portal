# Project Structure

Standard Laravel 9 layout. Application code lives under `app/`, routes in
`routes/`, and views in `resources/views/`.

## Key Directories

```
app/
  Http/
    Controllers/     # One controller per feature area (see below)
    Middleware/      # Includes auth/MS Graph gating
  Models/            # Eloquent models
  Listeners/         # e.g. NewMicrosoft365SignInListener
config/              # Laravel + package config
database/
  factories/         # Model factories
  migrations/        # Schema migrations
  seeders/           # DB seeders
  *.sql              # MySQL dumps
resources/
  views/             # Blade templates (see below)
  js/  css/          # Frontend source (compiled by Laravel Mix)
  lang/              # Localization
routes/
  web.php            # Main web routes (browser-facing)
  api.php            # API routes
  channels.php  console.php
public/              # Web root + compiled assets
tests/               # PHPUnit tests
```

## Controllers (feature areas)

Each domain has its own controller in `app/Http/Controllers`, e.g.
`BlogController`, `MeganewsController`, `MegaTriviaController`,
`MegaGoodVibesController`, `MegagramController`, `SurveyController`,
`SurveyAnswerController`, `HumanResourceController`, `CommunityController`,
`CompanyEventsController`, `CorporateOfficeController`, `PhotoGalleryController`,
`TimelineController`, `MainController`, and `AuthController`.

## Views (`resources/views`)

- `pages/` — main employee-facing pages, one Blade file per screen
  (e.g. `human_resources.blade.php`, `photo_gallery.blade.php`).
- `pages/admin/` — admin/management screens.
- `new_main/` — newer redesigned pages.
- `auth/` — login views.
- `includes/` — shared partials (headers, footers, nav).
- `scripts/` — shared script partials.

> Some Blade files have `- Copy` or date suffixes (e.g.
> `main.blade - Copy.php`, `human_resources.blade.php 07-01-22`). These are
> stale backups — do NOT edit them. Work only on the canonical
> `*.blade.php` file for a given screen.

## Routing Conventions

- Routes are defined in `routes/web.php`.
- Public/login routes use the `guest` middleware.
- Authenticated routes are wrapped in the `MsGraphAuthenticated` middleware
  group — new employee-facing routes generally belong there.
- Admin/management routes are prefixed with `/main/...`.
- Controllers use explicit class references
  (`[BlogController::class, 'index']`) rather than string syntax.

## Naming

- Controllers: `PascalCase` + `Controller` suffix.
- Models: `PascalCase` (some use underscores matching legacy tables, e.g.
  `Blog_Comments`, `Community_Board`).
- Blade views: `snake_case.blade.php`.
