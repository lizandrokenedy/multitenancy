<?php

namespace Database\Seeders;

use App\Services\ModuleService;
use Illuminate\Database\Seeder;

class ModulosAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                'name' => 'Usuários Administrativo',
                'status' => 1
            ],
            [
                'name' => 'Alunos Administrativo',
                'status' => 1
            ],
            [
                'name' => 'Avaliações Administrativo',
                'status' => 1
            ],
            [
                'name' => 'Escolas Administrativo',
                'status' => 1
            ],
            [
                'name' => 'Professores Administrativo',
                'status' => 1
            ],
            [
                'name' => 'Notas Administrativo',
                'status' => 1
            ],
        ];

        foreach ($modules as $module) {
            (new ModuleService())->createModuleAndPermissions($module);
        }
    }
}
