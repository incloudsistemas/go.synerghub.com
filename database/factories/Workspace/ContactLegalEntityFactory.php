<?php

namespace Database\Factories\Workspace;

use App\Models\Workspace\ContactLegalEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workspace\ContactLegalEntity>
 */
class ContactLegalEntityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactLegalEntity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'                   => $this->faker->company,
            'email'                  => $this->faker->unique()->companyEmail,
            'trade_name'             => $this->faker->companySuffix,
            'cnpj'                   => $this->faker->numerify('##.###.###/####-##'),
            'municipal_registration' => $this->faker->numerify('#######'),
            'state_registration'     => $this->faker->numerify('#######'),
            'nire'                   => $this->faker->numerify('########-#'),
            'nire_registered_at'     => $this->faker->date(),
            'share_capital'          => number_format($this->faker->numberBetween(100000, 10000000), 2, ',', ''),
            'tax_regime'             => $this->faker->numberBetween(1, 5),
            'tax_assessment'         => $this->faker->numberBetween(1, 2),
        ];
    }
}
