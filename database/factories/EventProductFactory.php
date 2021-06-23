<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventProduct;
use App\Models\Product;
use App\Models\SecondarySubCategory;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventProduct::class;

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
            'sub_categories_id' => function(){
                return SubCategory::GetActive()->get()->random();
            },
            'secondary_sub_categories_id' => function(){
                return SecondarySubCategory::GetActive()->get()->random();
            },
            "product_id" => function(){
                return Product::GetActive()->get()->random();
            },
            'event_id' => function(){
                return Event::GetActive()->get()->random();
            },
            'discount' => $this->faker->numberBetween(10, 60)
        ];
    }
}
