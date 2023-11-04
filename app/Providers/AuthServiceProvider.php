<?php

namespace App\Providers;

use App\Models;
use App\Policies;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Models\Permissions\Permission::class => Policies\Permissions\PermissionPolicy::class,
        Models\Permissions\Role::class       => Policies\Permissions\RolePolicy::class,
        Models\User::class                   => Policies\UserPolicy::class,

        Models\Workspace\ContactIndividual::class  => Policies\Workspace\ContactIndividualPolicy::class,
        Models\Workspace\ContactLegalEntity::class => Policies\Workspace\ContactLegalEntityPolicy::class,

        Models\Configs\Cnae::class                   => Policies\Configs\CnaePolicy::class,
        Models\Configs\LegalNature::class            => Policies\Configs\LegalNaturePolicy::class,
        Models\Configs\EconomicCategory::class       => Policies\Configs\EconomicCategoryPolicy::class,
        Models\Configs\CorporateQualification::class => Policies\Configs\CorporateQualificationPolicy::class,
        Models\Configs\PerformanceArea::class        => Policies\Configs\PerformanceAreaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Implicitly grant "Superadmin" role all permissions
        Gate::after(function ($user, $ability) {
            return $user->hasRole('Superadministrador') ? true : null;
        });
    }
}
