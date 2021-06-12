<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressTelephoneCellToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telephone', 100)->nullable(true);
            $table->string('cell', 100)->nullable(true);
            $table->unsignedBigInteger('address_id')->nullable(true);
            $table->foreign('address_id')->references('id')->on('adresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Schema::table('users', function (Blueprint $table) {
            // });
            $table->dropForeign('users_address_id_foreign');
            $table->dropColumn('telephone');
            $table->dropColumn('cell');
            $table->dropColumn('address_id');
        });
    }
}
