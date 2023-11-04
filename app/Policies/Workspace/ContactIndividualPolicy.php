<?php

namespace App\Policies\Workspace;

use App\Models\User;
use App\Models\Workspace\ContactIndividual;
use Illuminate\Auth\Access\Response;

class ContactIndividualPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Contatos P. Físicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ContactIndividual $individual)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Contatos P. Físicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Cadastrar Contatos P. Físicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ContactIndividual $individual)
    {
        if ($user->hasPermissionTo(permission: 'Editar Contatos P. Físicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContactIndividual $individual)
    {
        if ($user->hasPermissionTo(permission: 'Deletar Contatos P. Físicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, ContactIndividual $individual): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, ContactIndividual $individual): bool
    // {
    //     //
    // }
}
