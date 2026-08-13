<?php

use App\Enums\Role;
use App\Models\Address;
use App\Models\Announcement;
use App\Models\Attendance;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventFee;
use App\Models\Institution;
use App\Models\Member;
use App\Models\MemberServiceYear;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\Region;
use App\Models\SpeciesOfSpecialization;
use App\Models\Sponsor;
use App\Models\TypeOfPractice;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Gate;

use function Pest\Laravel\seed;

beforeEach(function () {
    seed(RoleSeeder::class);
});

function policyAdmin(): User
{
    $admin = User::factory()->create();

    $admin->assignRole(Role::Admin->value);

    return $admin;
}

function policyMember(): User
{
    $user = User::factory()->create();

    $user->assignRole(Role::Member->value);
    Member::factory()->create(['user_id' => $user->id]);

    return $user;
}

$allModels = [
    'address' => Address::class,
    'announcement' => Announcement::class,
    'attendance' => Attendance::class,
    'country' => Country::class,
    'event' => Event::class,
    'event_fee' => EventFee::class,
    'institution' => Institution::class,
    'member' => Member::class,
    'member_service_year' => MemberServiceYear::class,
    'municipality' => Municipality::class,
    'province' => Province::class,
    'region' => Region::class,
    'species' => SpeciesOfSpecialization::class,
    'sponsor' => Sponsor::class,
    'type_of_practice' => TypeOfPractice::class,
    'user' => User::class,
];

$viewableModels = array_filter($allModels, fn (string $model) => in_array($model, [
    Announcement::class,
    Country::class,
    Event::class,
    EventFee::class,
    Institution::class,
    Municipality::class,
    Province::class,
    Region::class,
    SpeciesOfSpecialization::class,
    Sponsor::class,
    TypeOfPractice::class,
], true));

it('allows admins every ability on every model', function (string $model) {
    $admin = policyAdmin();
    $instance = new $model;

    expect(Gate::forUser($admin)->check('viewAny', $model))->toBeTrue()
        ->and(Gate::forUser($admin)->check('view', $instance))->toBeTrue()
        ->and(Gate::forUser($admin)->check('create', $model))->toBeTrue()
        ->and(Gate::forUser($admin)->check('update', $instance))->toBeTrue()
        ->and(Gate::forUser($admin)->check('delete', $instance))->toBeTrue();
})->with($allModels);

it('lets members view public data but not modify it', function (string $model) {
    $member = policyMember();
    $instance = new $model;

    expect(Gate::forUser($member)->check('viewAny', $model))->toBeTrue()
        ->and(Gate::forUser($member)->check('view', $instance))->toBeTrue()
        ->and(Gate::forUser($member)->check('create', $model))->toBeFalse()
        ->and(Gate::forUser($member)->check('update', $instance))->toBeFalse()
        ->and(Gate::forUser($member)->check('delete', $instance))->toBeFalse();
})->with($viewableModels);

it('lets a member view and update only their own member profile', function () {
    $memberUser = policyMember();
    $own = $memberUser->member;
    $other = Member::factory()->create();

    expect(Gate::forUser($memberUser)->check('viewAny', Member::class))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('view', $own))->toBeTrue()
        ->and(Gate::forUser($memberUser)->check('view', $other))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('create', Member::class))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('update', $own))->toBeTrue()
        ->and(Gate::forUser($memberUser)->check('update', $other))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('delete', $own))->toBeFalse();
});

it('lets a member manage only their own addresses', function () {
    $memberUser = policyMember();
    $own = Address::factory()->create(['member_id' => $memberUser->member->id]);
    $other = Address::factory()->create();

    expect(Gate::forUser($memberUser)->check('viewAny', Address::class))->toBeTrue()
        ->and(Gate::forUser($memberUser)->check('view', $own))->toBeTrue()
        ->and(Gate::forUser($memberUser)->check('view', $other))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('create', Address::class))->toBeTrue()
        ->and(Gate::forUser($memberUser)->check('update', $own))->toBeTrue()
        ->and(Gate::forUser($memberUser)->check('update', $other))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('delete', $own))->toBeTrue()
        ->and(Gate::forUser($memberUser)->check('delete', $other))->toBeFalse();
});

it('lets a member view only their own attendance records', function () {
    $memberUser = policyMember();
    $own = Attendance::factory()->create(['member_id' => $memberUser->member->id]);
    $other = Attendance::factory()->create();

    expect(Gate::forUser($memberUser)->check('viewAny', Attendance::class))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('view', $own))->toBeTrue()
        ->and(Gate::forUser($memberUser)->check('view', $other))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('create', Attendance::class))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('update', $own))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('delete', $own))->toBeFalse();
});

it('lets a member view only their own service years', function () {
    $memberUser = policyMember();
    $own = MemberServiceYear::factory()->create(['member_id' => $memberUser->member->id]);
    $other = MemberServiceYear::factory()->create();

    expect(Gate::forUser($memberUser)->check('viewAny', MemberServiceYear::class))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('view', $own))->toBeTrue()
        ->and(Gate::forUser($memberUser)->check('view', $other))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('create', MemberServiceYear::class))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('update', $own))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('delete', $own))->toBeFalse();
});

it('denies members every ability on users', function () {
    $memberUser = policyMember();
    $target = User::factory()->create();

    expect(Gate::forUser($memberUser)->check('viewAny', User::class))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('view', $target))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('create', User::class))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('update', $target))->toBeFalse()
        ->and(Gate::forUser($memberUser)->check('delete', $target))->toBeFalse();
});
