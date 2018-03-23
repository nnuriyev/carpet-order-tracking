<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GeneralCost;
use Illuminate\Http\Request;

class GeneralCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, GeneralCost $generalcost)
    {
        if($request->has('type') && !is_null($request->type)){
            $generalcost = $generalcost->where('type', $request->type);
        }

        if($request->has('date_from') && !is_null($request->date_from)){
            $generalcost = $generalcost->where('created_at','>=', $request->date_from);
        }

        if($request->has('date_to') && !is_null($request->date_to)){
            $generalcost = $generalcost->where('created_at','<=', $request->date_to . ' 23:59:59');
        } 


        $perPage = 100;
        $generalcost = $generalcost->orderBy('id', 'desc')->paginate($perPage);
        
        if(count($request->all()) > 0 ){
            $generalcost->appends(request()->query())->links();
        }

        return view('app/pages.general-cost.index', compact('generalcost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('app/pages.general-cost.create');
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
        
        GeneralCost::create($requestData);

        return redirect('general-cost')->with('flash_message', 'GeneralCost added!');
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
        $generalcost = GeneralCost::findOrFail($id);

        return view('app/pages.general-cost.show', compact('generalcost'));
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
        $generalcost = GeneralCost::findOrFail($id);

        return view('app/pages.general-cost.edit', compact('generalcost'));
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
        
        $generalcost = GeneralCost::findOrFail($id);
        $generalcost->update($requestData);

        return redirect('general-cost')->with('flash_message', 'GeneralCost updated!');
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
        GeneralCost::destroy($id);

        return redirect('general-cost')->with('flash_message', 'GeneralCost deleted!');
    }
}
