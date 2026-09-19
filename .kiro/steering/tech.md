# Tech Stack

## Framework & Language

- **PHP** ^7.4 / ^8.0
- **Laravel** ^9.0 (MVC, Blade templating, Eloquent ORM)
- Server-rendered Blade views (no SPA framework)

## Key Libraries

- **dcblogdev/laravel-microsoft-graph** — Microsoft 365 auth (`MsGraph` facade,
  `MsGraphAuthenticated` middleware). This is the login mechanism; there is no
  local auth.
- **cloudinary-labs/cloudinary-laravel** — image hosting/uploads.
- **intervention/image** — image manipulation.
- **laravel/sanctum** — API token auth.
- **guzzlehttp/guzzle** — HTTP client.
- **symfony/mailer** — mail.

## Frontend Build

- **Laravel Mix** (webpack wrapper), config in `webpack.mix.js`.
- **Axios** for AJAX, **Lodash** utility.
- Assets live in `resources/js` and `resources/css`; compiled into `public`.

## Database

- MySQL (SQL dumps in `database/` — e.g. `hrportalwithoutdata.sql`).
- Eloquent models in `app/Models`, migrations in `database/migrations`.

## Code Style

- **StyleCI** with the `laravel` preset (PHP 8 rules) — see `.styleci.yml`.
  `no_unused_imports` is disabled. Follow PSR-12 / Laravel conventions.
- `.editorconfig` governs whitespace.

## Common Commands

```bash
# Install dependencies
composer install
npm install

# Frontend build
npm run dev          # development build (laravel-mix)
npm run watch        # rebuild on file changes
npm run prod         # production build

# Laravel / Artisan
php artisan serve            # local dev server
php artisan migrate          # run migrations
php artisan key:generate     # generate app key
php artisan tinker           # REPL

# Tests (PHPUnit)
php artisan test             # or: ./vendor/bin/phpunit
```

> Note: `npm run watch` and `php artisan serve` are long-running — run them in
> your own terminal rather than as blocking commands.
