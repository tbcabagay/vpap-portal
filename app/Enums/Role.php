<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Member = 'member';

    /**
     * @return list<string>
     */
    public function permissionNames(): array
    {
        return match ($this) {
            self::Admin => array_column(Permission::cases(), 'value'),
            self::Member => collect(Permission::cases())
                ->filter(fn (Permission $permission) => str_starts_with($permission->value, 'viewAny ')
                    || str_starts_with($permission->value, 'view '))
                ->push(
                    Permission::CreateAddress,
                    Permission::UpdateAddress,
                    Permission::CreateAttendance,
                    Permission::UpdateAttendance,
                    Permission::CreateMember,
                    Permission::UpdateMember,
                )
                ->pluck('value')
                ->values()
                ->all(),
        };
    }
}
