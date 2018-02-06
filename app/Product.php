<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table ='products';

    protected $fillable = ['category_id', 'code', 'name', 'price', 'cost'];

    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'category_id');
    }


}
