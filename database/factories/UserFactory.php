<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Workspace\Contact;
use App\Models\Workspace\ContactIndividual;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contactMorphName = array_search(Contact::class, Relation::morphMap(), true)
            ?: Contact::class;

        $individualMorphName = array_search(ContactIndividual::class, Relation::morphMap(), true)
            ?: ContactIndividual::class;

        // Create a Individual and its related Contact and Address
        $individual = ContactIndividual::factory()
            ->create();

        $contact = Contact::factory()
            ->create([
                'contactable_id'   => $individual->id,
                'contactable_type' => $individualMorphName,
            ]);

        Address::factory()
            ->create([
                'addressable_id'   => $contact->id,
                'addressable_type' => $contactMorphName,
                'is_main'          => 1,
            ]);

        return [
            'contact_id'        => $contact->id,
            'name'              => $individual->name,
            'email'             => $individual->email,
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
