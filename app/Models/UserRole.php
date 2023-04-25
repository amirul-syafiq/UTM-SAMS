<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use HasFactory;
    use SoftDeletes;

    private $role_name;
    private $role_description;

    public function users():HasMany{
        return $this->hasMany(User::class);
    }
}
