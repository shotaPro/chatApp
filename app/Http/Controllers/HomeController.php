<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function redirect()
    {

        if (Auth::id()) {

            return view('user.home');

        }else {

            return view('dashboard');

        }
    }
}
