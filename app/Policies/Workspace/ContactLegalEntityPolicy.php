<?php

namespace App\Policies\Workspace;

use App\Models\User;
use App\Models\Workspace\ContactLegalEntity;
use Illuminate\Auth\Access\Response;

class ContactLegalEntityPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Contatos P. Jurídicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ContactLegalEntity $legalEntity)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Contatos P. Jurídicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Cadastrar Contatos P. Jurídicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ContactLegalEntity $legalEntity)
    {
        if ($user->hasPermissionTo(permission: 'Editar Contatos P. Jurídicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContactLegalEntity $legalEntity)
    {
        if ($user->hasPermissionTo(permission: 'Deletar Contatos P. Jurídicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, ContactLegalEntity $legalEntity): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, ContactLegalEntity $legalEntity): bool
    // {
    //     //
    // }
}
