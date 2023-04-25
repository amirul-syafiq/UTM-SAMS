<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    use HasFactory;

    protected $fillable=[
        'image_name',
        'image_description',      
        'uploaded_by',
        'event_id',
    ];

    
}
