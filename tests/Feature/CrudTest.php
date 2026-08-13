<?php

use App\Enums\Role;
use App\Models\Event;
use App\Models\Member;
use App\Models\Province;
use App\Models\Region;
use App\Models\SpeciesOfSpecialization;
use App\Models\TypeOfPractice;
use App\Models\User;
use Database\Seeders\RoleSeeder;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\seed;

beforeEach(function () {
    seed(RoleSeeder::class);
});

function crudAdmin(): User
{
    $admin = User::factory()->create();

    $admin->assignRole(Role::Admin->value);

    return $admin;
}

$crudScenarios = [
    'countries' => [
        'route' => 'countries',
        'makeStore' => fn () => ['name' => 'Testland'],
        'makeUpdate' => fn () => ['name' => 'Testland Updated'],
    ],
    'regions' => [
        'route' => 'regions',
        'makeStore' => fn () => ['name' => 'Test Region'],
        'makeUpdate' => fn () => ['name' => 'Test Region Updated'],
    ],
    'provinces' => [
        'route' => 'provinces',
        'makeStore' => fn () => ['name' => 'Test Province', 'region_id' => Region::factory()->create()->id],
        'makeUpdate' => fn () => ['name' => 'Test Province Updated', 'region_id' => Region::factory()->create()->id],
    ],
    'municipalities' => [
        'route' => 'municipalities',
        'makeStore' => fn () => ['name' => 'Test Municipality', 'province_id' => Province::factory()->create()->id],
        'makeUpdate' => fn () => ['name' => 'Test Municipality Updated', 'province_id' => Province::factory()->create()->id],
    ],
    'sponsors' => [
        'route' => 'sponsors',
        'makeStore' => fn () => ['name' => 'Test Sponsor'],
        'makeUpdate' => fn () => ['name' => 'Test Sponsor Updated'],
    ],
    'institutions' => [
        'route' => 'institutions',
        'makeStore' => fn () => ['name' => 'Test Institution'],
        'makeUpdate' => fn () => ['name' => 'Test Institution Updated'],
    ],
    'species-of-specializations' => [
        'route' => 'species-of-specializations',
        'makeStore' => fn () => ['name' => 'Cats'],
        'makeUpdate' => fn () => ['name' => 'Cats Updated'],
    ],
    'type-of-practices' => [
        'route' => 'type-of-practices',
        'makeStore' => fn () => ['name' => 'General Practice'],
        'makeUpdate' => fn () => ['name' => 'General Practice Updated'],
    ],
    'announcements' => [
        'route' => 'announcements',
        'makeStore' => fn () => ['title' => 'Hello', 'content' => 'Body'],
        'makeUpdate' => fn () => ['title' => 'Hello Updated', 'content' => 'Body Updated'],
    ],
    'events' => [
        'route' => 'events',
        'makeStore' => fn () => [
            'type_id' => 'seminar_workshop',
            'invitation_type_id' => 'open',
            'title' => 'Vet Conference',
            'location' => 'Manila',
            'start_date' => '2026-01-01',
            'end_date' => '2026-02-01',
            'discount_enabled' => true,
            'membership_fee' => 1000,
            'total_cpd_points' => 10.5,
            'maximum_participants' => 100,
        ],
        'makeUpdate' => fn () => [
            'type_id' => 'annual_conference',
            'invitation_type_id' => 'members_only',
            'title' => 'Vet Conference Updated',
            'location' => 'Cebu',
            'start_date' => '2026-03-01',
            'end_date' => '2026-04-01',
            'discount_enabled' => false,
            'membership_fee' => 1500,
            'total_cpd_points' => 12,
            'maximum_participants' => 200,
        ],
    ],
    'event-fees' => [
        'route' => 'event-fees',
        'makeStore' => fn () => ['event_id' => Event::factory()->create()->id, 'member_type_id' => 'regular', 'amount' => 500],
        'makeUpdate' => fn () => ['event_id' => Event::factory()->create()->id, 'member_type_id' => 'lifetime', 'amount' => 750],
    ],
    'members' => [
        'route' => 'members',
        'makeStore' => fn () => ['user_id' => User::factory()->create()->id, 'first_name' => 'Juan', 'last_name' => 'Dela Cruz'],
        'makeUpdate' => fn () => ['user_id' => User::factory()->create()->id, 'first_name' => 'Juana', 'last_name' => 'Dela Cruz'],
    ],
    'addresses' => [
        'route' => 'addresses',
        'makeStore' => fn () => ['member_id' => Member::factory()->create()->id, 'type' => 'home', 'address' => '123 Mabini St'],
        'makeUpdate' => fn () => ['member_id' => Member::factory()->create()->id, 'type' => 'office', 'address' => '456 Rizal Ave'],
    ],
    'attendances' => [
        'route' => 'attendances',
        'makeStore' => fn () => [
            'member_id' => Member::factory()->create()->id,
            'event_id' => Event::factory()->create()->id,
            'payment_status' => 'paid',
            'attendance_status' => 'present',
        ],
        'makeUpdate' => fn () => [
            'member_id' => Member::factory()->create()->id,
            'event_id' => Event::factory()->create()->id,
            'payment_status' => 'pending',
            'attendance_status' => 'late',
        ],
    ],
    'member-service-years' => [
        'route' => 'member-service-years',
        'makeStore' => fn () => ['member_id' => Member::factory()->create()->id, 'year' => '2026'],
        'makeUpdate' => fn () => ['member_id' => Member::factory()->create()->id, 'year' => '2025'],
    ],
];

it('lets admins complete CRUD on every resource', function (string $route, callable $makeStore, callable $makeUpdate) {
    actingAs(crudAdmin());

    $store = $this->postJson("/$route", $makeStore());
    $store->assertCreated();
    $id = $store->json('data.id');

    $this->getJson("/$route/$id")->assertOk();

    $this->putJson("/$route/$id", $makeUpdate())->assertOk();

    $this->deleteJson("/$route/$id")->assertNoContent();

    $this->getJson("/$route/$id")->assertNotFound();
})->with($crudScenarios);

it('renders create and edit pages through inertia', function (string $route, callable $makeStore, callable $makeUpdate) {
    actingAs(crudAdmin());

    $inertiaHeaders = [
        'X-Inertia' => true,
        'X-Inertia-Version' => hash_file('xxh128', public_path('build/manifest.json')),
    ];

    $this->get("/$route/create", $inertiaHeaders)
        ->assertOk()
        ->assertJsonPath('component', "$route/create");

    $id = $this->postJson("/$route", $makeStore())->json('data.id');

    $this->get("/$route/$id/edit", $inertiaHeaders)
        ->assertOk()
        ->assertJsonPath('component', "$route/edit");
})->with($crudScenarios);

it('denies members from creating admin-only resources', function () {
    $user = User::factory()->create();
    $user->assignRole(Role::Member->value);
    actingAs($user);

    $this->postJson('/events', [])->assertForbidden();
    $this->postJson('/members', [])->assertForbidden();
    $this->postJson('/announcements', [])->assertForbidden();
});

it('lets members create their own addresses', function () {
    $user = User::factory()->create();
    $user->assignRole(Role::Member->value);
    $member = Member::factory()->create(['user_id' => $user->id]);
    actingAs($user);

    $this->postJson('/addresses', ['member_id' => $member->id, 'type' => 'home'])
        ->assertCreated()
        ->assertJsonPath('data.member_id', $member->id);
});

it('stamps created_by and updated_by on announcements', function () {
    $admin = crudAdmin();
    actingAs($admin);

    $response = $this->postJson('/announcements', ['title' => 'Hi', 'content' => 'Body']);

    $response->assertCreated()
        ->assertJsonPath('data.created_by', $admin->id)
        ->assertJsonPath('data.updated_by', $admin->id);
});

it('syncs species and practice pivots on members', function () {
    actingAs(crudAdmin());

    $species = SpeciesOfSpecialization::factory()->create();
    $practice = TypeOfPractice::factory()->create();

    $store = $this->postJson('/members', [
        'user_id' => User::factory()->create()->id,
        'first_name' => 'Juan',
        'last_name' => 'Dela Cruz',
        'species_of_specializations' => [$species->id],
        'type_of_practices' => [$practice->id],
    ]);
    $store->assertCreated();

    $member = Member::findOrFail($store->json('data.id'));

    expect($member->speciesOfSpecializations()->count())->toBe(1)
        ->and($member->typeOfPractices()->count())->toBe(1);
});
