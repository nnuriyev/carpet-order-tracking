<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerPayment;

use Maatwebsite\Excel\Excel;
use App\Exports\CustomerPaymentExport;

class CustomerPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, CustomerPayment $customerPayments)
    {
    

        if($request->has('type') && !is_null($request->type)){
            $customerPayments = $customerPayments->where('type', $request->type);
        }

        if($request->has('date_from') && !is_null($request->date_from)){
            $customerPayments = $customerPayments->where('created_at','>=', $request->date_from);
        }

        if($request->has('date_to') && !is_null($request->date_to)){
            $customerPayments = $customerPayments->where('created_at','<=', $request->date_to . ' 23:59:59');
        } 


        $perPage = 100;
        $customerPayments = $customerPayments->orderBy('id', 'desc')->paginate($perPage);
        
        if(count($request->all()) > 0 ){
            $customerPayments->appends(request()->query())->links();
        }

        return view('app/pages.customer-payment.index', compact('customerPayments'));
    }


    public function export(Request $request, CustomerPayment $customerPayments, Excel $excel) 
    {
        if($request->has('type') && !is_null($request->type)){
            $customerPayments = $customerPayments->where('type', $request->type);
        }

        if($request->has('date_from') && !is_null($request->date_from)){
            $customerPayments = $customerPayments->where('created_at','>=', $request->date_from);
        }

        if($request->has('date_to') && !is_null($request->date_to)){
            $customerPayments = $customerPayments->where('created_at','<=', $request->date_to . ' 23:59:59');
        } 

        $customerPayments = $customerPayments->orderBy('id', 'desc')->get();

        $export = new CustomerPaymentExport($customerPayments);
        return $excel->download($export, 'Customer-Payments.xlsx');
    }
}
