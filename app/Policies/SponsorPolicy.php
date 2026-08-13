<?php

namespace App\Policies;

use App\Models\Sponsor;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class SponsorPolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Sponsor $sponsor): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Sponsor $sponsor): bool
    {
        return false;
    }

    public function delete(User $user, Sponsor $sponsor): bool
    {
        return false;
    }
}
