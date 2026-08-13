<?php

namespace App\Policies;

use App\Models\EventFee;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class EventFeePolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, EventFee $eventFee): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, EventFee $eventFee): bool
    {
        return false;
    }

    public function delete(User $user, EventFee $eventFee): bool
    {
        return false;
    }
}
