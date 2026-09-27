<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_usuario_id',
        'persona_institucional_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tipoUsuario(): BelongsTo
    {
        return $this->belongsTo(TipoUsuario::class, 'tipo_usuario_id');
    }

    /**
     * Perfil del usuario.
     */
    public function perfil(): HasOne
    {
        return $this->hasOne(Perfil::class, 'user_id');
    }

    /**
     * Persona institucional asociada al usuario.
     */
    public function personaInstitucional(): BelongsTo
    {
        return $this->belongsTo(
            PersonaInstitucional::class,
            'persona_institucional_id'
        );
    }
}
