<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OrderImage;
use App\Uploader\FileUploader;
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
        $orderimage = OrderImage::where('order_id', $orderId)->get();
        return view('app/pages.order-image.index', compact('orderimage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
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
        $requestData['order_id'] = $orderId;
        $requestData['status'] = false;

        if ($request->file('image')) {
            $requestData['image'] = FileUploader::upload('image', 'public/order_images/');
            $requestData['type'] = 1;
        }
        OrderImage::create($requestData);

        return redirect('order/' . $orderId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
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
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $orderimage = OrderImage::findOrFail($id);

        if ($request->file('sketch')) {
            $requestData['sketch'] = FileUploader::upload('sketch', 'public/order_sketches/');
        }
        $orderimage->update($requestData);

        return redirect('order/' . $orderimage->order_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $orderId = OrderImage::findOrFail($id)->order_id;
        OrderImage::destroy($id);

        return redirect('order/' . $orderId);
    }
}
