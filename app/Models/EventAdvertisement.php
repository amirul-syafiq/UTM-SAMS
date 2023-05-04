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
        'advertisement_description',
        'advertisement_start_date',
        'advertisement_end_date',
        'participant_limit',
    ];

    protected $guarded = [
        'event_id',
        'ecertificate_s3_key',
        'advertisement_status',
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
        return $this->BelongsToMany(Tags::class);
    }
}
