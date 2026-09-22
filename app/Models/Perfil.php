<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'localidad',
        'provincia',
        'biografia',
        'foto',
        'cv',
        'linkedin',
        'sitio_web',
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
}
