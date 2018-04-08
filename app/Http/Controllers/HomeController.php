<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::where('status', 1)->get();
        $actualOrders = [];
        //dd($orders);
        foreach($orders as $order){
            $exitWorkshopDate = $order->getExitWorkshopDate();
            if($exitWorkshopDate != null && date('d-m-Y', strtotime($exitWorkshopDate)) == date('d-m-Y')){
                $actualOrders[] = $order;
            }
        }

        return view('app.pages.home.index', compact('actualOrders'));
    }
}
