<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderImage extends Model
{
    protected $table = 'order_images';
    protected $fillable = ['order_id', 'image', 'sketch', 'type', 'status', 'note'];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
