<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLevel extends Model
{
    protected $table = 'order_levels';

    protected $fillable = [
        'name', 'key'
    ];

    public function roles()
    {
        return $this->belongsToMany(
            'Spatie\Permission\Models\Role',
            'order_level_role_access',
            'order_level_id',
            'role_id')
            ->withPivot('access');
    }
}
