<?php

namespace Database\Seeders;

use App\Models\FlexibilityStatus;
use Illuminate\Database\Seeder;

class FlexibilityStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Não Avaliar',
            'Regular',
            'Bom',
            'Ótima'
        ];

        foreach ($data as $status) {
            FlexibilityStatus::create(['description' => $status]);
        }
    }
}
