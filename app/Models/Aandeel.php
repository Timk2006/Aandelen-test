<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aandeel extends Model
{
    use HasFactory;
    protected $table = 'aandelen';
    protected $fillable = [
        'naam',
        'prijs',
        'omschrijving',
        'foto_url',
    ];
}
