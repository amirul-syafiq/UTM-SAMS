<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventAdvertisementImage;
use App\Models\EventAdvertisement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventAdvertisementImage>
 */
class EventAdvertisementImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = EventAdvertisementImage::class;
    public function definition(): array
    {
        return [
            'image_s3_key' => $this->faker->imageUrl(640, 480, 'poster'),
            'event_advertisement_id' => $this->faker->unique()->randomElement(EventAdvertisement::all()->pluck('id')->toArray()),
            'image_description' => $this->faker->sentence(10),
            'image_name' => $this->faker->word(2),
        ];
    }
}
