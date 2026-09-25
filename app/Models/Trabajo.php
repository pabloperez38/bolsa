<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trabajo extends Model
{
    protected $fillable = [

        'titulo',
        'descripcion',
        'organizacion_id',
        'tipo_oferta_id',
        'categoria_id',
        'subcategoria_id',
        'ubicacion',
        'modalidad_id',
        'tipo_contratacion',
        'fecha_publicacion',
        'fecha_cierre',
        'activo',
    ];

    protected $casts = [
        'fecha_publicacion' => 'date',
        'fecha_cierre' => 'date',
        'destacado' => 'boolean',
        'activo' => 'boolean',
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

    public function modalidad(): BelongsTo
    {
        return $this->belongsTo(Modalidad::class, 'modalidad_id');
    }

    public function tipoOferta(): BelongsTo
    {
        return $this->belongsTo(TipoOferta::class, 'tipo_oferta_id');
    }
    public function tipoContratacion(): BelongsTo
    {
        return $this->belongsTo(
            TipoContratacion::class,
            'tipo_contratacion_id'
        );
    }
}
