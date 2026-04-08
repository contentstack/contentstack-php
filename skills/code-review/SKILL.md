---
name: code-review
description: PR checklist—API stability, docs, errors, compatibility, dependencies/SCA, tests; Blocker/Major/Minor.
---

# Code review – Contentstack PHP SDK

## When to use

- Reviewing a PR, self-review before submit, or automated review prompts.

## Instructions

Work through the checklist below. Optionally tag findings: **Blocker**, **Major**, **Minor**.

### API design and stability

- [ ] **Public API:** New or changed public methods/classes under `src/` are necessary, semver-conscious, and documented (`README.md` / `CHANGELOG.md` when user-visible).
- [ ] **Backward compatibility:** No breaking changes unless explicitly justified (e.g. major version). Prefer additive options and default config shapes.
- [ ] **Naming:** Matches existing SDK terminology (`Stack`, `ContentType`, `Query`, `Entry`, regions, etc.).

### Error handling and robustness

- [ ] **Errors:** New failure paths use or extend `CSException` / domain messages where appropriate; callers get actionable context.
- [ ] **Input:** Validate or document preconditions for public parameters; avoid silent failures on malformed API responses where the SDK should surface errors.
- [ ] **HTTP / JSON:** Parsing stays tolerant of documented Delivery API shapes; regressions for edge payloads are called out.

### Dependencies and security

- [ ] **Dependencies:** `composer.json` changes are justified; versions do not introduce known vulnerabilities.
- [ ] **SCA:** Address security findings (e.g. Snyk, org scanners) in the PR or via an agreed follow-up.

### Testing

- [ ] **Coverage:** New or modified behavior in `src/` has tests under `test/` when feasible.
- [ ] **Quality:** Tests are readable, deterministic, and follow existing helper/constants patterns.

### Severity (optional)

| Level | Examples |
|-------|----------|
| **Blocker** | Breaking public API without approval; security issue; no tests for new code where tests are practical |
| **Major** | Inconsistent errors; README examples that do not match real APIs |
| **Minor** | Style; minor docs |

### Detailed review themes

- **API:** Breaking public signatures without semver / CHANGELOG alignment.
- **Errors:** Exception changes that confuse callers without a version strategy.
- **README:** Examples must match real `Contentstack::Stack` and query APIs.
- **Dependencies:** New packages need justification and license awareness.

## References

- `skills/testing/SKILL.md`
- `skills/contentstack-utils/SKILL.md`
