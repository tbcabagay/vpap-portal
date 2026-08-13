<?php

namespace App\Policies;

use App\Models\Municipality;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class MunicipalityPolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Municipality $municipality): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Municipality $municipality): bool
    {
        return false;
    }

    public function delete(User $user, Municipality $municipality): bool
    {
        return false;
    }
}
