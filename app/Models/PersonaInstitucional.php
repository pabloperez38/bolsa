<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonaInstitucional extends Model
{
    use SoftDeletes;
    
    protected $table = 'personas_institucionales';

    protected $fillable = [
        'dni',
        'legajo',
        'nombre',
        'apellido',
        'tipo',
        'carrera',
        'materias_aprobadas',
        'activo',
    ];

    protected $casts = [
        'materias_aprobadas' => 'integer',
        'activo' => 'boolean',
    ];
}
