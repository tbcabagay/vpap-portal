<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class AddressPolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Address $address): bool
    {
        return $user->member?->id === $address->member_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Address $address): bool
    {
        return $user->member?->id === $address->member_id;
    }

    public function delete(User $user, Address $address): bool
    {
        return $user->member?->id === $address->member_id;
    }
}
