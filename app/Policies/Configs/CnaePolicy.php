<?php

namespace App\Policies\Configs;

use App\Models\Configs\Cnae;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CnaePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Cnaes')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cnae $cnae)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Cnaes')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Cadastrar Cnaes')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cnae $cnae)
    {
        if ($user->hasPermissionTo(permission: 'Editar Cnaes')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cnae $cnae)
    {
        if ($user->hasPermissionTo(permission: 'Deletar Cnaes')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Cnae $cnae): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Cnae $cnae): bool
    // {
    //     //
    // }
}
