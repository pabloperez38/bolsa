<?php

namespace App\Models;

use App\Notifications\VerificarEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_usuario_id',
        'google_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Tipo de usuario.
     */
    public function tipoUsuario(): BelongsTo
    {
        return $this->belongsTo(
            TipoUsuario::class,
            'tipo_usuario_id'
        );
    }

    /**
     * Perfil del usuario.
     */
    public function perfil(): HasOne
    {
        return $this->hasOne(
            Perfil::class,
            'user_id'
        );
    }

    /**
     * Enviar notificación personalizada
     * para verificar el correo electrónico.
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerificarEmail());
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'user_id');
    }

    public function empresa()
    {
        return $this->hasOne(Empresa::class, 'user_id');
    }
}
