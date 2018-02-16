<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'customer_id', 'product_id', 'frame_id',
        'case_id', 'price', 'paid_amount', 'discount_amount',
        'status', 'note'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function frame()
    {
        return $this->belongsTo('App\Product', 'frame_id');
    }

    public function case()
    {
        return $this->belongsTo('App\Product', 'case_id');
    }

}
