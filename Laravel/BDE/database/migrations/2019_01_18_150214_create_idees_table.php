<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idees', function (Blueprint $table) {
            $table->increments('id_idee');
            $table->string('nom_idee', 40);
            $table->string('description', 255);
            $table->integer('vote_idee');
            $table->integer('id_user');
            $table->integer('id_centre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idees');
    }
}
