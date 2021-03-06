<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'product_category_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function productCategory()
    {
        return $this->belongsTo('App\ProductCategory', 'product_category_id');
    }


    public function getUnreadNotification(){
       
        $unreadNotifications = collect();
        foreach($this->unreadNotifications as $notification){
            $data = $notification->data;
            
            $notificationData = [
                'order' => Order::find($data['order_id']),
                'orderLevel' => OrderLevel::find($data['order_level_id']),
                'user' => User::find($data['user_id']),
                'notification' => $notification
            ];

            if(is_null($notificationData['order']) ||  is_null($notificationData['orderLevel'])){
                $notification->delete();
            }else{
                $unreadNotifications->push($notificationData);
            } 
        }

        return $unreadNotifications;
    }
}
