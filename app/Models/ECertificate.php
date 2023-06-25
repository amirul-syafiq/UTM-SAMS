<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ECertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'ecertificate_name',
        'ecertificate_description',
        'ecertificate_status',
        'ecertificate_attribute_key_value'
    ];

    protected $guarded = [
        'event_advertisement_id',
        'ecertificate_s3_key',
    ];

    public function eventAdvertisement(): BelongsTo
    {
        return $this->belongsTo(EventAdvertisement::class);
    }

    public function getImageUrlAttribute(){
        $disk= Storage::disk('s3');
        $url=$disk->url($this->ecertificate_s3_key);
        return $url;
    }



}
