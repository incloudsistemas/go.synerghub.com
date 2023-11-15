<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // // Create storage folder
        // // utilizar apenas no ambiente de produção em host compartilhado.
        // if (!file_exists('storage')) {

        //     \App::make('files')->link(storage_path('app/public'), 'storage');
        // }

        // // Public Path
        // // utilizar apenas no ambiente de produção em host compartilhado.
        // app()->usePublicPath(realpath(base_path() . '/..'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Morph map for polymorphic relations.
        Relation::morphMap([
            'permissions' => 'App\Models\Permissions\Permission',
            'roles'       => 'App\Models\Permissions\Role',
            'users'       => 'App\Models\User',
            'addresses'   => 'App\Models\Address',

            'contacts'               => 'App\Models\Workspace\Contact',
            'contact_individuals'    => 'App\Models\Workspace\ContactIndividual',
            'contact_legal_entities' => 'App\Models\Workspace\ContactLegalEntity',
            'insiders'               => 'App\Models\Workspace\Insider',
            'products'               => 'App\Models\Workspace\Product',

            'cnaes'                    => 'App\Models\Configs\Cnae',
            'legal_natures'            => 'App\Models\Configs\LegalNature',
            'economic_categories'      => 'App\Models\Configs\EconomicCategory',
            'corporate_qualifications' => 'App\Models\Configs\CorporateQualification',
            'performance_areas'        => 'App\Models\Configs\PerformanceArea',
        ]);
    }
}
