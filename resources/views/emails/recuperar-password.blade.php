<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de contraseña</title>
</head>

<body style="margin:0;padding:0;background-color:#f4f6f8;font-family:Arial,Helvetica,sans-serif;color:#333333;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f6f8;padding:40px 15px;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="max-width:600px;width:100%;background-color:#ffffff;border-radius:8px;overflow:hidden;">

                    {{-- Encabezado --}}
                    <tr>
                        <td align="center" style="padding:30px;background-color:#ffffff;">
                            <h1 style="margin:0;font-size:24px;color:#333333;">
                                Bolsa de Trabajo UTN
                            </h1>
                        </td>
                    </tr>

                    {{-- Contenido --}}
                    <tr>
                        <td style="padding:40px;">

                            <h2 style="margin-top:0;margin-bottom:20px;font-size:22px;color:#333333;">
                                ¡Hola, {{ $usuario->name }}!
                            </h2>

                            <p style="font-size:16px;line-height:1.6;margin-bottom:20px;">
                                Recibimos una solicitud para restablecer la contraseña
                                de tu cuenta en la <strong>Bolsa de Trabajo UTN</strong>.
                            </p>

                            <p style="font-size:16px;line-height:1.6;margin-bottom:30px;">
                                Para elegir una nueva contraseña, hacé clic en el siguiente botón.
                            </p>

                            {{-- Botón --}}
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $resetUrl }}"
                                            style="display:inline-block;padding:14px 28px;background-color:#0d6efd;color:#ffffff;text-decoration:none;border-radius:6px;font-size:16px;font-weight:bold;">
                                            Restablecer mi contraseña
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin-top:30px;font-size:14px;line-height:1.6;color:#666666;">
                                Este enlace será válido durante
                                <strong>{{ config('auth.passwords.' . config('auth.defaults.passwords') . '.expire', 60) }}
                                    minutos</strong>.
                            </p>

                            <p style="font-size:14px;line-height:1.6;color:#666666;">
                                Si no solicitaste restablecer tu contraseña, podés ignorar
                                este mensaje. Tu contraseña actual seguirá siendo válida.
                            </p>

                            {{-- URL alternativa --}}
                            <p
                                style="margin-top:30px;padding-top:20px;border-top:1px solid #eeeeee;font-size:13px;line-height:1.5;color:#777777;">
                                Si el botón no funciona, copiá y pegá el siguiente
                                enlace en tu navegador:
                            </p>

                            <p style="word-break:break-all;font-size:12px;line-height:1.5;color:#666666;">
                                <a href="{{ $resetUrl }}" style="color:#0d6efd;">
                                    {{ $resetUrl }}
                                </a>
                            </p>

                        </td>
                    </tr>

                    {{-- Pie --}}
                    <tr>
                        <td align="center" style="padding:25px;background-color:#f8f9fa;border-top:1px solid #eeeeee;">

                            <p style="margin:0;font-size:13px;color:#777777;">
                                Bolsa de Trabajo UTN
                            </p>

                            <p style="margin:8px 0 0 0;font-size:12px;color:#999999;">
                                Este es un correo automático. Por favor, no respondas
                                a este mensaje.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
