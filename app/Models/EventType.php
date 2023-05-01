<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventType extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'event_type_name',
        'event_type_description',
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
