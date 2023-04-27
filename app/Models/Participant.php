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
        'promotion_id',
        'user_id',
        'register_date',
        'application_status'

    ];

    public function eventPromotion():BelongsTo{
        return $this->belongsTo(EventPromotion::class);
    }

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function applicationStatus():BelongsTo{
        return $this->belongsTo(RF_Application_Status::class);
    }
}
