<?php

namespace Database\Factories\Workspace;

use App\Models\Workspace\ContactIndividual;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workspace\ContactIndividual>
 */
class ContactIndividualFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactIndividual::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => $this->faker->name,
            'email'             => $this->faker->unique()->safeEmail,
            'cpf'               => $this->faker->numerify('###.###.###-##'),
            'rg'                => $this->faker->numerify('########'),
            'gender'            => $this->faker->randomElement(['m', 'f']),
            'birth_date'        => $this->faker->date,
            'marital_status'    => $this->faker->numberBetween(1, 6),
            'educational_level' => $this->faker->numberBetween(1, 6),
            'nationality'       => $this->faker->country,
            'citizenship'       => $this->faker->city,
            'occupation'        => $this->faker->jobTitle,
        ];
    }
}
