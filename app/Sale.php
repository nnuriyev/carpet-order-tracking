<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    //percent - always will be empty
    protected $fillable = ['name', 'percent']; 
}
