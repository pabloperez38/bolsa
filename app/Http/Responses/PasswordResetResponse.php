<?php

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Contracts\PasswordResetResponse as PasswordResetResponseContract;

class PasswordResetResponse implements PasswordResetResponseContract
{
    public function toResponse($request): RedirectResponse
    {
        return redirect('/login')
            ->with(
                'success',
                '¡Tu contraseña se actualizó correctamente! Ya podés iniciar sesión.'
            );
    }
}
