<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $table = 'empresas';

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
