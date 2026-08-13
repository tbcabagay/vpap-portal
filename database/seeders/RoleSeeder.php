<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as RoleModel;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's roles.
     */
    public function run(): void
    {
        RoleModel::findOrCreate(Role::Admin->value);
        RoleModel::findOrCreate(Role::Member->value);

        User::query()->chunkById(500, function ($users) {
            foreach ($users as $user) {
                $user->assignRole(Role::Member->value);
            }
        });

        User::query()->orderBy('id')->first()?->assignRole(Role::Admin->value);
    }
}
