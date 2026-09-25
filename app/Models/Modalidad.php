<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modalidad extends Model
{
    protected $table = 'modalidades';

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
     * Una modalidad puede tener muchas ofertas.
     */
    public function trabajos(): HasMany
    {
        return $this->hasMany(Trabajo::class, 'modalidad_id');
    }
}
