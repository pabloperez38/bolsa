<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Localidad;


class Perfil extends Model
{
    protected $table = 'perfiles';

    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'dni',
        'telefono',
        'fecha_nacimiento',
        'direccion',
        'localidad_id',
        'biografia',
        'foto',
        'cv',
        'linkedin',
        'legajo',
        'carrera_id',
        'materias_aprobadas',
        'github',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    /**
     * Usuario propietario del perfil.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function localidad(): BelongsTo
    {
        return $this->belongsTo(Localidad::class, 'localidad_id');
    }
    public function estaCompleto(): bool
    {
        return !empty($this->legajo)
            && !empty($this->direccion)
            && !empty($this->dni)
            && !empty($this->localidad)
            && !empty($this->telefono);
    }
    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }
}
