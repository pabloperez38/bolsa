<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrera extends Model
{
    protected $table = 'carreras';

    protected $fillable = [
        'nombre',
        'activo',
    ];

    public function perfiles(): HasMany
    {
        return $this->hasMany(Perfil::class);
    }
}
