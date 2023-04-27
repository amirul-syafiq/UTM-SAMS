<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class EventImage extends Model
{
    use HasFactory;

    protected $fillable=[
        'image_name',
        'image_description',      
    ];

    protected $guarded=[
        'event_promotion_id',
        'image_s3_key'
    ];
    

    public function eventPromotion():BelongsTo{
        return $this->belongsTo(EventPromotion::class);
    }

 
    
}
