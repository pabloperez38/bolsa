<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
{
    use SoftDeletes;

    protected $table = 'subcategorias';

    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'activo',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}
