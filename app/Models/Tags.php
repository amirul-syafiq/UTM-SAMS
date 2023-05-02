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

    public function eventPromotions():BelongsToMany{
        return $this->belongsToMany(EventPromotion::class);
    }
}
