<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OrderImage;
use Illuminate\Http\Request;

class OrderImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, $orderId)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $orderimage = OrderImage::paginate($perPage);
        } else {
            $orderimage = OrderImage::paginate($perPage);
        }

        return view('app/pages.order-image.index', compact('orderimage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($orderId)
    {
        return view('app/pages.order-image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, $orderId)
    {
        
        $requestData = $request->all();
        
        OrderImage::create($requestData);

        return redirect('order-image')->with('flash_message', 'OrderImage added!');
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
        $orderimage = OrderImage::findOrFail($id);

        return view('app/pages.order-image.show', compact('orderimage'));
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
        $orderimage = OrderImage::findOrFail($id);

        return view('app/pages.order-image.edit', compact('orderimage'));
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
        
        $orderimage = OrderImage::findOrFail($id);
        $orderimage->update($requestData);

        return redirect('order-image')->with('flash_message', 'OrderImage updated!');
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
        OrderImage::destroy($id);

        return redirect('order-image')->with('flash_message', 'OrderImage deleted!');
    }
}
