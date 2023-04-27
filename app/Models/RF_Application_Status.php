<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RF_Application_Status extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='rf_application_statuses';
    protected $primaryKey='status_code';

    protected $guarded = [
        'application_status',
        'application_status_description',
    ];

    public function resourceApplications():HasMany{
        return $this->hasMany(ResourceApplication::class);
    }

    public function participants():HasMany{
        return $this->hasMany(Participant::class);
    }

}
