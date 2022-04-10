<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function accessProfiles()
    {
        return $this->belongsToMany(AccessProfile::class, 'access_profile_permissions');
    }
}
