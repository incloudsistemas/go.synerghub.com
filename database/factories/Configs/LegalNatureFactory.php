<?php

namespace Database\Factories\Configs;

use App\Models\Configs\LegalNature;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LegalNatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LegalNature::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->numerify('####'),
            'role' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
        ];
    }
}
