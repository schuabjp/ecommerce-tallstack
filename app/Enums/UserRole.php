<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case SELLER = 'seller';
    case CUSTOMER = 'customer';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrador',
            self::SELLER => 'Vendedor',
            self::CUSTOMER => 'Cliente',
        };
    }
}
