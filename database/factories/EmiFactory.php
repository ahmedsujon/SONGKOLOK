<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Emi;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Emi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "admin_id" => function(){
                return Admin::GetActive()->get()->random();
            },
            "bank_name" => $this->faker->name,
            "duration" => $this->faker->randomElement([
                '01/03 months', '03/07 months', '02/05 months', '05/09 months', '03 months'
            ]),
            'status' => $this->faker->numberBetween(0, 1)
        ];
    }
}
