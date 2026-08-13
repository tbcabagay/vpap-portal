<?php

namespace App\Policies;

use App\Models\Institution;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class InstitutionPolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Institution $institution): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Institution $institution): bool
    {
        return false;
    }

    public function delete(User $user, Institution $institution): bool
    {
        return false;
    }
}
