<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Services\RoleService;
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
                'name' => 'ADMIN GESTOR PÚBLICO',
                'description' => 'Full access aos perfis: ADMIN ESCOLA / PROFESSOR / ALUNOS / USUÁRIOS (ADMIN ESCOLA e ALUNOS)',
                'permissions' => [
                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 25, 26, 27, 28
                ]
            ],
            [
                'name' => 'ADMIN ESCOLA',
                'description' => 'Full access aos perfis: PROFESSOR / ALUNOS / USUÁRIOS (ALUNOS) / AMBIENTE DE AVALIAÇÕES',
                'permissions' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 17, 18, 19, 20]
            ],
            [
                'name' => 'PROFESSOR',
                'description' => 'Acesso aos perfis dos alunos designados pela coordenação apenas para visualizar. Acesso ao ambiente de avaliações',
                'permissions' => [5, 6, 7, 8, 9, 10, 11, 12]
            ],
            [
                'name' => 'ALUNO',
                'description' => 'Consulta ao ambiente de avaliações',
                'permissions' => [10]
            ],
        ];

        foreach ($roles as $role) {
            $data = Role::create([
                'name' => $role['name'],
                'description' => $role['description']
            ]);

            $data->permissions()->attach($role['permissions']);
        }
    }
}
