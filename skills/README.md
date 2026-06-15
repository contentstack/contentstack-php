# Skills – Contentstack PHP SDK

**This directory is the source of truth** for conventions (workflow, SDK API, style, tests, review, build). Read **`AGENTS.md`** at the repo root for the index and quick commands; each skill is a folder with **`SKILL.md`** (YAML frontmatter: `name`, `description`).

## When to use which skill

| Skill folder | Use when |
|--------------|----------|
| **dev-workflow** | Branches, `composer test` / docs, GitHub workflows, PR expectations |
| **contentstack-utils** | `Contentstack`, `Stack`, queries, entries, assets, sync, Composer `contentstack/utils` |
| **php-style** | PSR-4, namespaces, docblocks, `src/` structure, PHP compatibility |
| **testing** | PHPUnit, `test/` helpers, offline vs live tests, secrets |
| **code-review** | PR checklist, Blocker/Major/Minor, API and dependency gates |
| **framework** | `composer.json`, autoload, Doctum, dev dependencies |

## How to use these docs

- **Humans / any AI tool:** Start at **`AGENTS.md`**, then open the relevant **`skills/<name>/SKILL.md`**.
- **Cursor users:** **`.cursor/rules/README.md`** only points to **`AGENTS.md`** so guidance stays universal—no duplicate `.mdc` rule sets.
