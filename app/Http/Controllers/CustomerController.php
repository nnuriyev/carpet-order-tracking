<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, Customer $customer)
    {
        //'like', '%' . $request->product . '%'

        if($request->has('full_name') && !is_null($request->full_name)){
            $customer = $customer->where('full_name', 'like', '%' . $request->full_name . '%');
        }

        if($request->has('email') && !is_null($request->email)){
            $customer = $customer->where('email', 'like', '%' . $request->email . '%');
        }

        if($request->has('phone') && !is_null($request->phone)){
            $customer = $customer->where('phone', 'like', '%' . $request->phone . '%');
        }

        if($request->has('gender') && !is_null($request->gender)){
            $customer = $customer->where('gender', '=', $request->gender);
        }

        if($request->has('type') && !is_null($request->type)){
            $customer = $customer->where('type', '=', $request->type);
        }

        if($request->has('status') && !is_null($request->status)){
            $customer = $customer->where('status', '=', $request->status);
        }

        $perPage = 100;
        $customer = $customer->orderBy('id', 'desc')->paginate($perPage);

        if(count($request->all()) > 0 ){
            $customer->appends(request()->query())->links();
        }

        return view('app/pages.customer.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('app/pages.customer.create');
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
        
        Customer::create($requestData);

        return redirect('customer')->with('flash_message', 'Customer added!');
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
        $customer = Customer::findOrFail($id);

        return view('app/pages.customer.show', compact('customer'));
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
        $customer = Customer::findOrFail($id);

        return view('app/pages.customer.edit', compact('customer'));
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
        
        $customer = Customer::findOrFail($id);
        $customer->update($requestData);

        return redirect('customer')->with('flash_message', 'Customer updated!');
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
        Customer::destroy($id);

        return redirect('customer')->with('flash_message', 'Customer deleted!');
    }
}
