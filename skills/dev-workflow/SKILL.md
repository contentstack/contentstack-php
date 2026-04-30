---
name: dev-workflow
description: Branches, CI expectations, Composer test/docs, PR hygiene for Contentstack PHP SDK.
---

# Development workflow – Contentstack PHP SDK

## When to use

- Setting up locally, opening a PR, or aligning with repository automation.
- Answering “how do we run tests?” or “why did the branch check fail?”

## Branches

- Use feature branches (e.g. `feat/...`, `fix/...`, ticket branches).
- Release flow is direct **`development` -> `master`** (no `staging` intermediate branch).
- **Policy / SCA** workflows may run on PRs (see `.github/workflows/policy-scan.yml`, `sca-scan.yml`).

## Running tests and build

- **Install:** `composer install`
- **Tests:** `composer test` or `vendor/bin/phpunit` (config: `phpunit.xml`, suite under `test/`).
- Tests may require Contentstack credentials or mocks as documented in `test/README.md`—do not commit secrets.

## Documentation generation

- **Doctum:** `composer run generate:docs` (see `config.php`, output per Doctum defaults).

## Pull requests

- Build/tests pass locally where applicable (`composer test`).
- Follow the **code-review** skill (`skills/code-review/SKILL.md`) before merge.
- Prefer backward-compatible public API; call out breaking changes and semver.
- Update **`CHANGELOG.md`** when behavior visible to integrators changes.

## References

- `skills/testing/SKILL.md`
- `skills/code-review/SKILL.md`
