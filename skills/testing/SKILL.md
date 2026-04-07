---
name: testing
description: PHPUnit—test/ layout, helpers, constants, coverage output, secrets hygiene.
---

# Testing – Contentstack PHP SDK

## When to use

- Adding or changing tests under `test/`.
- Debugging failing tests or coverage gaps.

## Runner and config

- **PHPUnit 10** via `vendor/bin/phpunit` or `composer test`.
- Configuration: **`phpunit.xml`**—suite directory `test/`, source coverage for `src/`, reports under `./tmp/` when generated.

## Layout and naming

- Tests live as `*Test.php` (e.g. `EntriesTest.php`, `AssetsTest.php`, `SyncTest.php`) alongside helpers such as `constants.php`, `utility.php`, `REST.php`.
- Reuse existing helpers before introducing parallel fixtures.

## Integration vs unit

- Some tests may exercise HTTP against Contentstack (see `test/README.md` **Prerequisite**); treat credentials as **local-only** or CI secrets—never commit API keys or tokens.

## Coverage

- Clover/HTML/text reports are configured in `phpunit.xml`; ensure `tmp/` (or chosen output dirs) stays out of version control if generated locally (see `.gitignore`).

## Secrets

- Tests must not embed real **delivery tokens** or **API keys** in the repository.

## References

- `skills/dev-workflow/SKILL.md`
- `skills/code-review/SKILL.md`
