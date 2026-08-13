<?php

namespace App\Policies;

use App\Models\MemberServiceYear;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class MemberServiceYearPolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, MemberServiceYear $memberServiceYear): bool
    {
        return $user->member?->id === $memberServiceYear->member_id;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, MemberServiceYear $memberServiceYear): bool
    {
        return false;
    }

    public function delete(User $user, MemberServiceYear $memberServiceYear): bool
    {
        return false;
    }
}
