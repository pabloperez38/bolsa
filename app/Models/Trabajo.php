<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
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
        'fecha_publicacion' => 'date',
        'fecha_cierre' => 'date',
        'destacado' => 'boolean',
        'activo' => 'boolean',
    ];

    public function fechaCierreVencimiento(): ?Carbon
    {
        return $this->fecha_cierre?->copy()->endOfDay();
    }

    public function fechaCierreVigente(): bool
    {
        $vencimiento = $this->fechaCierreVencimiento();

        return $vencimiento === null || $vencimiento->isFuture();
    }

    public function diasRestantes(): int
    {
        $vencimiento = $this->fechaCierreVencimiento();

        if ($vencimiento === null || !$vencimiento->isFuture()) {
            return 0;
        }

        return (int) ceil(now()->diffInHours($vencimiento) / 24);
    }

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
