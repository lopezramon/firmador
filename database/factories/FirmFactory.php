<?php

namespace Database\Factories;

use App\Models\Firm;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Organization;

class FirmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Firm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $organization = Organization::first();
        if (!$organization) {
            $organization = Organization::factory()->create();
        }

        return [
            'organization_id' => $organization->id,
            'sistem' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'status' => $this->faker->boolean,
            'count' => $this->faker->numberBetween(0, 999),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
