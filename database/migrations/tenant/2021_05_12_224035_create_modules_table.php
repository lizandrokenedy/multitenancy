<?php

use App\Services\UserService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status');
            $table->timestamps();
        });

        $this->createUserAdminDefault();
    }

    private function createUserAdminDefault()
    {
        return (new UserService())->create([
            'name' => 'Administrador',
            'email' => 'lizandrokenedy@gmail.com',
            'password' => '12345678',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
