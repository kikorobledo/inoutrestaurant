<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProfile extends Controller
{
    public function index(){
        return view('admin.profile.index');
    }
}
