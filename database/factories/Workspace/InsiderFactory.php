<?php

namespace Database\Factories\Workspace;

use App\Models\Address;
use App\Models\Configs\Cnae;
use App\Models\Configs\EconomicCategory;
use App\Models\Configs\LegalNature;
use App\Models\Workspace\Contact;
use App\Models\Workspace\ContactIndividual;
use App\Models\Workspace\ContactLegalEntity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workspace\Insider>
 */
class InsiderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contactMorphName = array_search(Contact::class, Relation::morphMap(), true)
            ?: Contact::class;

        $contactable = $this->faker->randomElement([
            'individual'   => ContactIndividual::class,
            'legal_entity' => ContactLegalEntity::class,
        ]);

        $contactableMorphName = array_search($contactable, Relation::morphMap(), true)
            ?: $contactable;

        // Create a Individual/LegalEntity and its related Contact and Address
        $contactableEntity = $contactable::factory()
            ->create();

        $contact = Contact::factory()
            ->create([
                'contactable_id'   => $contactableEntity->id,
                'contactable_type' => $contactableMorphName,
            ]);

        Address::factory()
            ->create([
                'addressable_id'   => $contact->id,
                'addressable_type' => $contactMorphName,
                'is_main'          => 1,
            ]);

        return [
            'contact_id'           => $contact->id,
            'legal_nature_id'      => LegalNature::inRandomOrder()->first()->id ?? null,
            'economic_category_id' => EconomicCategory::inRandomOrder()->first()->id ?? null,
            'cnae_id'              => Cnae::inRandomOrder()->first()->id ?? null,
            'name'                 => $contact->contactable->name,
            'email'                => $contact->contactable->email,
        ];
    }
}
