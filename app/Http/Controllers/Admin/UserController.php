<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){

        return view('admin.users.index');

    }

    public function invitation(User $user){

        if(!request()->hasValidSignature() || $user->password != 'password'){
            abort(401);
        }

        auth()->login($user);

        return redirect()->route('admin.index');
    }
}
