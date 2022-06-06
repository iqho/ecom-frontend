<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('products.checkout');
    }

    public function confirmOrder(Request $request)
    {

       // return $request->all();
        $response = Http::post('http://127.0.0.1:8000/api/api-orders', $request->all());
        $succMsg = json_decode($response, true);

        //$request->session()->flush('cart');

        return redirect()->route('products.index')->with(['orderSuccess'=> $succMsg]);
    }
}
