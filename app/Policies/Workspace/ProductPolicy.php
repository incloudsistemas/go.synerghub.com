<?php

namespace App\Policies\Workspace;

use App\Models\User;
use App\Models\Workspace\Product;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Produtos')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Produtos')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Cadastrar Produtos')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product)
    {
        if ($user->hasPermissionTo(permission: 'Editar Produtos')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product)
    {
        if ($user->hasPermissionTo(permission: 'Deletar Produtos')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Product $product): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Product $product): bool
    // {
    //     //
    // }
}
