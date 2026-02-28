<?php

namespace Database\Factories;

use App\Enums\ArticleStatus;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.Str::random(10),
            'excerpt' => $this->faker->paragraph(1),
            'content' => $this->faker->paragraphs(5, true),
            'image' => $this->faker->imageUrl(),
            'is_featured' => $this->faker->boolean(10),
            'status' => fake()->randomElement(ArticleStatus::cases()),
            'publish_at' => now(),
            'published_at' => now(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
