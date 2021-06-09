<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'ADMIN OVERLORD',
                'description' => 'Full access GERAL',
                'permissions' => [1,2,3,4]
            ],
            // [
            //     'name' => 'ADMIN GESTOR PÚBLICO',
            //     'description' => 'Full access aos perfis: ADMIN ESCOLA / PROFESSOR / ALUNOS',
            //     'permissions' => [5, 6, 7, 8, 13, 14, 15, 16, 17, 18, 19, 20]
            // ],
            // [
            //     'name' => 'ADMIN ESCOLA',
            //     'description' => 'Full access aos perfis: PROFESSOR / ALUNOS / AMBIENTE DE
            //     AVALIAÇÕES',
            //     'permissions' => [5, 6, 7, 8, 9, 10, 11, 12, 17, 18, 19, 20]
            // ],
            // [
            //     'name' => 'PERFIL PROFESSOR',
            //     'description' => 'Acesso aos perfis dos alunos designados pela coordenação apenas para visualizar. Acesso ao ambiente de avaliações',
            //     'permissions' => [5, 6, 7, 8, 9, 10, 11, 12]
            // ],
        ];

        foreach ($roles as $role) {
            $roleCreated = Role::create($role);
            $roleCreated->sync($role['permissions']);
        }
    }
}
