<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProprietairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proprietaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->integer('contact');
            $table->string('emailto');
            $table->string('adresse');
            $table->string('sexe');
            $table->string('numero_piece');
            $table->string('type_piece');
            $table->string('image_piece')->nullable();
            $table->string('photo')->nullable();
            $table->string('document')->nullable();
            $table->boolean('activ')->nullable();
            $table->integer('contact2')->nullable();
            $table->integer('contact_telephone')->nullable();
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
        Schema::dropIfExists('proprietaires');
    }
}
