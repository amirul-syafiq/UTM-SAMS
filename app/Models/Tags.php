<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_name',
        'tag_description',
    ];
    protected $primaryKey='tag_name';
    public $incrementing=false;

    public function eventAdvertisements():BelongsToMany{
        return $this->belongsToMany(EventAdvertisement::class,'event_advertisement_tags','tag_name','event_advertisement_id');
    }
}
