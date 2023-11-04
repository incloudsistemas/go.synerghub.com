<?php

namespace Database\Factories\Workspace;

use App\Models\Workspace\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workspace\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contactable_id'    => null, // Set dynamically
            'contactable_type'  => null, // Set dynamically
            'additional_emails' => [
                [
                    'email' => $this->faker->safeEmail,
                    'name'  => $this->faker->randomElement(['Pessoal', 'Trabalho', 'Outros']),
                ],
            ],
            'phones'            => [
                [
                    'number' => $this->faker->phoneNumber,
                    'name'   => $this->faker->randomElement(['Celular', 'Whatsapp', 'Casa', 'Trabalho', 'Outros']),
                ],
            ],
            'complement'       => $this->faker->text,
            'custom'           => null,
        ];
    }
}
