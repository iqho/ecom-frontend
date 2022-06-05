<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('products.checkout');
    }

    public function confirmOrder(Request $request)
    {
        // return $request->all();
        $productNames = $request->productName;
        $productPrices = $request->productPrices;
        $productQuantity = $request->productQuantity;
        $subTotal = $request->subTotal;

        $allItemSubTotal = $request->allItemSubTotal;
        $shippingFee = $request->shippingFee;
        $tax = $request->tax;
        $promoCodeAmount = $request->promoCodeAmount;
        $grandTotal = $request->grandTotal;

        $shippingUserName = $request->shippingUserName;
        $shippingAddress = $request->shippingAddress;
        $shippingUserMobile = $request->shippingUserMobile;
        $billingUserName = $request->billingUserName;
        $billingAddress = $request->billingAddress;
        $billingUserMobile = $request->billingUserMobile;

        $paymentMethod = $request->paymentMethod;
        $mobileBankingGateway = $request->mobileBankingGateway;
        $mobileBankingTransactionId = $request->mobileBankingTransactionId;

        $cardHolderName = $request->cardHolderName;
        $cardNumber = $request->cardNumber;
        $cardExpireDate = $request->cardExpireDate;
        $cardSecretCode = $request->cardSecretCode;

        return $grandTotal;



        $response = Http::post(
            'http://127.0.0.1:8000/api/store-order',
            [
                'name' => 'Steve',
                'role' => 'Network Administrator',
            ]
        );
    }
}
