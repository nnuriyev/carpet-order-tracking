<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'customer_id', 'product_id', 'frame_id',
        'case_id', 'product_cost', 'frame_cost', 'case_cost',
        'cargo_cost', 'price', 'paid_cash', 'paid_terminal',
        'paid_online', 'discount_amount', 'status',
        'last_order_level_id', 'image', 'sketch', 'note'
    ];

    public function cutomerPayments()
    {
        return $this->hasMany('App\CustomerPayment');
    }

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

    public function orderLevels()
    {
        return $this->belongsToMany(
            'App\OrderLevel',
            'order_level_order',
            'order_id',
            'order_level_id'
        )->withPivot('created_at', 'due_date', 'note');
    }

    public function lastOrderLevel()
    {
        return $this->belongsTo('App\OrderLevel', 'last_order_level_id');
    }

    public function lastorderLevelByPivot()
    {
        return $this->orderLevels()->orderBy('id', 'desc')->get()->first();
    }

    public function checkLastOrderLevelAccess($access)
    {
        $lastOrderlevel = $this->lastOrderLevel;
        if (is_null($lastOrderlevel)) return false;

        $accessRoles = $lastOrderlevel->roles()->wherePivotIn('access', $access)->get()->pluck('name')->toArray();

        $userRoleName = Auth::user()->roles->first()->name;
        if (in_array($userRoleName, $accessRoles)) {
            return true;
        }
        return false;
    }

    public function totalPaidAmount()
    {
        return $this->paid_cash + $this->paid_terminal + $this->paid_online;
    }

    public function restOfAmount()
    {
        return $this->price - $this->discount_amount - $this->totalPaidAmount();
    }

    public function statusName(){
        return config('staticData')['orderStatus'][$this->status];
    }

}
