<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case CUSTOMER = 'customer';
    case SELLER = 'seller';

    public function label(): string
    {
        return match($this) {
            self::ADMIN    => 'Administrador',
            self::CUSTOMER => 'Cliente',
            self::SELLER   => 'Vendedor',
        };
    }
}
