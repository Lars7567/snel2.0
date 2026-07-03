<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bevestiging extends Model
{
    protected $table = 'bevestigingen';

    protected $fillable = ['titel', 'data'];

    protected $casts = [
        'data' => 'array',
    ];
}
