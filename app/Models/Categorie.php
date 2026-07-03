<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categorie';

    protected $fillable = [
        'categorie',
    ];

    public function bedrijven()
    {
        return $this->belongsToMany(Bedrijf::class, 'bedrijf_categorie', 'categorie_id', 'bedrijf_id');
    }
}
