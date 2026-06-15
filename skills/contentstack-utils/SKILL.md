---
name: contentstack-utils
description: PHP Delivery SDK API—Contentstack::Stack, queries, entries, assets, regions, sync; RTE via Composer package contentstack/utils.
---

# Contentstack PHP SDK (and Utils integration)

## When to use

- Implementing or changing Delivery API behavior, query builders, entries, assets, or sync.
- Updating `README.md` / `CHANGELOG.md` for user-visible behavior.
- Assessing semver impact of public API changes or **`contentstack/utils`** usage.

## Main entry (consumer API)

- Consumers use **`Contentstack\Contentstack::Stack(...)`** to obtain a **`Contentstack\Stack\Stack`** instance (API key, delivery token, environment, optional region / branch / live preview config).
- Query and fetch patterns flow through **content types**, **queries**, **entries**, and **assets** under `src/Stack/`.
- **RTE / JSON rendering:** `Contentstack::renderContent` and related helpers delegate to the **`contentstack/utils`** Composer package (`Contentstack\Utils\*`, `Option`). Do not reimplement utils behavior inside this SDK without strong reason.

## Customization and options

- Stack **config** array supports region, branch, live preview host/enable flags—preserve backward compatibility when extending keys.
- **ContentstackRegion** (or string region values per existing API) must stay consistent with documented Contentstack regions.

## Data and HTTP

- The SDK builds requests to Contentstack Delivery endpoints; keep URL construction, headers, and query parameters aligned with product documentation.
- **Result** parsing should match documented JSON shapes; guard against missing keys where the API allows omission.

## Errors

- Use **`Contentstack\Error\CSException`** and **`ErrorMessages`** patterns for domain failures.
- Avoid suppressing errors on public code paths without documentation.

## Related package

- **`contentstack/utils`** is a required dependency for RTE features shipped through this repo’s public surface; version ranges in `composer.json` should stay coherent with utils releases.

## Docs and versioning

- Follow **semver** for public API changes; update **CHANGELOG** and tag/release process per team norms.

## References

- [Contentstack](https://www.contentstack.com/)
- [PHP Delivery SDK docs](https://www.contentstack.com/docs/developers/sdks/content-delivery-sdk/php)
- `skills/php-style/SKILL.md`, `skills/framework/SKILL.md`
