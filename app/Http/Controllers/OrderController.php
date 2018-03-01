<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\Product;
use App\ProductCategory;
use App\Uploader\FileUploader;

use App\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $order = Order::paginate($perPage);
        } else {
            $order = Order::paginate($perPage);
        }

        return view('app/pages.order.index', compact('order'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function currentOrders(Request $request)
    {

        $order = Order::where('status','!=', 2)->orderBy('id', 'desc')->get();

        //dd($order->checkLastOrderLevelAccess([0]));
        $user = Auth::user();

        $access = [0];
        if($user->roles->first()->name == 'admin'){
            $access = [2];
        }
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

        return view('app/pages.order.create',
            compact('customerList', 'productList',
                'frameList', 'casesList'));
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

        $productPrice = Product::findOrFail($request->product_id)->price;
        $framePrace = $request->has('frame_id') ? Product::findOrFail($request->frame_id)->price : 0;
        $casePrace = $request->has('case_id') ? Product::findOrFail($request->case_id)->price : 0;

        $requestData['price'] = $productPrice + $framePrace + $casePrace;


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
        $orderLevels = UserRole::findOrFail($userRoleId)->orderLevels->pluck('name', 'id');

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

        return view('app/pages.order.edit', compact('order',
            'customerList', 'productList',
            'frameList', 'casesList', 'orderLevels'));
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

        $productPrice = Product::findOrFail($request->product_id)->price;
        $framePrace = $request->has('frame_id') ? Product::findOrFail($request->frame_id)->price : 0;
        $casePrace = $request->has('case_id') ? Product::findOrFail($request->case_id)->price : 0;

        $requestData['price'] = $productPrice + $framePrace + $casePrace;

        if($request->file('image')){
            $requestData['image'] =  FileUploader::upload('image','public/order_images/');
        }

        if($request->file('sketch')){
            $requestData['sketch'] =  FileUploader::upload('sketch','public/order_sketches/');
        }


        $order->update($requestData);

        return redirect('order')->with('flash_message', 'Order updated!');
    }

    public function attachOrderLevel(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->orderLevels()->attach($request->order_level_id,
            [
                'user_id' => Auth::user()->id,
                'due_date' => $request->due_date,
                'note' => $request->note,
                'created_at' => Carbon::now()
            ]);

        return redirect()->back();
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
}
