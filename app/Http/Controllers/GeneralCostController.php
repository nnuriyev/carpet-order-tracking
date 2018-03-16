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
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $generalcost = GeneralCost::paginate($perPage);
        } else {
            $generalcost = GeneralCost::paginate($perPage);
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
