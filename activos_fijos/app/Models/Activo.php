<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'description',
        'initial_amount',
    ];

    public function bajas()
    {
        return $this->hasMany(Baja::class);
    }
    public function stockActual()
    {
        $totalBajas = $this->bajas()->sum('quantity');
        return $this->initial_amount - $totalBajas;
    }
}
