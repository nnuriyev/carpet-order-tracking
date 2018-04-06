<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopDebt extends Model
{
    public $table = 'workshop_debt';
    public $fillable = [
        'workshop_id','order_id', 'debt', 'paid', 'note'
    ];

    public function workshop()
    {
        return $this->belongsTo('App\User', 'workshop_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}
