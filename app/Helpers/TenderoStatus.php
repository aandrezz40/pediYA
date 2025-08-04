<?php

namespace App\Helpers;

class TenderoStatus
{
    // Estados del tendero
    const PENDING_APPROVAL = 0;    // Pendiente de aprobación
    const ACTIVE = 1;              // Activo y aprobado
    const PENDING_STORE_REGISTRATION = 2; // Pendiente de registro de tienda
    const SUSPENDED = 3;           // Suspendido

    /**
     * Verificar si el tendero puede acceder a funcionalidades completas
     */
    public static function canAccessFullFeatures($user): bool
    {
        return $user->is_active === self::ACTIVE;
    }

    /**
     * Verificar si el tendero necesita registrar su tienda
     */
    public static function needsStoreRegistration($user): bool
    {
        return $user->is_active === self::PENDING_STORE_REGISTRATION;
    }

    /**
     * Verificar si el tendero está pendiente de aprobación
     */
    public static function isPendingApproval($user): bool
    {
        return $user->is_active === self::PENDING_APPROVAL;
    }

    /**
     * Verificar si el tendero está suspendido
     */
    public static function isSuspended($user): bool
    {
        return $user->is_active === self::SUSPENDED;
    }

    /**
     * Obtener el mensaje de estado para el usuario
     */
    public static function getStatusMessage($user): string
    {
        return match ($user->is_active) {
            self::PENDING_APPROVAL => 'Tu cuenta está pendiente de aprobación. Contacta al administrador.',
            self::ACTIVE => 'Tu cuenta está activa.',
            self::PENDING_STORE_REGISTRATION => 'Debes completar el registro de tu tienda antes de continuar.',
            self::SUSPENDED => 'Tu cuenta está suspendida. Contacta al administrador.',
            default => 'Estado de cuenta desconocido.'
        };
    }

    /**
     * Obtener las rutas permitidas según el estado
     */
    public static function getAllowedRoutes($user): array
    {
        if (self::needsStoreRegistration($user)) {
            return [
                'tendero.registroTienda',
                'tendero.storeRegistroTienda',
                'logout',
                'profile.edit',
                'profile.update'
            ];
        }

        return [];
    }
} 