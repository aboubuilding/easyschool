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
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();

            $table->string('matricule')->unique();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->bigInteger('utilisateur_id')->nullable();
            $table->date('date_naissance')->nullable();
             $table->string('lieu_naissance')->nullable();
            $table->tinyInteger('sexe')->nullable();
             $table->string('photo')->nullable();
               $table->bigInteger('parent_id')->nullable();

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
        Schema::dropIfExists('eleves');
    }
};
