<?php

namespace App\Policies\Configs;

use App\Models\Configs\PerformanceArea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PerformanceAreaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Áreas de Atuações')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PerformanceArea $performanceArea)
    {
        if ($user->hasPermissionTo(permission: 'Visualizar Áreas de Atuações')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if ($user->hasPermissionTo(permission: 'Cadastrar Áreas de Atuações')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PerformanceArea $performanceArea)
    {
        if ($user->hasPermissionTo(permission: 'Editar Áreas de Atuações')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PerformanceArea $performanceArea)
    {
        if ($user->hasPermissionTo(permission: 'Deletar Áreas de Atuações')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, PerformanceArea $performanceArea): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, PerformanceArea $performanceArea): bool
    // {
    //     //
    // }
}
