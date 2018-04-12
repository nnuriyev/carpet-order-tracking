<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class WorkshopDebtExport implements FromView
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('app.pages.workshop-debt.export', [
            'workshopdebt' => $this->data
        ]);
    }
    
}