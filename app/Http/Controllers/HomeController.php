<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function login2(){
        $res = Http::post('http://127.0.0.1:8000/api/login', ['email', 'password']);
        echo $res->getStatusCode(); // 200
        echo $res->getBody(); // { "type": "User", ....
    }
}
