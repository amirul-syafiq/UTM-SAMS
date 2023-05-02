<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable =[
        'event_name',
        'event_description',
        'event_start_date',
        'event_end_date',
        'event_venue',
        'event_type',
        'event_ref_no', // reference no obtained from acad @ hep

    ];

    protected $guarded =[
        'event_organizer',
        'event_status',
    ];
    // each event belongs to one user
    public function organizer():BelongsTo{
        return $this->belongsTo(User::class);
    }

    // each event has many event promotion
    public function eventPromotions():HasMany{
        return $this->hasMany(EventPromotion::class);
    }

    public function eventType():BelongsTo{
        return $this->belongsTo(EventType::class);
    }

    public function eventStatus():BelongsTo{
        return $this->belongsTo(RF_Status::class, 'event_status', 'status_code');
    }
}
