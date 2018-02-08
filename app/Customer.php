<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = ['full_name',
        'email', 'phone',  'birth_date',
        'gender', 'type', 'status', 'note'];



}
