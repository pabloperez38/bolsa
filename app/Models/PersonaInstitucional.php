<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function usuario(): HasOne
    {
        return $this->hasOne(
            User::class,
            'persona_institucional_id'
        );
    }
}
