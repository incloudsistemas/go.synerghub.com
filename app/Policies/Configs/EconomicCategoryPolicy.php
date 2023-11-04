<?php

namespace App\Policies\Configs;

use App\Models\Configs\EconomicCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EconomicCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Categorias Econômicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EconomicCategory $economicCategory)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Categorias Econômicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Cadastrar Categorias Econômicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EconomicCategory $economicCategory)
    {
        if ($user->hasPermissionTo(permission: 'Editar Categorias Econômicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EconomicCategory $economicCategory)
    {
        if ($user->hasPermissionTo(permission: 'Deletar Categorias Econômicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, EconomicCategory $economicCategory): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, EconomicCategory $economicCategory): bool
    // {
    //     //
    // }
}
