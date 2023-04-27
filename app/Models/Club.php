<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'club_advisor',
        'club_description',
        'club_type',
        
    ];
    
    protected $guarded=[
        'user_id'
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    
    public function resourceApplication():HasMany{
        return $this->hasMany(ResourceApplication::class);
    }
}
