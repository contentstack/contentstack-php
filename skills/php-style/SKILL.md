---
name: php-style
description: PSR-4 layout, namespaces, docblocks, PHP compatibility, src/ structure for this SDK.
---

# PHP style and repo layout – Contentstack PHP SDK

## When to use

- Editing any PHP under `src/` or `test/`.
- Adding classes or changing namespace boundaries.

## Layout

- **Library code:** `src/` with namespace **`Contentstack\...`** matching PSR-4 paths.
- **Stack / Delivery:** `src/Stack/` (e.g. `Stack.php`, `ContentType/`, `Assets.php`, `BaseQuery.php`).
- **Config / errors / support:** `src/Config/`, `src/Error/`, `src/Support/`.
- **Entry point:** `src/Contentstack.php` exposes static factory and utils-facing helpers.

## PHP language

- Honor **minimum PHP** from `composer.json`; avoid syntax and standard-library features unavailable on that floor unless the constraint is explicitly raised.
- **`#[\AllowDynamicProperties]`** and legacy patterns may exist for backward compatibility—do not remove without a semver plan.

## Documentation blocks

- Existing files use **PHPDoc** (`@param`, `@return`, `@package`, etc.); new public APIs should include equivalent documentation for IDEs and Doctum.

## Naming

- **Classes:** `PascalCase` matching file names under PSR-4.
- **Methods:** `camelCase` consistent with surrounding code.
- Preserve established **public** names even when imperfect unless doing a **semver-major** cleanup with maintainer agreement.

## Imports and visibility

- Prefer `use` statements for classes in other namespaces; keep **public** surface explicit (public methods on classes intended for consumers).

## References

- `skills/framework/SKILL.md` (Composer, autoload)
- `skills/testing/SKILL.md`
