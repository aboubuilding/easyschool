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
        Schema::create('devoirs', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('classe_id')->nullable();
            $table->bigInteger('matiere_id')->nullable();
            $table->bigInteger('enseignant_id')->nullable();
            $table->text('contenu');
            $table->date('date_rendu');
            $table->tinyInteger('type')->nullable(); // devoir, contrôle, examen

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
        Schema::dropIfExists('devoirs');
    }
};
