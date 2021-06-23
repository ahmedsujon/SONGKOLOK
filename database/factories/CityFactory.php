<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\City;
use App\Models\District;
use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'division_id' => function(){
                return Division::all()->random();
            },
            'district_id' => function() {
                return District::all()->random();
            },
            'city_name' => $this->faker->state
        ];
    }
}
