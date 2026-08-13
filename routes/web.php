<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventFeeController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberServiceYearController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SpeciesOfSpecializationController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\TypeOfPracticeController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');

    Route::resource('countries', CountryController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('regions', RegionController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('provinces', ProvinceController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('municipalities', MunicipalityController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('sponsors', SponsorController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('institutions', InstitutionController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('species-of-specializations', SpeciesOfSpecializationController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('type-of-practices', TypeOfPracticeController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('announcements', AnnouncementController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('events', EventController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('event-fees', EventFeeController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('members', MemberController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('addresses', AddressController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('attendances', AttendanceController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('member-service-years', MemberServiceYearController::class)->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
});

require __DIR__.'/settings.php';
