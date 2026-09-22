<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organizacion extends Model
{
    protected $table = 'organizaciones';

    protected $fillable = [
        'nombre',
        'descripcion',
        'logo',
        'email',
        'telefono',
        'sitio_web',
        'direccion',
        'localidad',
        'provincia',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Una organización puede tener muchos trabajos.
     */
    public function trabajos(): HasMany
    {
        return $this->hasMany(Trabajo::class);
    }
}
