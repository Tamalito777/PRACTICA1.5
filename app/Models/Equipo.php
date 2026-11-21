<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';

    protected $fillable = [
        'codigo',
        'nombre',
        'especificaciones',
        'estado',
    ];

    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class, 'equipo_id', 'id');
    }
}