---
name: framework
description: Composer package, PSR-4 autoload, Doctum docs, PHP version constraints, dev dependencies.
---

# Framework / build – Contentstack PHP SDK

## When to use

- Editing `composer.json`, autoload blocks, or scripts.
- Changing minimum PHP version or required packages (e.g. `contentstack/utils`, PHPUnit).
- Updating documentation generation (`config.php`, Doctum).

## Composer

- **Package name:** `contentstack/contentstack` (see `composer.json`).
- **Autoload:** PSR-4 `Contentstack\` → `src/` plus `files` entry for `src/Support/helper.php`—keep in sync when moving classes.
- **Scripts:** `test` → PHPUnit; `generate:docs` → Doctum.

## PHP version

- `require.php` sets minimum language level; raising it is a **compatibility decision**—document in CHANGELOG and coordinate releases.

## Documentation

- **Doctum** scans `./src` per `config.php`; adjust only when layout changes.

## CI / automation

- This repo may not define a dedicated PHPUnit workflow file; still run **`composer test`** before merge. Branch and policy workflows live under `.github/workflows/`.

## References

- `skills/php-style/SKILL.md`
- `skills/dev-workflow/SKILL.md`
