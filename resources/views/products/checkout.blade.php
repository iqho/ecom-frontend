@extends('layouts.app')

@section('title', 'Checkout Page')

@push('styles')
<style>
    body {
        margin-top: 20px;
        background: #eee;
    }

    .ui-w-40 {
        width: 40px !important;
        height: auto;
    }

    .card {
        box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
    }

    .ui-product-color {
        display: inline-block;
        overflow: hidden;
        margin: .144em;
        width: .875rem;
        height: .875rem;
        border-radius: 10rem;
        -webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15) inset;
        vertical-align: middle;
    }

    .info {
        display: none;
    }
</style>
@endpush

@section('content')

<div class="container p-4" id="confirmOrderDiv">
    <div class="row g-0 mb-4 border border-gray">
        <div class="col-md-8 d-flex align-items-center" style="font-size: 18px;">
            <a href="{{ url('/') }}" class="ms-2 font-weight-bold me-1" style="text-decoration: none">Home </a> > <span
                class="ms-1">Order Summary</span>
        </div>
        <div class="col-md-4 g-0">
            <a href="{{ url('/') }}" class="btn btn-success float-end m-0">Back to Home</a>
        </div>
    </div>

    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h2>Order Summary</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="row g-0 mb-2">
                <div id="success" class="col-12 text-center text-success" style="font-size: 18px">{{ session('success')
                    }}</div>
            </div>
            @endif

            <form action="{{ route('confirmOrder') }}" method="post">
                @csrf
                <div class="row">
                    <div class="table-responsive col-md-8">
                        <table class="table table-bordered align-middle text-center">
                            <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th style="width:15%">Image</th>
                                    <th style="width:30%">Name</th>
                                    <th style="width:10%">Price</th>
                                    <th style="width:10%">Quantity</th>
                                    <th style="width:20%">Sub Total</th>
                                    <th style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php $allItemSubTotal = 0 @endphp
                                @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                @php
                                $allItemSubTotal += $details['price'] * $details['quantity'];
                                $subTotal = $details['price'] * $details['quantity']
                                @endphp

                                <tr data-id="{{ $id }}">

                                    <td>{{ $id++ }}</td>
                                    <td>
                                        @if ($details['image'])
                                        <img src="{{ config('app.backend_url') }}/product-images/{{ $details['image'] }}"
                                            width="80" height="60" class="img-responsive" />
                                        @else
                                        <img src="https://www.freeiconspng.com/uploads/no-image-icon-11.PNG" width="80"
                                            height="60" class="img-responsive" />
                                        @endif
                                    </td>
                                    <td>
                                        <input type="hidden" name="productName[]" value="{{ $details['name'] }}">
                                        {{ $details['name'] }}
                                    </td>
                                    <td>
                                        <input type="hidden" name="productPrices[]" value="{{ $details['price'] }}">
                                        ${{ $details['price'] }}
                                    </td>
                                    <td data-th="Quantity">
                                        <input type="number" min="1" name="productQuantity[]"
                                            value="{{ $details['quantity'] }}"
                                            class="form-control quantity update-cart text-center" />
                                    </td>
                                    <td data-th="Subtotal" class="text-center">
                                        <input type="hidden" name="subTotal[]" value="{{ $subTotal }}">
                                        ${{ $subTotal }}
                                    </td>
                                    <td class="actions" data-th="">
                                        <button class="btn btn-danger btn-sm remove-from-cart">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                                @php
                                $shippingFee = 80 ;
                                $tax = 50 ;
                                $promoCodeAmount = 50;
                                $grandTotal = ($allItemSubTotal + $shippingFee + $tax) - $promoCodeAmount ;
                                @endphp

                                <tr>
                                    <td colspan="5" class="text-end">
                                        <h5><strong>Item ( {{ count((array) session('cart')) }} ) Sub Total</strong>
                                        </h5>
                                    </td>
                                    <td>
                                        <input type="hidden" name="allItemSubTotal" value="{{ $allItemSubTotal }}">
                                        <h5><strong>${{ $allItemSubTotal }}</strong></h5>
                                    </td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td colspan="5" class="text-end"><strong>Shipping Fee</strong></td>
                                    <td>
                                        <input type="hidden" name="shippingFee" value="{{ $shippingFee }}">
                                        <strong>${{ $shippingFee }}</strong>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end"><strong>Tax</strong></td>
                                    <td>
                                        <input type="hidden" name="tax" value="{{ $tax }}">
                                        <strong>${{ $tax }}</strong>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-end" colspan="3">
                                        <div class="input-group" style="height: 30px; margin:0px; padding:0px">
                                            <strong style="margin-right:10px">Promo Code </strong>
                                            <input type="text" class="form-control" placeholder="IQBHOS50"
                                                style="height: 30px">
                                            <input class="btn btn-success btn-sm m-0" type="submit" value="Redeem">
                                        </div>
                                    </td>
                                    <td class="text-end" colspan="2">
                                        Redeem Code: <strong style="color:red">IQBHOS50</strong>
                                    </td>
                                    <td>
                                        <input type="hidden" name="promoCodeAmount" value="{{ $promoCodeAmount }}">
                                        <strong>-${{ $promoCodeAmount }}</strong>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-end">
                                        <h3><strong>Grand Total</strong></h3>
                                    </td>
                                    <td>
                                        <input type="hidden" name="grandTotal" value="{{ $grandTotal }}">
                                        <h3><strong>${{ $grandTotal }}</strong></h3>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Shipping Address</h5>
                                    </div>
                                    <div class="card-body">
                                        <label for="shippingUserName">Shipping Customer Name</label>
                                        <input type="text" name="shippingUserName" value="Iqbal"
                                            class="form-control mb-2" id="shippingUserName">
                                        <label for="shippingAddress">Shipping Customer Full Address</label>
                                        <textarea name="shippingAddress" id="shippingAddress" rows="3"
                                            class="form-control">371/A, Block: D, Bashundhara R/A, Baridhara, Dhaka - 1229
                                        </textarea>
                                        <label for="shippingUserMobile" class="mt-2">Shipping Customer Mobile</label>
                                        <input type="text" name="shippingUserMobile" id="shippingUserMobile"
                                            value="01xxxxxxxxx" class="form-control">
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h5>Billing Address</h5>
                                    </div>
                                    <div class="card-body">
                                        <label for="billingCustomerName">Billing Customer Name</label>
                                        <input type="text" name="billingUserName" value="Mokbul Hossen"
                                            class="form-control mb-2" id="billingCustomerName">
                                        <label for="billingAddress">Billing Customer Full Address</label>
                                        <textarea name="billingAddress" id="billingAddress" rows="3"
                                            class="form-control">Joybishupur, Sukhia, Pakundia, Kishoreganj - 2326
                                        </textarea>
                                        <label for="billingUserMobile" class="mt-2">Billing Customer Mobile</label>
                                        <input type="text" name="billingUserMobile" value="01xxxxxxxxx"
                                            class="form-control" id="billingUserMobile">
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h5> Payment Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="paymentMethod"
                                                id="paymentMethod1" value='1' checked>
                                            <label class="form-check-label" for="paymentMethod1">
                                                Cash or Delivery
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value='2' type="radio" name="paymentMethod"
                                                id="paymentMethod2">
                                            <label class="form-check-label" for="paymentMethod2">
                                                Mobile Banking
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value='3' type="radio" name="paymentMethod"
                                                id="paymentMethod3">
                                            <label class="form-check-label" for="paymentMethod3">
                                                Card Payment
                                            </label>
                                        </div>
                                        <div class='info' id='info2'>
                                            <select class="form-control" name="mobileBankingGateway">
                                                <option>Bkash</option>
                                                <option>Nagad</option>
                                                <option>Rocket</option>
                                            </select> <br>
                                            <input type="text" class="form-control" name="mobileBankingTransactionId"
                                                placeholder="Transaction Number" />
                                        </div>

                                        <div class='info' id='info3'>
                                            Card Holder Name: <input type="text" name="cardHolderName"
                                                class="form-control" placeholder="Card Holder Name" /><br>
                                            Card Number: <input type="number" name="cardNumber" class="form-control"
                                                placeholder="Card Number" /><br>
                                            Card Expired Date<input type="date" name="cardExpireDate"
                                                class="form-control" placeholder="Transaction Number" /><br>
                                            Secret Code: <input type="number" name="cardSecretCode" class="form-control"
                                                placeholder="Transaction Number" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <input type="submit" value="Confirm Order" class="btn btn-primary btn-lg">
                            </div>
                        </div>
                        <div class="row">

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection



@push('scripts')
<script type="text/javascript">
    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

// Payment Option Select
var update = function() {
    $(".info").hide();
    $("#info" + $(this).val()).show();
};
$("input[type='radio']").change(update);



    document.getElementById("confirmOrderDiv").style.display = "none";

    if(localStorage.getItem('authToken') !== null)
    {
        document.getElementById("confirmOrderDiv").style.display = "block";
        var userName = JSON.parse(localStorage.getItem("userData"));
        $('a#myName').text(userName.name);
        console.log(localStorage.getItem('authToken'));
    }
    else
    {
        window.location.href = "/login";
    }
</script>
@endpush
