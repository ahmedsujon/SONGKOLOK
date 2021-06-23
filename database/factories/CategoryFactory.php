<?php

namespace Database\Factories;

use App\Helper\DeleteFile;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    use DeleteFile;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admin_id' => function(){
                return Admin::GetActive()->get()->random();
            },
            'category_slug' => $this->createSlug($this->model, $this->faker->name, "category_slug"),
            'category_name' => $this->faker->name,
            'featured' => $this->faker->numberBetween(0, 1),
            'category_image' => $this->faker->image(storage_path('app\public\images'), 640, 480,null, false)
        ];
    }
}
