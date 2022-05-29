@extends('layouts.app')

@push('styles')
<style>
    body{
    margin-top:20px;
    background:#eee;
}
.ui-w-40 {
    width: 40px !important;
    height: auto;
}

.card{
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
}

.ui-product-color {
    display: inline-block;
    overflow: hidden;
    margin: .144em;
    width: .875rem;
    height: .875rem;
    border-radius: 10rem;
    -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    vertical-align: middle;
}
</style>
@endpush

@section('content')

<div class="container p-4">
    <div class="row g-0 mb-4 border border-gray">
        <div class="col-md-8 d-flex align-items-center" style="font-size: 18px;">
            <a href="{{ url('/') }}" class="ms-2 font-weight-bold me-1" style="text-decoration: none">Home </a> > <span class="ms-1">Shopping Cart</span>
        </div>
        <div class="col-md-4 g-0">
            <a href="{{ url('/') }}" class="btn btn-success float-end m-0">Back to Home</a>
        </div>
    </div>

    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h2>Shopping Cart</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="row g-0 mb-2">
                    <div id="success" class="col-12 text-center text-success" style="font-size: 18px">{{ session('success') }}</div>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                  <thead>
                    <tr>
                      <th style="width:5%">#</th>
                      <th style="width:15%">Image</th>
                      <th style="width:30%">Name</th>
                      <th style="width:10%">Price</th>
                      <th style="width:10%">Quantity</th>
                      <th style="width:20%">SubTotal</th>
                      <th style="width:10%">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @php $total = 0 @endphp
                    @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp

                    <tr data-id="{{ $id }}">

                        <td>{{ $id++ }}</td>
                        <td>
                            @if ($details['image'])
                            <img src="{{ config('app.backend_url') }}/product-images/{{ $details['image'] }}" width="80" height="60" class="img-responsive" />
                            @else
                            <img src="https://www.freeiconspng.com/uploads/no-image-icon-11.PNG" width="80" height="60" class="img-responsive" />
                            @endif
                        </td>
                        <td>{{ $details['name'] }}</td>
                        <td>${{ $details['price'] }}</td>
                        <td data-th="Quantity">
                            <input type="number" min="1" value="{{ $details['quantity'] }}"
                                class="form-control quantity update-cart text-center" />
                        </td>
                        <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                        <td class="actions" data-th="">
                            <button class="btn btn-danger btn-sm remove-from-cart">
                                <i class="fa-solid fa-trash-can"></i> Remove
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    
                  </tbody>

                  <tfoot>
                    <tr>
                        <td colspan="5"></td>
                        <td><h3><strong>Total ${{ $total }}</strong></h3></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <a href="{{ url('/') }}" class="btn btn-lg btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                        </td>
                        <td colspan="2"><button class="btn btn-lg btn-success">Checkout</button></td>
                    </tr>
                </tfoot>

                </table>
              </div>

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

</script>
@endpush

