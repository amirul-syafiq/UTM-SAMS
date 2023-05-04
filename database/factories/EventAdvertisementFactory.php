<?php

namespace Database\Factories;

use App\Models\EventAdvertisement;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventAdvertisement>
 */
class EventAdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = EventAdvertisement::class;

    public function definition(): array
    {
        return [
            'advertisement_description'=>$this->faker->sentence(20),
            'advertisement_start_date'=>$this->faker->dateTimeBetween('now', '+1 years'),
            'advertisement_end_date'=>$this->faker->dateTimeBetween('now', '+1 years'),
            'participant_limit'=>$this->faker->randomNumber(3),
            'ecertificate_s3_key'=>$this->faker->url(),
            'event_id'=>$this->faker->randomElement(Event::all()->pluck('id')->toArray()),

        ];
    }
}
