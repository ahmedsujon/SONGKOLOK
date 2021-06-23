<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SecondarySubCategory;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Helper\DeleteFile;

class ProductFactory extends Factory
{
    use DeleteFile;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'unique_id' => Str::random(9),
            'admin_id' => function(){
                return Admin::GetActive()->get()->random();
            },
            'brand_id' => function(){
                return Brand::GetActive()->get()->random();
            },
            'category_id' => function(){
                return Category::GetActive()->get()->random();
            },
            'sub_categories_id' => function(){
                return SubCategory::GetActive()->get()->random();
            },
            'secondary_sub_categories_id' => function(){
                return SecondarySubCategory::GetActive()->get()->random();
            },
            'product_name' => $this->faker->name,
            'product_description' => $this->faker->text(200),
//            'extra_description' => $this->faker->text(200),
            'specification' => $this->faker->text(200),
            'feature_image' => $this->faker->image(storage_path('app\public\images'), 840, 680,null, false),
            'stock' => $this->faker->numberBetween(10, 400),
            'size' => $this->faker->randomElement([
                'M', 'S', 'XL', 'XXL'
            ]),
            'model'=> $this->faker->hexColor,
            'product_slug' => $this->createSlug($this->model, $this->faker->name, "product_slug"),
            'product_price' => $this->faker->randomFloat(1, 40, 500),
            'tax' => $this->faker->numberBetween(1, 40),
            'manufactured_by' => $this->faker->name,
            'color' => implode(', ', [$this->faker->colorName, $this->faker->colorName, $this->faker->colorName, $this->faker->colorName, $this->faker->colorName, $this->faker->colorName]),
            'sold' => $this->faker->numberBetween(2, 30),
            'is_new' => $this->faker->numberBetween(1, 2)
        ];
    }
}
