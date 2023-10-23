<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 50), // Ajusta el rango según tus productos.
            'address' => $this->faker->address,
            'description' => $this->faker->sentence,
            'amount' => $this->faker->numberBetween(1, 10), // Ajusta el rango según tus necesidades.
            'price' => $this->faker->randomFloat(2, 1, 1000), // Precio aleatorio con 2 decimales.
            'user_id' => $this->faker->numberBetween(1, 10), // Ajusta el rango según tus usuarios.
        ];
    }
}
