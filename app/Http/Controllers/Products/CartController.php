<?php

namespace App\Http\Controllers\Products;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function cartIndex()
    {
        return view('products.cart');
    }

    // public function addToCart($id)
    // {
    //     $product = Http::get(config('app.backend_url') . '/api/api-products/' . $id)->json();

    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity']++;
    //     } else {
    //         $cart[$id] = [
    //             "name" => $product['product']['name'],
    //             "quantity" => 1,
    //             "price" => 100,
    //             "image" => $product['product']['image']
    //         ];
    //     }

    //     session()->put('cart', $cart);
    //     return redirect()->back()->with('success', 'Product added to cart successfully!');
    // }

    public function addToCart($id)
    {
        $product = Http::get(config('app.backend_url') . '/api/api-products/' . $id)->json();
        $cart = session()->get('cart', []);

        $pr = 0;
        foreach ($product['product']['product_prices'] as $key => $price) {
            if ($price['start_date'] <= Carbon::now() && $price['end_date'] > Carbon::now()) {
                $pr = $price['amount'];
                break;
            } elseif ($price['price_type_id'] == 1) {
                $pr = $price['amount'];
                break;
                // return $pr;
            } else {
                $pr = 0;
            }
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product['product']['name'],
                "quantity" => 1,
                "price" => $pr,
                "image" => $product['product']['image']
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
