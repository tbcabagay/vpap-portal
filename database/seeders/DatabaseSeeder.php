<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            CountrySeeder::class,
            RegionSeeder::class,
            ProvinceSeeder::class,
            MunicipalitySeeder::class,
            SponsorSeeder::class,
            InstitutionSeeder::class,
            SpeciesOfSpecializationSeeder::class,
            TypeOfPracticeSeeder::class,
            MemberSeeder::class,
            EventSeeder::class,
            EventFeeSeeder::class,
            AnnouncementSeeder::class,
            AddressSeeder::class,
            AttendanceSeeder::class,
            MemberServiceYearSeeder::class,
        ]);
    }
}
