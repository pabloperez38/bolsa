<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoOferta extends Model
{
    /**
     * Nombre de la tabla.
     */
    protected $table = 'tipos_oferta';

    /**
     * Campos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'nombre',
        'activo',
    ];

    /**
     * Conversión de tipos.
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    /**
     * Relación:
     * Un tipo de oferta puede tener muchas ofertas laborales.
     */
    public function trabajos(): HasMany
    {
        return $this->hasMany(Trabajo::class, 'tipo_oferta_id');
    }
}
