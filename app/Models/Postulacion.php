<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';

    protected $fillable = [
        'user_id',
        'trabajo_id',
        'estado',
        'fecha_postulacion',
        'observaciones',
    ];

    protected $casts = [
        'fecha_postulacion' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trabajo()
    {
        return $this->belongsTo(Trabajo::class, 'trabajo_id');
    }
}
