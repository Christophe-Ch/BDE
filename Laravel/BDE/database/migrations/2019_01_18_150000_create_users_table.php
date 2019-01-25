<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('prenom', 40)->nullable();
            $table->string('email', 255);
            $table->string('password');
            $table->string('photo', 255)->nullable();
            $table->integer('centre_id')->nullable();
            $table->integer('statut_id')->nullable();
            $table->string('api_token', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
