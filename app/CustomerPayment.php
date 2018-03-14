<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    protected $table = 'customer_payments';

    protected $fillable = ['order_id', 'user_id', 'amount', 'type'];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
