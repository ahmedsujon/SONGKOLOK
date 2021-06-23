<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

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
            'comment_id' => function(){
                return Comment::all()->random();
            },
            'reply' => $this->faker->word
        ];
    }
}
