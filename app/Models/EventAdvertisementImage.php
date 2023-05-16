<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class EventAdvertisementImage extends Model
{
    use HasFactory;

    protected $fillable=[
        'image_name',
        'image_description',
    ];

    protected $guarded=[
        'event_advertisement_id',
        'image_s3_key'
    ];


    public function eventAdvertisement():BelongsTo{
        return $this->belongsTo(EventAdvertisement::class);
    }

    public function getImageUrlAttribute(){
        $disk= Storage::disk('s3');
        $url=$disk->url($this->image_s3_key);
        return $url;
    }


}
