<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableController extends Controller
{
    public function index(){
        return view('admin.tables.index');
    }

    public function show(Table $table){
        return view('admin.tables.show', compact('table'));
    }
}
