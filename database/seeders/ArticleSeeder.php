<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users, categories, tags
        $users = User::factory()->count(20)->create();
        $categories = Category::factory()->count(20)->create();
        $tags = Tag::factory()->count(20)->create();

        Article::factory()
            ->count(1000)
            ->make()
            ->each(function ($article) use ($users, $categories, $tags) {

                $article->user_id = $users->random()->id;
                $article->category_id = $categories->random()->id;
                $article->save();

                // attach random tags (1-5 tags)
                $article->tags()->attach(
                    $tags->random(rand(1, 5))->pluck('id')
                );

                // create comments (0-10 comments per article)
                Comment::factory()
                    ->count(rand(0, 10))
                    ->create([
                        'commentable_id' => $article->id,
                        'commentable_type' => $article::class,
                    ]);
            });
    }
}
