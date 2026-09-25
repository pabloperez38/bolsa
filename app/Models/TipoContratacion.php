<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoContratacion extends Model
{
    protected $table = 'tipos_contratacion';

    protected $fillable = [
        'nombre',
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
        ];
    }

    /**
     * Un tipo de contratación puede tener muchas ofertas.
     */
    public function trabajos(): HasMany
    {
        return $this->hasMany(Trabajo::class, 'tipo_contratacion_id');
    }
}
