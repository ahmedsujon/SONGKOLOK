<?php

namespace Database\Factories;

use App\Helper\DeleteFile;
use App\Models\Admin;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    use DeleteFile;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Brand::class;

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
            'brand_slug' => $this->createSlug($this->model, $this->faker->name, "brand_slug"),
            'brand_name' => $this->faker->name,
            'level' => $this->faker->numberBetween(1, 3),
            'brand_image' => $this->faker->image(storage_path('app\public\images'), 640, 480,null, false)
        ];
    }
}
