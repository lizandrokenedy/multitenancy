<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;

class StateAndCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fileData = file_get_contents(__DIR__ . '/StateAndCity.json');
        $data = json_decode($fileData);

        foreach ($data->estados as $state) {
            $stateCreated = State::create([
                'name' => $state->nome,
                'uf' => $state->sigla
            ]);

            foreach ($state->cidades as $city) {
                City::create([
                    'name' => $city,
                    'state_id' => $stateCreated->id
                ]);
            }
        }
    }
}
