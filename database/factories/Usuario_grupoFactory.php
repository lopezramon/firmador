<?php

namespace Database\Factories;

use App\Models\Usuario_grupo;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Grupo;
use App\Models\User;

class Usuario_grupoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuario_grupo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $grupo = Grupo::first();
        if (!$grupo) {
            $grupo = Grupo::factory()->create();
        }

        $user = User::first();
        if (!$user) {
            $user = User::factory()->create();
        }

        return [
            'user_id' => $user->id,
            'grupo_id' => $grupo->id
        ];
    }
}
