<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Participant extends Model
{
    use HasFactory;

    //these atributes should not be mass assignable
    protected $guarded=[
        'advertisement_id',
        'user_id',
        'register_date',
        'application_status',
        'additional_information_json'
    ];

    public function eventAdvertisement():BelongsTo{
        return $this->belongsTo(EventAdvertisement::class);
    }

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function statusCode():BelongsTo{
        return $this->belongsTo(RF_Status::class);
    }
}
