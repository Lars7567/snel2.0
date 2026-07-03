<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Opruimen als de migratie eerder halverwege is mislukt
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('bedrijf_categorie');
        Schema::enableForeignKeyConstraints();

        // 1. Maak de pivot-tabel aan
        Schema::create('bedrijf_categorie', function (Blueprint $table) {
            $table->unsignedBigInteger('bedrijf_id');
            $table->unsignedBigInteger('categorie_id');
            $table->primary(['bedrijf_id', 'categorie_id']);
            $table->foreign('bedrijf_id')->references('id')->on('bedrijf')->onDelete('cascade');
            $table->foreign('categorie_id')->references('id')->on('categorie')->onDelete('cascade');
        });

        // 2. Migreer bestaande catogorie_id waarden naar de pivot-tabel
        $bedrijven = DB::table('bedrijf')->select('id', 'catogorie_id')->get();
        foreach ($bedrijven as $bedrijf) {
            if ($bedrijf->catogorie_id) {
                DB::table('bedrijf_categorie')->insert([
                    'bedrijf_id'   => $bedrijf->id,
                    'categorie_id' => $bedrijf->catogorie_id,
                ]);
            }
        }

        // 3. Herbouw de bedrijf-tabel zonder catogorie_id
        // (SQLite staat geen DROP COLUMN toe op kolommen met een foreign key)
        Schema::disableForeignKeyConstraints();

        DB::statement('CREATE TABLE "bedrijf_new" (
            "id"                integer  NOT NULL PRIMARY KEY AUTOINCREMENT,
            "naam"              varchar,
            "afbeelding"        varchar,
            "beschrijving_kort" varchar,
            "beschrijving_lang" varchar,
            "straat"            varchar,
            "huisnummer"        varchar,
            "plaats"            varchar,
            "postcode"          varchar,
            "telefoon"          varchar,
            "email"             varchar,
            "website"           varchar,
            "facebook"          varchar,
            "linkedin"          varchar,
            "instagram"         varchar,
            "clicks"            integer  NOT NULL DEFAULT \'0\',
            "created_at"        datetime,
            "updated_at"        datetime
        )');

        DB::statement('INSERT INTO "bedrijf_new"
            SELECT "id", "naam", "afbeelding", "beschrijving_kort", "beschrijving_lang",
                   "straat", "huisnummer", "plaats", "postcode", "telefoon", "email",
                   "website", "facebook", "linkedin", "instagram", "clicks", "created_at", "updated_at"
            FROM "bedrijf"');

        DB::statement('DROP TABLE "bedrijf"');
        DB::statement('ALTER TABLE "bedrijf_new" RENAME TO "bedrijf"');

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::table('bedrijf', function (Blueprint $table) {
            $table->unsignedBigInteger('catogorie_id')->nullable();
        });

        $pivots = DB::table('bedrijf_categorie')->get();
        foreach ($pivots as $pivot) {
            DB::table('bedrijf')
                ->where('id', $pivot->bedrijf_id)
                ->update(['catogorie_id' => $pivot->categorie_id]);
        }

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('bedrijf_categorie');
        Schema::enableForeignKeyConstraints();
    }
};
