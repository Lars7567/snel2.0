<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bedrijf', function (Blueprint $table) {
            $table->string('naam')->nullable()->change();
            $table->string('beschrijving_kort')->nullable()->change();
            $table->string('beschrijving_lang')->nullable()->change();
            $table->string('straat')->nullable()->change();
            $table->string('huisnummer')->nullable()->change();
            $table->string('plaats')->nullable()->change();
            $table->string('postcode')->nullable()->change();
            $table->string('telefoon')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('website')->nullable()->change();
            $table->string('socialmedia')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('bedrijf', function (Blueprint $table) {
            $table->string('naam')->nullable(false)->change();
            $table->string('beschrijving_kort')->nullable(false)->change();
            $table->string('beschrijving_lang')->nullable(false)->change();
            $table->string('straat')->nullable(false)->change();
            $table->string('huisnummer')->nullable(false)->change();
            $table->string('plaats')->nullable(false)->change();
            $table->string('postcode')->nullable(false)->change();
            $table->string('telefoon')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('website')->nullable(false)->change();
            $table->string('socialmedia')->nullable(false)->change();
        });
    }
};
