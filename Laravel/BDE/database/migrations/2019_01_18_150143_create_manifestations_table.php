<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManifestationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifestations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom', 40);
            $table->string('description', 255);
            $table->dateTime('date');
            $table->integer('prix');
            $table->string('photo', 255);
            $table->string('recurrence', 255);
            $table->integer('centre_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manifestations');
    }
}
