<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class MemberPolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Member $member): bool
    {
        return $member->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Member $member): bool
    {
        return $member->user_id === $user->id;
    }

    public function delete(User $user, Member $member): bool
    {
        return false;
    }
}
