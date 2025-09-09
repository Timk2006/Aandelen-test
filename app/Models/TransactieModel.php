<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactieModel extends Model
{
    use HasFactory;

    protected $table = 'transacties';

    protected $fillable = [
        'user_id',
        'aandeel_id',
        'aantal',
        'prijs_per_stuk',
        'type', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aandeel()
    {
        return $this->belongsTo(Aandeel::class);
    }
}
