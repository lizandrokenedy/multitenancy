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
                'email' => 'admin@gmail.com',
                'admin' => true,
            ],
            [
                'name' => 'Administrador Gestor',
                'email' => 'admingestor@gmail.com',
                'admin' => false,
                'role' => 1,
            ],
            [
                'name' => 'Administrador Escola',
                'email' => 'adminescola@gmail.com',
                'admin' => false,
                'role' => 2,
            ],
            [
                'name' => 'Professor',
                'email' => 'professor@gmail.com',
                'admin' => false,
                'role' => 3
            ],
            [
                'name' => 'Aluno',
                'email' => 'aluno@gmail.com',
                'admin' => false,
                'role' => 4
            ],
        ];

        foreach ($users as $user) {
            $data = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('12345678'),
                'admin' => $user['admin']
            ]);
            if (!$data->admin) {
                $data->roles()->sync($user['role']);
            }
        }
    }
}
