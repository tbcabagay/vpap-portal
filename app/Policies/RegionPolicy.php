<?php

namespace App\Policies;

use App\Models\Region;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class RegionPolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Region $region): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Region $region): bool
    {
        return false;
    }

    public function delete(User $user, Region $region): bool
    {
        return false;
    }
}
