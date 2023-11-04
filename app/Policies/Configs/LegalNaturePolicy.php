<?php

namespace App\Policies\Configs;

use App\Models\Configs\LegalNature;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LegalNaturePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Naturezas Jurídicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LegalNature $legalNature)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Naturezas Jurídicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Cadastrar Naturezas Jurídicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LegalNature $legalNature)
    {
        if ($user->hasPermissionTo(permission: 'Editar Naturezas Jurídicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LegalNature $legalNature)
    {
        if ($user->hasPermissionTo(permission: 'Deletar Naturezas Jurídicas')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, LegalNature $legalNature): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, LegalNature $legalNature): bool
    // {
    //     //
    // }
}
