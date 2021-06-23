<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

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
            'event_name' => $this->faker->name,
            'start_date' => $this->faker->dateTimeBetween('+1 day', '+10 days'),
            'end_date' => $this->faker->dateTimeBetween('+10 day', '+30 days'),
            'event_image' => $this->faker->image(storage_path('app\public\images'), 640, 480,null, false),
            'status' => 1
        ];
    }
}
