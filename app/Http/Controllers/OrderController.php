<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerPayment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\OrderLevel;
use App\Product;
use App\ProductCategory;
use App\Uploader\FileUploader;
use App\WorkshopDebt;
use App\Sale;
use Spatie\Permission\Models\Role;

use App\Notifications\OrderLevelNotf;

use Maatwebsite\Excel\Excel;
use App\Exports\OrdersExport;

use App\User;
use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, Order $orders)
    {
        if($request->has('customer') && !is_null($request->customer)){
            $orders = $orders->whereHas('customer', function ($query) use ($request){
                $query->where('customers.full_name', 'like', '%' . $request->customer . '%');
            });
        }

        if($request->has('product') && !is_null($request->product)){
            $orders = $orders->whereHas('product', function ($query) use ($request){
                $query->where('products.name', 'like', '%' . $request->product . '%')
                ->orWhere('products.code', '=', $request->product );
            });
        }

        if($request->has('frame') && !is_null($request->frame)){
            $operator = $request->frame == 1 ? '!=' : '=';
            $orders = $orders->where('frame_id', $operator, null);
        }

        if($request->has('case') && !is_null($request->case)){
            $operator = $request->case == 1 ? '!=' : '=';
            $orders = $orders->where('case_id', $operator, null);
        }

        if($request->has('sketch') && !is_null($request->sketch)){
            $operator = $request->sketch == 1 ? '!=' : '=';
            $orders = $orders->where('sketch', $operator, null);
        }

        if($request->has('order_level') && !is_null($request->order_level)){
            $orders = $orders->where('last_order_level_id', $request->order_level);
        }

        if($request->has('sale_id') && !is_null($request->sale_id)){
            $orders = $orders->where('sale_id', $request->sale_id);
        }

        if($request->has('date_from') && !is_null($request->date_from)){
            $orders = $orders->where('created_at','>=', $request->date_from);
        }

        if($request->has('date_to') && !is_null($request->date_to)){
            $orders = $orders->where('created_at','<=', $request->date_to . ' 23:59:59');
        }

        $perPage = 100;
        $orders = $orders->orderBy('id', 'desc')->paginate($perPage);

        if(count($request->all()) > 0 ){
            $orders->appends(request()->query())->links();
        }

        $orderLevels = OrderLevel::pluck('name', 'id');
        $saleList = Sale::all()->pluck('name', 'id');

        return view('app/pages.order.index', compact('orders','orderLevels', 'saleList'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function currentOrders(Request $request)
    {

        $user = Auth::user();
        
        $access = [0, 2];
        if($user->roles->first()->name == 'admin'){
            $access = [2];
        }

        $order = Order::where([
            ['status','!=', 2],
            ['status','!=', 3],
        ]);

        if($user->roles->first()->name == 'workshop'){
            $order = $order->whereHas('product', function ($query) use ($user){
                $query->where('products.category_id', '=', $user->product_category_id);
            });
        }

       $order = $order->orderBy('id', 'desc')->get();

        return view('app/pages.order.index-by-level', compact('order', 'access'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $customers = Customer::all();
        $customerList = new Collection();
        $customers->each(function ($item, $key) use ($customerList) {
            $customerList->push([
                'id' => $item->id,
                'name' => $item->full_name . ' - ' . $item->phone
            ]);
        });
        $customerList = $customerList->pluck('name', 'id');

        $products = Product::all();
        $productList = new Collection();
        $products->each(function ($item, $key) use ($productList) {
            $productList->push([
                'id' => $item->id,
                'name' => $item->category->name . ' - ' . $item->code . ' - ' . $item->name . ' - ' . $item->price
            ]);
        });
        $productList = $productList->pluck('name', 'id');

        $frames = ProductCategory::where('key', 'cherchive')->first()->products;
        $frameList = new Collection();
        $frames->each(function ($item, $key) use ($frameList) {
            $frameList->push([
                'id' => $item->id,
                'name' =>$item->code . ' - ' . $item->name . ' - ' . $item->price
            ]);
        });
        $frameList = $frameList->pluck('name', 'id');

        $cases = ProductCategory::where('key', 'chanta')->first()->products;
        $casesList = new Collection();
        $cases->each(function ($item, $key) use ($casesList) {
            $casesList->push([
                'id' => $item->id,
                'name' =>$item->code . ' - ' . $item->name . ' - ' . $item->price
            ]);
        });
        $casesList = $casesList->pluck('name', 'id');

        $saleList = Sale::all()->pluck('name', 'id');

        return view('app/pages.order.create',
            compact('customerList', 'productList',
                'frameList', 'casesList', 'saleList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['user_id'] = Auth::user()->id;

        $product = Product::findOrFail($request->product_id);
        
        $framePrace = 0;
        if($request->has('frame_id') && !is_null($request->frame_id)){
 			$frame = Product::findOrFail($request->frame_id);
 			$framePrace = $frame->price;
        }

        $casePrace = 0;
        if($request->has('case_id') && !is_null($request->case_id)){
        	$case = Product::findOrFail($request->case_id);
        	$casePrace = $case->price;
        }
       
        $productPrice = $product->price;
   
        $requestData['price'] = $productPrice + $framePrace + $casePrace;
        $requestData['product_cost'] = $product->cost;
        $requestData['frame_cost'] = isset($frame->cost) ? $frame->cost : 0;
        $requestData['case_cost'] = isset($case->cost) ? $case->cost : 0;
        $requestData['paid_cash'] = 0;
        $requestData['paid_online'] = 0;
        $requestData['paid_terminal'] = 0;
        $requestData['status'] = 0;

        if($request->file('image')){
            $requestData['image'] =  FileUploader::upload('image','public/order_images/');
        }

        Order::create($requestData);

        return redirect('order')->with('flash_message', 'Order added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('app/pages.order.show', compact('order'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function invoice($id)
    {
        $order = Order::findOrFail($id);

        return view('app/pages.order.invoice', compact('order'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $userRoleId = Auth::user()->roles()->first()->id;
        $orderLevels = UserRole::findOrFail($userRoleId)->orderLevels()->wherePivot('access', '!=', 0)->get()->pluck('name', 'id');

        $customers = Customer::all();
        $customerList = new Collection();
        $customers->each(function ($item, $key) use ($customerList) {
            $customerList->push([
                'id' => $item->id,
                'name' => $item->full_name . ' - ' . $item->phone
            ]);
        });
        $customerList = $customerList->pluck('name', 'id');

        $products = Product::all();
        $productList = new Collection();
        $products->each(function ($item, $key) use ($productList) {
            $productList->push([
                'id' => $item->id,
                'name' => $item->category->name . ' - ' . $item->code . ' - ' . $item->name . ' - ' . $item->price
            ]);
        });
        $productList = $productList->pluck('name', 'id');

        $frames = ProductCategory::where('key', 'cherchive')->first()->products;
        $frameList = new Collection();
        $frames->each(function ($item, $key) use ($frameList) {
            $frameList->push([
                'id' => $item->id,
                'name' =>$item->code . ' - ' . $item->name . ' - ' . $item->price
            ]);
        });
        $frameList = $frameList->pluck('name', 'id');

        $cases = ProductCategory::where('key', 'chanta')->first()->products;
        $casesList = new Collection();
        $cases->each(function ($item, $key) use ($casesList) {
            $casesList->push([
                'id' => $item->id,
                'name' =>$item->code . ' - ' . $item->name . ' - ' . $item->price
            ]);
        });
        $casesList = $casesList->pluck('name', 'id');

        $saleList = Sale::all()->pluck('name', 'id');

        return view('app/pages.order.edit', compact('order',
            'customerList', 'productList',
            'frameList', 'casesList', 'orderLevels', 'saleList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $order = Order::findOrFail($id);

        $product = Product::findOrFail($request->product_id);
        
        $framePrace = 0;
        if($request->has('frame_id') && !is_null($request->frame_id)){
 			$frame = Product::findOrFail($request->frame_id);
 			$framePrace = $frame->price;
        }

        $casePrace = 0;
        if($request->has('case_id') && !is_null($request->case_id)){
        	$case = Product::findOrFail($request->case_id);
        	$casePrace = $case->price;
        }
       
        $productPrice = $product->price;
   
        $requestData['price'] = $productPrice + $framePrace + $casePrace;
        $requestData['product_cost'] = $product->cost;
        $requestData['frame_cost'] = isset($frame->cost) ? $frame->cost : 0;
        $requestData['case_cost'] = isset($case->cost) ? $case->cost : 0;

        if($request->file('image')){
            $requestData['image'] =  FileUploader::upload('image','public/order_images/');
        }

        if($request->file('sketch')){
            $requestData['sketch'] =  FileUploader::upload('sketch','public/order_sketches/');
        }

        $order->update($requestData);

        return redirect('order/'.$id)->with('flash_message', 'Order updated!');
    }

    public function attachOrderLevel(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->last_order_level_id = $request->order_level_id;
        $order->save();
    
        $order->orderLevels()->attach($request->order_level_id,[
                'user_id' => Auth::user()->id,
                'due_date' => $request->due_date,
                'note' => $request->note,
                'created_at' => Carbon::now()
        ]);

        $level = OrderLevel::findOrFail($request->order_level_id);
        $user = Auth::user();
        if($level->key == 'tehvil_verildi'){
            $order->status = 2;//Sifarish tamamlandi
        }elseif ($level->key == 'cancel'){
            $order->status = 3;//Legv edilib
        }else{
            $order->status = 1;//Prosesde
        }
        $order->save();

        if($level->key == 'emalatxanadan_cixdi' && $user->roles->first()->name == 'workshop'){
            $workshopDebt = WorkshopDebt::where([
                ['order_id', '=', $order->id],
                ['workshop_id', '=', $user->id],
                ['debt', '!=', null],
            ])->first();

            $debtAmount = $order->product_cost + $order->cargo_cost;

            if($workshopDebt != null){
                $workshopDebt->debt = $debtAmount;
            }else{
                $workshopDebt = new WorkshopDebt();
                $workshopDebt->workshop_id = $user->id;
                $workshopDebt->order_id = $order->id;
                $workshopDebt->debt = $debtAmount;
                $workshopDebt->save();
            }
        }

        if($level->key == 'cancel'){
            WorkshopDebt::where('order_id', $order->id)->delete();
            CustomerPayment::where('order_id', $order->id)->delete();
        }

        $notificationData = (object) [
            'order_id'=>$order->id,
            'order_level_id'=>$request->order_level_id,
            'user_id'=>$user->id
        ];

        $notifiableUsers = $this->getNotifiableUsers($order);
        Notification::send($notifiableUsers, new OrderLevelNotf($notificationData));

        return redirect('order/'. $order->id);
    }


    protected function getNotifiableUsers($order){

        $notifiableUsers = collect();
        $notifiableAccess = config('staticData')['orderLevelNotifAccess'];
        foreach($notifiableAccess as $role => $levels){
            $users = Role::where('name', $role)->first()->users;

            $filteredUsers = $users->reject(function ($user, $key) use ($role, $order) {
                if($role == 'workshop' && $user->productCategory->id != $order->product->category->id){
                    return true;
                }
            });

             if(in_array($order->lastOrderLevel->key, $notifiableAccess[$role])){
                $notifiableUsers = $notifiableUsers->merge($filteredUsers);
             }
        }

        return $notifiableUsers;
    }


    

    public function updateCargoCost(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $old_cargo_cost = $order->cargo_cost;
        $order->cargo_cost = $request->cargo_cost;
        $order->save();

        $user = Auth::user();
        $workshopDebt = WorkshopDebt::where([
            ['order_id', '=', $order->id],
            ['workshop_id', '=', $user->id],
            ['debt', '!=', null],
        ])->first();

        if($workshopDebt != null){
            $debtAmount = $workshopDebt->debt - $old_cargo_cost + $order->cargo_cost;
            $workshopDebt->debt = $debtAmount;
            $workshopDebt->save();
        }

        return redirect('order/'. $order->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return redirect('order')->with('flash_message', 'Order deleted!');
    }


    public function addPayment(Request $request, $orderId)
    {
        $payment = new CustomerPayment();
        $payment->order_id = $orderId;
        $payment->user_id = Auth::user()->id;
        $payment->amount = $request->amount;
        $payment->type = $request->type;
        $payment->save();

        $order = Order::findOrFail($orderId);
        $amountKey = null;

        if($request->type == 1){
            $amountKey = 'paid_cash';
        }elseif($request->type == 2){
            $amountKey = 'paid_online';
        }elseif($request->type == 3){
            $amountKey = 'paid_terminal';
        }

        $order[$amountKey] += $request->amount;
        $order->save();

        return redirect()->back();
    }


    
    /*public function deletePayment($id)
    {
        CustomerPayment::destroy($id);
        return redirect()->back();
    }*/


    public function export(Request $request, Order $orders, Excel $excel) 
    {
        
        if($request->has('customer') && !is_null($request->customer)){
            $orders = $orders->whereHas('customer', function ($query) use ($request){
                $query->where('customers.full_name', 'like', '%' . $request->customer . '%');
            });
        }

        if($request->has('product') && !is_null($request->product)){
            $orders = $orders->whereHas('product', function ($query) use ($request){
                $query->where('products.name', 'like', '%' . $request->product . '%')
                ->orWhere('products.code', '=', $request->product );
            });
        }

        if($request->has('frame') && !is_null($request->frame)){
            $operator = $request->frame == 1 ? '!=' : '=';
            $orders = $orders->where('frame_id', $operator, null);
        }

        if($request->has('case') && !is_null($request->case)){
            $operator = $request->case == 1 ? '!=' : '=';
            $orders = $orders->where('case_id', $operator, null);
        }

        if($request->has('sketch') && !is_null($request->sketch)){
            $operator = $request->sketch == 1 ? '!=' : '=';
            $orders = $orders->where('sketch', $operator, null);
        }

        if($request->has('order_level') && !is_null($request->order_level)){
            $orders = $orders->where('last_order_level_id', $request->order_level);
        }

        if($request->has('sale_id') && !is_null($request->sale_id)){
            $orders = $orders->where('sale_id', $request->sale_id);
        }

        if($request->has('date_from') && !is_null($request->date_from)){
            $orders = $orders->where('created_at','>=', $request->date_from);
        }

        if($request->has('date_to') && !is_null($request->date_to)){
            $orders = $orders->where('created_at','<=', $request->date_to . ' 23:59:59');
        }

        
        $orders = $orders->orderBy('id', 'desc')->get();


        $export = new OrdersExport($orders);
        return $excel->download($export, 'Orders.xlsx');
    }



}
