<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));
        return [
            'name' => $this->faker->words(3, true), // Limitar a 3 palabras.
            'description' => $this->faker->text(100), // Limitar a 100 caracteres.
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'image' => $faker->imageUrl(),
            'discount' => $this->faker->randomElement([0, 5, 10]),
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'state' => $this->faker->randomElement(['admin', 'user']),
        ];
    }
}
