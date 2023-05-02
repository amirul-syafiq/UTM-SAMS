<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EventPromotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'promotion_description',
        'promotion_start_date',
        'promotion_end_date',
        'participant_limit',
    ];

    protected $guarded = [
        'event_id',
        'ecertificate_s3_key',
        'promotion_status',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function eventImage(): HasOne
    {
        return $this->hasOne(EventImage::class);
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
