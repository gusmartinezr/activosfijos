<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baja extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'reason',
        'date',
        'activo_id',
    ];

    public function activo()
    {
        return $this->belongsTo(Activo::class);
    }
}
