<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periods = [
            'Matutino',
            'Vespertino',
            'Noturno',
        ];

        foreach ($periods as $period) {
            Period::create([
                'description' => $period
            ]);
        }
    }
}
