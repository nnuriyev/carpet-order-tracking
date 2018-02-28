<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class UserRole extends Role
{

    public function orderLevels()
    {
        return $this->belongsToMany(
            'App\OrderLevel',
            'order_level_role_access',
            'role_id',
            'order_level_id'
            )->withPivot('access');
    }
}
