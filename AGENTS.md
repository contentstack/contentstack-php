# Contentstack PHP SDK – Agent guide

**Universal entry point** for anyone automating or assisting work in this repo—AI agents (Cursor, Copilot, CLI tools), reviewers, and contributors. Conventions and detailed guidance live in **`skills/*/SKILL.md`**, not in editor-specific config, so the same instructions apply whether or not you use Cursor.

## What this repo is

- **Name:** [contentstack-php](https://github.com/contentstack/contentstack-php)
- **Purpose:** PHP library for the Contentstack **Delivery API**—stack initialization, content types, entries, assets, queries, sync, live preview config, and RTE rendering via the optional **`contentstack/utils`** package.
- **Out of scope:** This package is not the Management API client; it focuses on read/delivery patterns documented in the SDK README.

## Tech stack (at a glance)

| Area | Details |
|------|---------|
| Language | PHP (see `composer.json` `require.php`; supports legacy 5.5+ per package) |
| Layout | PSR-4 `Contentstack\` → `src/`; helper `src/Support/helper.php` |
| Tests | PHPUnit 10 → `test/` (`phpunit.xml`) |
| Docs | Doctum → `composer run generate:docs` (`config.php`) |
| Dependency | `contentstack/utils` for `Utils`, `Option`, RTE rendering helpers |

## Commands (quick reference)

```bash
composer install
composer test
# or: vendor/bin/phpunit
composer run generate:docs
```

Coverage and reports (when configured in `phpunit.xml`) write under `./tmp/`.

## Where the real documentation lives: skills

Read these **`SKILL.md` files** for full conventions—**this is the source of truth** for implementation and review:

| Skill | Path | What it covers |
|-------|------|----------------|
| **Development workflow** | [`skills/dev-workflow/SKILL.md`](skills/dev-workflow/SKILL.md) | Branches, CI expectations, Composer test/docs, PR notes |
| **Contentstack PHP SDK / Utils** | [`skills/contentstack-utils/SKILL.md`](skills/contentstack-utils/SKILL.md) | `Contentstack::Stack`, `Stack`, queries, entries, assets, regions, `contentstack/utils`, semver |
| **PHP style & repo layout** | [`skills/php-style/SKILL.md`](skills/php-style/SKILL.md) | PSR-4, namespaces, docblocks, `src/` layout, PHP version constraints |
| **Testing** | [`skills/testing/SKILL.md`](skills/testing/SKILL.md) | PHPUnit, `test/` layout, constants/helpers, credentials hygiene |
| **Code review** | [`skills/code-review/SKILL.md`](skills/code-review/SKILL.md) | PR checklist (API, errors, deps/SCA, tests), Blocker/Major/Minor |
| **Framework / build** | [`skills/framework/SKILL.md`](skills/framework/SKILL.md) | `composer.json`, autoload, Doctum, optional CI workflows |

An index with short “when to use” hints is in [`skills/README.md`](skills/README.md).

## Using Cursor

If you use **Cursor**, [`.cursor/rules/README.md`](.cursor/rules/README.md) only points to **`AGENTS.md`**—same source of truth as everyone else; no separate `.mdc` rule files.
