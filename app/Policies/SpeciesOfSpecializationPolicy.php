<?php

namespace App\Policies;

use App\Models\SpeciesOfSpecialization;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class SpeciesOfSpecializationPolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, SpeciesOfSpecialization $speciesOfSpecialization): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, SpeciesOfSpecialization $speciesOfSpecialization): bool
    {
        return false;
    }

    public function delete(User $user, SpeciesOfSpecialization $speciesOfSpecialization): bool
    {
        return false;
    }
}
