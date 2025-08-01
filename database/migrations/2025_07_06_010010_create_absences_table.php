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
        Schema::create('absences', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('eleve_id')->nullable();
            $table->date('date_absence');
            $table->time('heure_absence')->nullable();
            $table->boolean('retard')->default(false);
            $table->text('motif')->nullable();
            $table->boolean('justifiee')->default(false);

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
        Schema::dropIfExists('absences');
    }
};
