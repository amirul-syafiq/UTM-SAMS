<?php

namespace Database\Factories;

use App\Models\EventPromotion;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventPromotion>
 */
class EventPromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = EventPromotion::class;

    public function definition(): array
    {
        return [
            'promotion_description'=>$this->faker->sentence(20),
            'promotion_start_date'=>$this->faker->dateTimeBetween('now', '+1 years'),
            'promotion_end_date'=>$this->faker->dateTimeBetween('now', '+1 years'),
            'participant_limit'=>$this->faker->randomNumber(3),
            'ecertificate_s3_key'=>$this->faker->url(),
            'event_id'=>$this->faker->unique()->randomElement(Event::all()->pluck('id')->toArray()),

        ];
    }
}
