<?php

namespace Database\Factories;
use App\Models\Event;
use App\Models\EventType;
use App\Models\RF_Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'event_name' => $this->faker->word(2),
            'event_description' => $this->faker->sentence(10),
            'event_start_date' => $this->faker->dateTimeBetween('now', '+1 years'),
            'event_end_date' => $this->faker->dateTimeBetween('now', '+1 years'),
            'event_venue' => $this->faker->address(),
            'event_type' => $this->faker->randomElement(EventType::all()->pluck('id')->toArray()),
        //    take codes related to application
            // 'event_status' => $this->faker->randomElement(RF_Status::where('status_code', 'like', 'EV%')->pluck('status_code')->toArray()),
            'event_ref_no' => $this->faker->randomNumber(5),
            'event_organizer' => $this->faker->randomElement(User::all()->pluck('id')->toArray()),

        ];


    }
}
