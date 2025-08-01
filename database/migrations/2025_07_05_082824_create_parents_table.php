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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
             $table->string('nom_parent')->nullable();
            $table->string('prenom_parent')->nullable();
            $table->string('telephone')->nullable();
            $table->string('profession')->nullable();
            $table->bigInteger('utilisateur_id')->nullable();
             $table->text('adresse')->nullable();
            $table->string('email')->nullable();

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
        Schema::dropIfExists('parents');
    }
};
