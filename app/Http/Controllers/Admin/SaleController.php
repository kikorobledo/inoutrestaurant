<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index(){
        return view('admin.sales.index');
    }

    public function create(){
        return view('admin.sales.create');
    }

    public function edit(Sale $sale){

        $this->authorize('view', $sale);

        return view('admin.sales.edit', compact('sale'));
    }

    public function receipt(Sale $sale){
        $pdf = PDF::loadView('admin.sales.receipt', compact('sale'));
        return $pdf->stream('invoice.pdf');
    }
}
