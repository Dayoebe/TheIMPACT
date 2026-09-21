<div align="center">
  <img src="public/favicon.svg" width="72" height="72" alt="The IMPACT mark">

  # THE IMPACT

  **Christian Youth Leadership & Public Impact Network**

  Faith-led. Service-driven. Africa-focused.

  [Explore the project](#about-the-project) · [Run locally](#local-development) · [View the routes](#public-pages) · [Contribute](#contributing)
</div>

---

## About the project

THE IMPACT is the public website for a network focused on developing Christ-centred young leaders who can serve their communities, engage public life and contribute to societal transformation across Africa.

The site presents the organisation's identity, vision, mission, leadership structure, programmes and mentorship initiative. Its public experience is built mobile-first and progressively adapts into a spacious editorial layout for tablets and desktops.

The project is currently in active development. Leadership names, facilitator profiles, dates, addresses, cohorts and application details shown in the interface are clearly identified as sample or illustrative content. They are intended to be replaced with verified information through a future administration dashboard.

## Vision and mission

> To become Africa's leading network for developing Christ-centred young leaders who shape institutions, influence public policy and build solutions that transform communities and nations.

The mission follows a five-step path:

1. **Identify** young Christians with character, potential and a desire to serve.
2. **Connect** them through shared faith, responsibility and collaboration.
3. **Equip** them with practical knowledge, judgement and useful skills.
4. **Mentor** them through guidance, reflection and accountable relationships.
5. **Deploy** them into service, problem-solving and responsible leadership.

The network's philosophy connects six ideas: **Faith → Leadership → Competence → Service → Influence → Transformation**.

## Public pages

| Page | Route | Purpose |
| --- | --- | --- |
| Home | `/` | Introduces the network, its focus areas and journey. |
| About | `/about` | Explains who THE IMPACT is, why it exists and what makes it different. |
| Vision & Mission | `/about/vision-mission` | Presents the vision, five-step mission and six-part philosophy. |
| Leadership | `/leadership` | Shows the leadership structure and clearly labelled sample profiles. |
| Programmes | `/programmes` | Lists the six programme pathways. |
| Programme detail | `/programmes/{slug}` | Provides objectives, audience, curriculum, duration, facilitators, cohorts and a registration preview. |
| Mentorship | `/mentorship` | Explains mentors, mentees, matching, mentorship areas and participation previews. |

Current programme slugs:

- `/programmes/christian-leadership`
- `/programmes/governance-public-policy`
- `/programmes/competence-development`
- `/programmes/christian-character-faith`
- `/programmes/community-service`
- `/programmes/mentorship`

Unknown or malformed programme slugs return a standard `404` response.

## Highlights

- Mobile-first layout with app-style bottom navigation on smaller screens.
- Responsive navigation, typography, content grids and imagery.
- Server-rendered Livewire pages with page-specific metadata.
- Reusable Blade components for the header, footer, page introductions, icons and philosophy content.
- Data-driven programme directory and programme detail pages.
- Accessible landmarks, skip navigation, visible focus states and keyboard-friendly controls.
- Responsive, locally served WebP imagery and locally hosted fonts.
- Honest empty and preview states when information or applications are not confirmed.
- Feature tests covering public routes, page content, dynamic programmes, metadata, fallbacks and navigation.

## Technology

| Layer | Technology |
| --- | --- |
| Application | Laravel 13 |
| Reactive UI | Livewire 4 |
| Language | PHP 8.3+ |
| Styling | Tailwind CSS 4 and project CSS |
| Browser interaction | Alpine.js supplied by Livewire |
| Asset pipeline | Vite 8 |
| Tests | PHPUnit 12 |
| Formatting | Laravel Pint |

The current checkout has been verified with PHP 8.4, Node.js 20 and npm 10.

## Local development

### Requirements

- PHP 8.3 or newer
- Composer 2
- Node.js 20.19+ or 22.12+
- npm 10+
- PHP extensions required by Laravel and SQLite

### Recommended setup

Clone the repository, enter the project directory and run:

```bash
touch database/database.sqlite
composer run setup
```

The setup script installs PHP and JavaScript dependencies, creates `.env` when needed, generates the application key, runs migrations and builds the frontend assets. The first command creates the local SQLite file expected by the default environment configuration.

Start the development environment with:

```bash
composer run dev
```

Then open the URL printed by the development server, normally `http://localhost:8000`.

### Manual setup

If you prefer to run each step yourself:

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
npm install
npm run build
php artisan serve
```

Keep secrets and machine-specific settings in `.env`. The file is ignored by Git and must never be committed.

## Useful commands

```bash
# Start Vite in watch mode
npm run dev

# Create a production frontend build
npm run build

# Run the test suite
composer test

# Run only the public-page feature tests
php artisan test --compact tests/Feature/PublicPagesTest.php tests/Feature/ProgrammePagesTest.php

# Format changed PHP files
vendor/bin/pint --dirty --format agent

# Review public application routes
php artisan route:list --except-vendor
```

## Content configuration

Public organisational content is currently stored in two configuration files:

- [`config/impact.php`](config/impact.php) contains the vision, mission, philosophy, leadership groups and mentorship application settings.
- [`config/programmes.php`](config/programmes.php) contains programme copy, curricula, durations, facilitators, cohorts and registration links.

Set a programme's `registration_url` to a verified application URL to replace its preview button. The mentorship page behaves the same way with `mentor_application_url` and `mentee_application_url` in `config/impact.php`.

Sample entries should remain visibly labelled until they are replaced with confirmed data. Do not remove those labels while placeholder names, dates, locations or roles are still present.

## Project structure

```text
app/Livewire/                 Public page components
config/impact.php             Organisation and mentorship content
config/programmes.php         Programme catalogue and detail content
public/images/                Responsive public imagery
resources/css/app.css         Design system and responsive styles
resources/fonts/              Locally hosted fonts and licences
resources/views/components/   Shared Blade interface components
resources/views/livewire/     Public page templates
routes/web.php                Public web routes
tests/Feature/                Public-page and programme feature tests
```

## Design and accessibility

The visual system uses Cormorant Garamond for editorial headings and Manrope for interface and body copy. Its core palette combines deep aubergine, warm ivory, champagne and muted rose.

Responsive images use `srcset` so mobile devices receive smaller files. The current people-focused images are AI-generated illustrations used to communicate the organisation's values; they do not document real events or identify actual members. Their disclosure is also displayed in the site footer.

When changing the interface, preserve:

- a usable layout from 320px upward;
- touch targets suitable for mobile interaction;
- keyboard access to menus, accordions and dialogs;
- visible focus styles and meaningful alt text;
- reduced-motion support;
- honest labels for illustrative or unconfirmed information.

## Testing

Run the complete test suite before opening a pull request:

```bash
composer test
```

For frontend changes, also produce a clean build:

```bash
npm run build
```

The feature suite covers the main public pages, route availability, metadata, programme catalogue integrity, programme-detail fallbacks, registration states, navigation and escaped output.

## Deployment

For a production deployment:

1. Set `APP_ENV=production`, `APP_DEBUG=false` and the correct `APP_URL`.
2. Configure the production database, cache, session, queue and mail services.
3. Install optimized PHP dependencies with `composer install --no-dev --optimize-autoloader`.
4. Build assets with `npm ci && npm run build`.
5. Run `php artisan migrate --force`.
6. Run `php artisan optimize`.
7. Point the web server document root to the project's `public/` directory.

Never deploy the sample leadership, schedule, address or application data as confirmed information. Replace it with verified organisational content first.

## Contributing

1. Create a focused branch from `main`.
2. Follow the existing Laravel, Livewire and Blade conventions.
3. Keep public copy factual and label placeholders clearly.
4. Add or update focused feature tests when behaviour changes.
5. Run Pint, the relevant tests and the production build.
6. Open a pull request that explains the user-facing change and its validation.

Please do not commit `.env`, credentials, generated dependency directories, local databases or private personal information.

## Security

Do not report security vulnerabilities in a public issue. Contact the repository owner privately through GitHub and include enough detail to reproduce and assess the problem without exposing sensitive data.

## Repository

GitHub: [Dayoebe/TheIMPACT](https://github.com/Dayoebe/TheIMPACT)

## Licence

No project-specific licence has been published yet. Unless a licence file is added, the source remains subject to the repository owner's copyright and is not automatically granted an open-source licence.
