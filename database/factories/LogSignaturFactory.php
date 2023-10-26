<?php

namespace Database\Factories;

use App\Models\LogSignatur;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Firm;

class LogSignaturFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LogSignatur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $firm = Firm::first();
        if (!$firm) {
            $firm = Firm::factory()->create();
        }

        return [
            'firm_id' => $firm->id,
            'id_xml' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'document_type' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'date_time' => $this->faker->date('Y-m-d H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
