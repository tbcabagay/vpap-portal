<?php

namespace App\Policies;

use App\Models\Attendance;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class AttendancePolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Attendance $attendance): bool
    {
        return $user->member?->id === $attendance->member_id;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Attendance $attendance): bool
    {
        return false;
    }

    public function delete(User $user, Attendance $attendance): bool
    {
        return false;
    }
}
