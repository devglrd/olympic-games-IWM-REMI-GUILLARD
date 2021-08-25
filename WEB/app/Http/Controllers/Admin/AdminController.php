<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    const PATH_VIEW = 'admin.entities.';

    const CONTROLLER = 'Admin\AdminController@';
    public function dashboard(Request  $request)
    {
        return view(self::PATH_VIEW . 'dashboard')->with([

        ]);
    }

    public function logout(Request  $request)
    {
        session()->forget('auth');
        session()->forget('user');
        session()->forget('token');


        return redirect('/')->with('success', 'Logout successfully');
    }


}
