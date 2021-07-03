<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            StateAndCitySeed::class,
            ModulosAndPermissionsSeed::class,
            RoleSeed::class,
            UserSeed::class,
            FlexibilityStatusSeed::class,
            AbdominalResistanceStatusSeed::class,
            SerieSeed::class,
            PeriodSeed::class,
            // SchoolSeed::class,
        ]);
    }
}
