<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Enums\UserRole;

class ProductPolicy
{
    // Verifica se o usuário está logado
    public function viewAny(User $user): bool
    {
        return true;
    }

    // admin e Vendedor
    public function create(User $user): bool
    {
        return $user->role === UserRole::ADMIN || $user->role === UserRole::SELLER;
    }

    // admin (todos) ou vendedor
    public function update(User $user, Product $product): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }
        // Vendedor só edita o produto que ELE criou
        return $user->role === UserRole::SELLER && $product->user_id === $user->id;
    }

    // Somente Admin
    public function delete(User $user, Product $product): bool
    {
        return $user->role === UserRole::ADMIN;
    }
}
