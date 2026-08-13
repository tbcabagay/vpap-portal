<?php

namespace App\Policies;

use App\Models\TypeOfPractice;
use App\Models\User;
use App\Policies\Concerns\HandlesRoles;

class TypeOfPracticePolicy
{
    use HandlesRoles;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, TypeOfPractice $typeOfPractice): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, TypeOfPractice $typeOfPractice): bool
    {
        return false;
    }

    public function delete(User $user, TypeOfPractice $typeOfPractice): bool
    {
        return false;
    }
}
