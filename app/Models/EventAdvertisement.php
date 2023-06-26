<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EventAdvertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertisement_title',
        'advertisement_description',
        'advertisement_start_date',
        'advertisement_end_date',
        'participant_limit',
    ];

    protected $guarded = [
        'event_id',
        'advertisement_status',
        'additional_information_key',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function eventAdvertisementImage(): HasOne
    {
        return $this->hasOne(EventAdvertisementImage::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->BelongsToMany(Tags::class, 'event_advertisement_tags', 'event_advertisement_id', 'tag_name');
    }

    public function eCertificate(): HasOne
    {
        return $this->hasOne(ECertificate::class);
    }

    // To get array of additional information data
    public function getAdditionalInformationsAttribute()
    {
        // Split the string into array of additional information by removing the comma and space
        $additionalInformationArray = explode(", ",  $this->additional_information_key);
        $additionalInformationArray = array_filter($additionalInformationArray);
        $additionalInformationArray = array_values($additionalInformationArray);

        foreach ($additionalInformationArray as &$element) {
            $element = str_replace(' ', '', ucwords($element));
        }

        unset($element); // Unset the reference to the last element to avoid potential issues


        return $additionalInformationArray;
    }
}
