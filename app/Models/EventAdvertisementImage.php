<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class EventAdvertisementImage extends Model
{
    use HasFactory;

    // attributes that are mass assignable
    protected $fillable=[
        'image_name',
        'image_description',
    ];

    // attributes that are not mass assignable
    protected $guarded=[
        'event_advertisement_id',
        'image_s3_key'
    ];

    // Define relationship with EventAdvertisement model
    public function eventAdvertisement():BelongsTo{
        return $this->belongsTo(EventAdvertisement::class);
    }

    public function getImageUrlAttribute(){
        $disk= Storage::disk('s3');
        $url=$disk->url($this->image_s3_key);
        return $url;
    }


}
