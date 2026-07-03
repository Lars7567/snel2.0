<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite ondersteunt geen DROP COLUMN op foreign-key tabellen, dus tabel herbouwen
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
            "clicks"            integer NOT NULL DEFAULT \'0\',
            "created_at"        datetime,
            "updated_at"        datetime
        )');

        DB::statement('INSERT INTO "bedrijf_new"
            SELECT "id", "naam", "afbeelding", "beschrijving_kort", "beschrijving_lang",
                   "straat", "huisnummer", "plaats", "postcode", "telefoon", "email",
                   "website", NULL, NULL, NULL, "clicks", "created_at", "updated_at"
            FROM "bedrijf"');

        DB::statement('DROP TABLE "bedrijf"');
        DB::statement('ALTER TABLE "bedrijf_new" RENAME TO "bedrijf"');

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
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
            "socialmedia"       varchar,
            "clicks"            integer NOT NULL DEFAULT \'0\',
            "created_at"        datetime,
            "updated_at"        datetime
        )');

        DB::statement('INSERT INTO "bedrijf_new"
            SELECT "id", "naam", "afbeelding", "beschrijving_kort", "beschrijving_lang",
                   "straat", "huisnummer", "plaats", "postcode", "telefoon", "email",
                   "website", NULL, "clicks", "created_at", "updated_at"
            FROM "bedrijf"');

        DB::statement('DROP TABLE "bedrijf"');
        DB::statement('ALTER TABLE "bedrijf_new" RENAME TO "bedrijf"');

        Schema::enableForeignKeyConstraints();
    }
};
