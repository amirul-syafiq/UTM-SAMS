<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable =[
        'event_name',
        'event_description',
        'event_start_date',
        'event_end_date',
        'event_organizer'
    ];

    public function EventImage():HasMany{
        return $this->hasMany(EventImage::class);
    }
}
