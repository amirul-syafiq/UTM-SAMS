<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RF_Status extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='rf_statuses';
    protected $primaryKey='status_code';

    protected $guarded = [
        'status_name',
        'status_description',
    ];

    public function resourceApplications():HasMany{
        return $this->hasMany(ResourceApplication::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class, 'registration_status', 'status_code');
    }

    public function events():hasMany{
        return $this->hasMany(Event::class);
    }

}
