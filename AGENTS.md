# AGENTS.md

Laravel 12 + Inertia 2 + Vue 3 + TypeScript monolith (admin barber project). Backend in `app/`, SPA frontend in `resources/js/`.

## Stack / layout
- **Backend**: Laravel 12 (`app/Http/Controllers`, `app/Models`), route groups split across `routes/web.php` + `routes/authRoute.php` + `routes/adminRoute.php`. UI responses use `Inertia::render()`.
- **Frontend**: Vue 3 `<script setup lang="ts">` SPA, Vite, Tailwind v4, shadcn/ui components under `resources/js/components/ui/`.
- **Testing**: Pest. **Package manager**: composer (PHP) + npm (Node). There is a `bun.lock` but npm is the canonical/npm `package-lock.json` — use npm, not bun.

## Commands
- Dev: `composer dev` (runs artisan serve + queue:listen + pail + vite concurrently). `npm run dev` for just Vite.
- Build: `npm run build`; SSR: `composer dev:ssr` / `npm run build:ssr`.
- Test: `composer test` (runs `config:clear`, Pint check, then Pest). Run a single test via `./vendor/bin/pest --filter <name>`.
- Lint backend: `composer lint` (`pint --parallel`). Check only: `composer test:lint`.
- Lint/format frontend: `npm run lint` (eslint, includes `--fix`) and `npm run format` (prettier on `resources/`).
- DB is **sqlite** (`DB_CONNECTION=sqlite`).

## Critical gotchas
- **`@/*` import alias maps to `resources/js/*`** (from `tsconfig.json`, not vite config). Frontend code imports as `@/components/...`, `@/layouts/...`, `@/routes/...`.
- **Wayment/wayfinder generated files are gitignored**. `resources/js/actions`, `resources/js/routes`, `resources/js/wayfinder` are auto-generated at build/dev time by the `@laravel/vite-plugin-wayfinder` Vite plugin. Never hand-edit them; treat them as read-only. Frontend references typed routes via `@/routes/admin/...`.
- **`resources/js/components/ui/*` is eslint-ignored** (shadcn vendor code) — do not reformat.
- Admin routeres are namespaced `admin.` and grouped with `prefix('admin')` + `middleware('role:admin')` (`routes/adminRoute.php`). New route files must be `require`d in `routes/web.php`.
- Frontend pages resolve via `defineOptions({ layout: AdminLayout })`; layouts live in `resources/js/layouts/`.
- CI runs PHP 8.4/8.5 during tests but `composer.json` requires `^8.2`; keep code compatible with 8.2.