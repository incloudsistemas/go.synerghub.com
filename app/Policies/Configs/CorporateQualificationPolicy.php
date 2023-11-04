<?php

namespace App\Policies\Configs;

use App\Models\Configs\CorporateQualification;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CorporateQualificationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Qualificações Societárias')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CorporateQualification $corporateQualification)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Qualificações Societárias')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Cadastrar Qualificações Societárias')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CorporateQualification $corporateQualification)
    {
        if ($user->hasPermissionTo(permission: 'Editar Qualificações Societárias')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CorporateQualification $corporateQualification)
    {
        if ($user->hasPermissionTo(permission: 'Deletar Qualificações Societárias')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, CorporateQualification $corporateQualification): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, CorporateQualification $corporateQualification): bool
    // {
    //     //
    // }
}
