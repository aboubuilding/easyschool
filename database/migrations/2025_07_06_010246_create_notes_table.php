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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('eleve_id')->nullable();
            $table->bigInteger('matiere_id')->nullable();
            $table->bigInteger('enseignant_id')->nullable();
            $table->bigInteger('devoir_id')->nullable();
            $table->decimal('valeur', 5, 2);
           
            $table->date('date_note');

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
        Schema::dropIfExists('notes');
    }
};
