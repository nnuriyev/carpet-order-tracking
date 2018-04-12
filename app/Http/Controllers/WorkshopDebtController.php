<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Excel;
use App\Exports\WorkshopDebtExport;

use App\WorkshopDebt;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class WorkshopDebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, WorkshopDebt $workshopdebt)
    {
        $user = Auth::user();
        $role = $user->roles()->first()->name;
        
        if($role == 'admin' && $request->has('workshop_id') && !is_null($request->workshop_id)){
            $workshopdebt = $workshopdebt->where('workshop_id', $request->workshop_id);
        }

        if($role == 'admin' && $request->has('order_id') && !is_null($request->order_id)){
            $workshopdebt = $workshopdebt->where('order_id', $request->order_id);
        }

        if($request->has('type') && !is_null($request->type)){
            $columnName = $request->type == 1 ? 'paid' : 'debt';
            $workshopdebt = $workshopdebt->where($columnName, '!=' , null);
        }

        if($request->has('date_from') && !is_null($request->date_from)){
            $workshopdebt = $workshopdebt->where('created_at','>=', $request->date_from);
        }

        if($request->has('date_to') && !is_null($request->date_to)){
            $workshopdebt = $workshopdebt->where('created_at','<=', $request->date_to . ' 23:59:59');
        }


        $perPage = 100;
        if($role == 'admin' ){
            $workshopdebt = $workshopdebt->orderBy('id', 'desc')->paginate($perPage);
        }else{
            $workshopdebt = $workshopdebt->where('workshop_id', $user->id)
            ->orderBy('id', 'desc')->paginate($perPage);
        }
        

        if(count($request->all()) > 0 ){
            $workshopdebt->appends(request()->query())->links();
        }
        
        $workshops = User::whereHas('roles', function($query){
            $query->where('roles.name', 'workshop');
        })->pluck('name', 'id');

        return view('app/pages.workshop-debt.index', compact('workshopdebt', 'workshops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $workshops = User::whereHas('roles', function($query){
            $query->where('roles.name', 'workshop');
        })->pluck('name', 'id');

        return view('app/pages.workshop-debt.create', compact('workshops'));
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

        WorkshopDebt::create($requestData);

        return redirect('workshop-debt')->with('flash_message', 'WorkshopDebt added!');
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
        $workshopdebt = WorkshopDebt::findOrFail($id);

        return view('app/pages.workshop-debt.show', compact('workshopdebt'));
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
        $workshopdebt = WorkshopDebt::findOrFail($id);
        $workshops = User::whereHas('roles', function($query){
            $query->where('roles.name', 'workshop');
        })->pluck('name', 'id');

        return view('app/pages.workshop-debt.edit', compact('workshopdebt', 'workshops'));
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
        
        $workshopdebt = WorkshopDebt::findOrFail($id);
        $workshopdebt->update($requestData);

        return redirect('workshop-debt')->with('flash_message', 'WorkshopDebt updated!');
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
        WorkshopDebt::destroy($id);

        return redirect('workshop-debt')->with('flash_message', 'WorkshopDebt deleted!');
    }

    public function export(Request $request, WorkshopDebt $workshopdebt, Excel $excel)
    {
        $user = Auth::user();
        $role = $user->roles()->first()->name;

        if($role == 'admin' && $request->has('workshop_id') && !is_null($request->workshop_id)){
            $workshopdebt = $workshopdebt->where('workshop_id', $request->workshop_id);
        }

        if($role == 'admin' && $request->has('order_id') && !is_null($request->order_id)){
            $workshopdebt = $workshopdebt->where('order_id', $request->order_id);
        }

        if($request->has('type') && !is_null($request->type)){
            $columnName = $request->type == 1 ? 'paid' : 'debt';
            $workshopdebt = $workshopdebt->where($columnName, '!=' , null);
        }

        if($request->has('date_from') && !is_null($request->date_from)){
            $workshopdebt = $workshopdebt->where('created_at','>=', $request->date_from);
        }

        if($request->has('date_to') && !is_null($request->date_to)){
            $workshopdebt = $workshopdebt->where('created_at','<=', $request->date_to . ' 23:59:59');
        }

        if($role == 'admin' ){
            $workshopdebt = $workshopdebt->orderBy('id', 'desc')->get();
        }else{
            $workshopdebt = $workshopdebt->where('workshop_id', $user->id)
                ->orderBy('id', 'desc')->get();
        }

        $export = new WorkshopDebtExport($workshopdebt);
        return $excel->download($export, 'Workshop-debt.xlsx');
    }
}
