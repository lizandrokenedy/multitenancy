<?php

namespace Database\Seeders;

use App\Models\AbdominalResistanceStatus;
use Illuminate\Database\Seeder;

class AbdominalResistanceStatusSeed extends Seeder
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
            AbdominalResistanceStatus::create(['description' => $status]);
        }
    }
}
