<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etf extends Model
{
  use HasFactory;
    protected $fillable = [
        'naam',
        'prijs',
        'omschrijving',
        'foto_url',
    ];
}

