<?php

namespace App\Policies\Workspace;

use App\Models\User;
use App\Models\Workspace\Insider;
use Illuminate\Auth\Access\Response;

class InsiderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Insiders')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Insider $insider)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Insiders')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Cadastrar Insiders')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Insider $insider)
    {
        if ($user->hasPermissionTo(permission: 'Editar Insiders')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Insider $insider)
    {
        if ($user->hasPermissionTo(permission: 'Deletar Insiders')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Insider $insider): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Insider $insider): bool
    // {
    //     //
    // }
}
