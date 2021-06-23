<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use App\Models\SecondarySubCategory;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helper\DeleteFile;

class SecondarySubCategoryFactory extends Factory
{
    use DeleteFile;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SecondarySubCategory::class;

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
            'category_id' => function(){
                return Category::GetActive()->get()->random();
            },
            'sub_category_id' => function(){
                return SubCategory::GetActive()->get()->random();
            },
            'secondary_subcategory_name' => $this->faker->name,
            'secondary_subcategory_slug' => $this->createSlug($this->model, $this->faker->name, "secondary_subcategory_slug")
        ];
    }
}
