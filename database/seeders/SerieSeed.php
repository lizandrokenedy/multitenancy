<?php

namespace Database\Seeders;

use App\Models\Serie;
use Illuminate\Database\Seeder;

class SerieSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $series = [
            'Berçário',
            'Berçário - N1',
            'Berçário - N2',
            'Berçário - N3',
            '1º ano - Ensino Fundamental',
            '2º ano - Ensino Fundamental',
            '3º ano - Ensino Fundamental',
            '4º ano - Ensino Fundamental',
            '5º ano - Ensino Fundamental',
            '6º ano - Ensino Fundamental',
            '7º ano - Ensino Fundamental',
            '8º ano - Ensino Fundamental',
            '9º ano - Ensino Fundamental',
            '1º ano - Ensino Médio',
            '2º ano - Ensino Médio',
            '3º ano - Ensino Médio',
        ];

        foreach ($series as $serie) {
            Serie::create([
                'description' => $serie
            ]);
        }
    }
}
