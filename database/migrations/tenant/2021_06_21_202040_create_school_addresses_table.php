<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_address', function (Blueprint $table) {
            $table->id();
            $table->string('address', 255);
            $table->string('district', 255);
            $table->integer('number');
            $table->string('complement', 255)->nullable(true);
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('school_id');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('school_address', function (Blueprint $table) {
        //     $table->dropForeign('school_address_school_id_foreign');
        //     $table->dropForeign('school_address_city_id_foreign');
        //     $table->dropForeign('school_address_state_id_foreign');
        // });
        Schema::dropIfExists('school_address');
    }
}
