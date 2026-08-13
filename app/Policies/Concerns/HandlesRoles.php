<?php

namespace App\Policies\Concerns;

use App\Enums\Role;
use App\Models\User;

trait HandlesRoles
{
    /**
     * Grant admins every ability; let other roles fall through to the policy methods.
     */
    public function before(User $user, string $ability): ?bool
    {
        return $user->hasRole(Role::Admin->value) ? true : null;
    }
}
