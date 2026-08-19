# FitnessClass

A Laravel-based booking and scheduling system for fitness classes, connecting **instructors** who publish classes with **members** who book them.

## Description

FitnessClass provides two independent, guard-separated portals built on Laravel 11:

- **Instructor portal** — instructors register, create and manage fitness classes (name, description, capacity, start/end time), and review bookings made against their classes.
- **Member portal** — members register, browse available classes, book a spot, and cancel their own bookings.

Bookings move through a simple status workflow: `pending → approved / rejected`, with `cancelled` available to the member at any point before the class starts. Every web (session-based) flow has a parallel JSON API (token auth via Sanctum) exposing the same actions for external/API clients.

## Impact

- Gives instructors a lightweight way to publish a class schedule and manage capacity/attendance without spreadsheets or manual sign-up sheets.
- Gives members self-service booking and cancellation instead of contacting an instructor directly.
- Enforces capacity and duplicate-booking checks server-side, reducing overbooking and double-booking of the same class.

## Requirements

### Functional

- Member registration/login and instructor registration/login (separate auth guards).
- Instructors can create, edit, and delete fitness classes with a capacity and a start/end time window.
- Members can view available classes, book a class (subject to capacity and duplicate-booking checks), and cancel their own bookings.
- Instructors can view and act on bookings made against their classes.
- A token-based JSON API mirrors the web flows above for external clients.

### Environment

- PHP `^8.2` with the extensions Laravel 11 requires
- [Composer](https://getcomposer.org/)
- Node.js + npm (for the Vite/Tailwind frontend build)
- A database — SQLite by default (see `.env.example`), MySQL also supported

## Tech Stack

| Layer | Technology |
|---|---|
| Backend framework | Laravel `^11.31` |
| Auth / scaffolding | Laravel Jetstream `^5.3` (Livewire-based), Laravel Sanctum `^4.0` |
| Interactivity | Livewire `^3.0` |
| Frontend build | Vite `^6`, Tailwind CSS `^3.4` (`forms`, `typography` plugins), Axios |
| Database | SQLite (default) / MySQL, via Eloquent ORM |
| Testing | PHPUnit `^11` |
| Dev tooling | Laravel Pint (code style), Laravel Sail, Laravel Pail (log tailing) |

## Getting Started

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate
php artisan migrate

# Run app server, queue listener, log tailer, and Vite dev server together
composer dev
```

Or run pieces individually with `php artisan serve` and `npm run dev`.

## Preferences

- **Code style**: run `vendor/bin/pint` before committing.
- **Structure**: controllers are organized by actor/guard — `Controllers/Api`, `Controllers/Auth`, `Controllers/Member`, `Controllers/Instructor`. Follow this grouping when adding new endpoints rather than introducing a new pattern.
- **Testing**: add Feature tests under `tests/Feature` for new Member/Instructor/Booking behavior — this area currently has no domain-specific test coverage (only Jetstream/Fortify scaffolding tests exist).

### Known issues / notes for contributors

- The default Jetstream `User` model is leftover scaffolding, unrelated to the Member/Instructor domain flow. Jetstream's own profile/team pages (reached via `<x-app-layout>`) aren't linked from the app's navigation and are out of scope of the Member/Instructor feature set.
- `resources/views/layouts/app.blade.php` is a `@yield`-based Bootstrap layout used only by the welcome/login/register pages; it is a different, unrelated file from Jetstream's Tailwind `<x-app-layout>` component conventions — don't assume the two are interchangeable.

## License

Licensed under the [MIT license](https://opensource.org/licenses/MIT).
