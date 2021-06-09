<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->count(500000)->create();
        $users = [
            [
                'name' => 'Administrador',
                'email' => 'lizandrokenedy@gmail.com',
                'password' => Hash::make('12345678'),
            ]
        ];

        foreach($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
