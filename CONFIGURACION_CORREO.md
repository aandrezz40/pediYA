# Configuración de Correo para PediYÁ

## Configuración del archivo .env

Para que el formulario de contacto funcione correctamente, necesitas configurar las siguientes variables en tu archivo `.env`:

```env
# Configuración de correo para Gmail
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-correo@gmail.com
MAIL_PASSWORD=tu-contraseña-de-aplicación
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu-correo@gmail.com
MAIL_FROM_NAME="PediYÁ"
```

## Pasos para configurar Gmail:

### 1. Habilitar verificación en dos pasos
- Ve a tu cuenta de Google
- Activa la verificación en dos pasos

### 2. Generar contraseña de aplicación
- Ve a "Seguridad" en tu cuenta de Google
- Busca "Contraseñas de aplicación"
- Genera una nueva contraseña para "Correo"
- Usa esta contraseña en `MAIL_PASSWORD`

### 3. Configurar el archivo .env
- Copia las variables de arriba en tu archivo `.env`
- Reemplaza `tu-correo@gmail.com` con tu correo real
- Reemplaza `tu-contraseña-de-aplicación` con la contraseña generada

### 4. Limpiar caché
```bash
php artisan config:clear
php artisan cache:clear
```

## Configuración alternativa para desarrollo:

Si solo quieres probar en desarrollo, puedes usar:

```env
MAIL_MAILER=log
```

Esto guardará los correos en `storage/logs/laravel.log` en lugar de enviarlos.

## Verificar configuración:

Para verificar que todo funciona:

1. Envía un mensaje desde el formulario de contacto
2. Revisa los logs en `storage/logs/laravel.log`
3. Si usas Gmail, revisa tu bandeja de entrada

## Solución de problemas:

- **Error de autenticación**: Verifica que la contraseña de aplicación sea correcta
- **Error de conexión**: Verifica que el puerto 587 esté abierto
- **Correo no llega**: Revisa la carpeta de spam
- **Error en logs**: Revisa `storage/logs/laravel.log` para más detalles 