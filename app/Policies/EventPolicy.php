<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class EventPolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Event $event): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Event $event): bool
    {
        return false;
    }

    public function delete(User $user, Event $event): bool
    {
        return false;
    }
}
