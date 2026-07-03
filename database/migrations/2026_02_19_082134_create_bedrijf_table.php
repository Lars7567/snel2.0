<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bedrijf', function (Blueprint $table) {
            $table->id();
            $table->string('naam')->nullable();
            $table->string('afbeelding')->nullable();
            $table->string('beschrijving_kort')->nullable();
            $table->string('beschrijving_lang')->nullable();
            $table->string('straat')->nullable();
            $table->string('huisnummer')->nullable();
            $table->string('plaats')->nullable();
            $table->string('postcode')->nullable();
            $table->string('telefoon')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->foreignId('catogorie_id')->constrained('categorie')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bedrijfen');
    }
};
