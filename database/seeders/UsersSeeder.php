<?php

namespace Database\Seeders;

use App\Models\Permissions\Role;
use App\Models\User;
use App\Models\Workspace\ContactIndividual;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // VINÍCIUS - INCLOUD
        $individual = ContactIndividual::create([
            'name'  => 'Vinícius C. Lemos',
            'email' => 'contato@incloudsistemas.com.br',
        ]);

        $contact = $individual->contact()
            ->create();

        // user superadmin
        $superadmin = User::create([
            'contact_id'        => $contact->id,
            'name'              => $individual->name,
            'email'             => $individual->email,
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'remember_token'    => Str::random(10),
            // 'api_token'         => Hash::make('contato@incloudsistemas'),
        ]);

        $superadmin->assignRole('Superadministrador');

        // ROGÉRIO - SYNERG
        $individual = ContactIndividual::create([
            'name'  => 'Rogério Santos',
            'email' => 'rogerio@kayrosconsultoria.com',
        ]);

        $contact = $individual->contact()
            ->create();

        // user superadmin
        $superadmin = User::create([
            'contact_id'        => $contact->id,
            'name'              => $individual->name,
            'email'             => $individual->email,
            'email_verified_at' => now(),
            'password'          => Hash::make('go#synerghub'),
            'remember_token'    => Str::random(10),
            // 'api_token'         => Hash::make('contato@incloudsistemas'),
        ]);

        $superadmin->assignRole('Superadministrador');

        // Custom
        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) {
                $roles = Role::pluck('name');
                $user->assignRole($roles->random());
            });
    }
}
