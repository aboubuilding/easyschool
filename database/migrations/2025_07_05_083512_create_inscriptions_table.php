<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();

             $table->bigInteger('eleve_id')->nullable();
            $table->bigInteger('cycle_id')->nullable();
            $table->bigInteger('niveau_id')->nullable();
            $table->bigInteger('classe_id')->nullable();
            $table->bigInteger('annee_id')->nullable();
            $table->date('date_inscription')->nullable();
            $table->tinyInteger('statut')->nullable();
            $table->integer('etat')->default(1);

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
        Schema::dropIfExists('inscriptions');
    }
};
