<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Trabajo extends Model
{
    use SoftDeletes;

    protected $table = 'trabajos';

    protected $fillable = [

        'titulo',
        'descripcion',
        'Empresa_id',
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
        'fecha_publicacion' => 'datetime',
        'fecha_cierre' => 'datetime',
        'destacado' => 'boolean',
        'activo' => 'boolean',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
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

    public function getSlugAttribute()
    {
        return Str::slug($this->titulo);
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'trabajo_id');
    }
}
