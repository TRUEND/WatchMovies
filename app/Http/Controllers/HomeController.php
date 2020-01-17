<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $User = User::AuthUser();

        return view("home", [
            "User"=> $User,
        ]);
    }
}
