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
        'event_advertisement_id',
        'user_id',
        'register_date',
        'registration_status',
        'additional_information_json'
    ];

    // Relationship to EventAdvertisement
    public function eventAdvertisement():BelongsTo{
        return $this->belongsTo(EventAdvertisement::class);
    }

    // Relationship to User
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    // Relationship to RF_Status
    public function statusCode():BelongsTo{
        return $this->belongsTo(RF_Status::class,'registration_status','status_code');
    }

    // Function to get the additional information by decoding the json
    public function getAdditionalInformationAttribute(){
        return json_decode($this->additional_information_json);
    }
}
