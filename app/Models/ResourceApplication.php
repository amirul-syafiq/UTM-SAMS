<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ResourceApplication extends Model
{
    use HasFactory;

    protected $fillable=[
        'application_purpose',
        'apply_date',
        'review_date',
        'rent_start_date',
        'rent_end_date',
    ];

    protected $guarded=[
        'application_status',
        'applicant_id', //club id

    ];

    public function applicant():BelongsTo{
        return $this->belongsTo(Club::class);
    }

    public function statusCode():BelongsTo{
        return $this->belongsTo(RF_Status::class);
    }

}
