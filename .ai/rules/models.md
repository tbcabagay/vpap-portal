---
paths:
  - 'app/Models/**'
---

# Models

## Use PHP 8 attributes, not properties, for model conventions
Models use #[Fillable([...])] (Illuminate\Database\Eloquent\Attributes\Fillable) instead of $fillable, and #[WithoutTimestamps] instead of $timestamps = false on tables without created_at/updated_at columns. Date columns use casts() with 'date'/'datetime'; decimals use 'decimal:2'. Pivot tables member_species_of_specialization and member_type_of_practice auto-resolve via belongsToMany.
