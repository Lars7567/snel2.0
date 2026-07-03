<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bedrijf extends Model
{
    protected $table = 'bedrijf';
    protected $fillable = [
        'naam',
        'afbeelding',
        'beschrijving_kort',
        'beschrijving_lang',
        'straat',
        'huisnummer',
        'plaats',
        'postcode',
        'telefoon',
        'gsm',
        'email',
        'website',
        'facebook',
        'linkedin',
        'instagram',
        'clicks',
    ];

    public function categorieen()
    {
        return $this->belongsToMany(Categorie::class, 'bedrijf_categorie', 'bedrijf_id', 'categorie_id');
    }
}
