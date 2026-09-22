<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trabajo extends Model
{
    protected $fillable = [

        'titulo',
        'organizacion_id',
        'descripcion',

        'categoria_id',
        'subcategoria_id',

        'ubicacion',
        'modalidad',
        'tipo_contratacion',

        'salario_minimo',
        'salario_maximo',
        'moneda',

        'fecha_publicacion',
        'fecha_cierre',

        'destacado',
        'activo',
    ];

    protected $casts = [
        'fecha_publicacion' => 'date',
        'fecha_cierre' => 'date',
        'destacado' => 'boolean',
        'activo' => 'boolean',
        'salario_minimo' => 'decimal:2',
        'salario_maximo' => 'decimal:2',
    ];

    public function organizacion(): BelongsTo
    {
        return $this->belongsTo(Organizacion::class);
    }

    // ==========================================
    // RELACIÓN CON CATEGORÍA
    // ==========================================

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    // ==========================================
    // RELACIÓN CON SUBCATEGORÍA
    // ==========================================

    public function subcategoria(): BelongsTo
    {
        return $this->belongsTo(Subcategoria::class);
    }
}
