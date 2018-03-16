<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralCost extends Model
{
    protected $table = 'general_costs';

    protected $fillable = [
        'type', 'amount', 'note'
    ];

    public function typeName()
    {
        return config('staticData')['costType'][$this->type];
    }

}
