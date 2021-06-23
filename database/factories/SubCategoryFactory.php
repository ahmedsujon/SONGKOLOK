<?php

namespace Database\Factories;

use App\Helper\DeleteFile;
use App\Models\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubCategoryFactory extends Factory
{
    use DeleteFile;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => function(){
                return Category::GetActive()->get()->random();
            },
            'admin_id' => function(){
                return Admin::GetActive()->get()->random();
            },
            'subcategory_slug' => $this->createSlug($this->model, $this->faker->name, "subcategory_slug"),
            'subcategory_name' => $this->faker->name,
            'sub_category_image' => $this->faker->image(storage_path('app\public\images'), 640, 480,null, false)
        ];
    }
}
