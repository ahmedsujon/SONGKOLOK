<?php

namespace Database\Factories;

use App\Helper\DeleteFile;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    use DeleteFile;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function(){
                return User::GetActive()->get()->random();
            },
            'blog_id' => function(){
                return Blog::GetActive()->get()->random();
            },
            'comment' => $this->faker->text(20),
        ];
    }
}
