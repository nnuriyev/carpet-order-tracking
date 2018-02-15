<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected  $table = 'product_categories';
    protected  $fillable = ['name', 'key'];


    public function products()
    {
        return $this->hasMany('App\Product', 'category_id');
    }

}
