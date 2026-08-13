---
paths:
  - 'database/seeders/**'
---

# Seeders

## RoleSeeder must run after UserSeeder
RoleSeeder assigns roles to existing users, so it must be called AFTER UserSeeder in DatabaseSeeder (it already is). Running it first silently creates roles but leaves model_has_roles empty — a 0-role state with no error. Caught when first seeded user showed no roles.
