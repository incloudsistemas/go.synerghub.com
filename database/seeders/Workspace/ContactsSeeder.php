<?php

namespace Database\Seeders\Workspace;

use App\Models\Address;
use App\Models\Workspace\Contact;
use App\Models\Workspace\ContactIndividual;
use App\Models\Workspace\ContactLegalEntity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contactMorphName = array_search(Contact::class, Relation::morphMap(), true)
            ?: Contact::class;

        $individualMorphName = array_search(ContactIndividual::class, Relation::morphMap(), true)
            ?: ContactIndividual::class;

        $legalEntityMorphName = array_search(ContactLegalEntity::class, Relation::morphMap(), true)
            ?: ContactLegalEntity::class;

        // Individuals
        ContactIndividual::factory(30)
            ->create()
            ->each(function ($individual) use ($contactMorphName, $individualMorphName) {
                Contact::factory()->create([
                    'contactable_id'   => $individual->id,
                    'contactable_type' => $individualMorphName,
                ]);

                Address::factory()->create([
                    'addressable_id'   => $individual->contact->id,
                    'addressable_type' => $contactMorphName,
                    'is_main'          => 1,
                ]);
            });

        // Legal Entities
        ContactLegalEntity::factory(30)
            ->create()
            ->each(function ($legalEntity) use ($contactMorphName, $legalEntityMorphName) {
                Contact::factory()->create([
                    'contactable_id'   => $legalEntity->id,
                    'contactable_type' => $legalEntityMorphName,
                ]);

                Address::factory()->create([
                    'addressable_id'   => $legalEntity->contact->id,
                    'addressable_type' => $contactMorphName,
                    'is_main'          => 1,
                ]);
            });
    }
}
