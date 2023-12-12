@extends('frontend.layout.app')
@section('title','A-Mobile | Add to Cart')
@push('style')
    <style>
        .mt-4-5{
            margin-top: 35px;
        }
        .cart-img{
            width: 100px;
            height: 100px;
            padding: 0;
            background-color: #0b1c35;
        }

        .cart-img img{
            width:100%;
            height: 100%;
            object-fit: fill;
        }

        .white-smoke{
            background-color: #f2f2f2;
        }

        @media screen and (max-width: 778px) {
            .cart-img{
                width: 50px;
                height: 50px;
                padding: 0;
            }
            .mobile-d-none{
                display: none;
            }
            .mobile-cart-title-text{
                font-size: 10px;
            }

            .cart-btn{
                width: 30px;
                height: 30px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .text-small{
                font-size: 12px;
            }

            .order-summary-title{
                font-size: 18px;
                font-weight: 900;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8  p-lg-0 p-1 mb-5">
                <div class="w-100 mb-lg-2 p-lg-3">
                    <h2 class="font-weight-bolder mx-lg-5">My Cart</h2>
                </div>
                <div class="p-lg-1 mx-lg-5 mb-3">
                  <table class="table table-borderless align-middle mb-0 bg-white">
                    <thead class="border-bottom">
                        <tr>
                            <th class="text-black-50">Item</th>
                            <th class="text-black-50">Quantity</th>
                            <th class="text-black-50 text-center">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $total = 0 @endphp

                    @if(session('cart'))
                        @forelse(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr data-id="{{ $id }}">
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center w-100">
                                            <div class="cart-img d-flex rounded-2">
                                              <img src="{{ $details['image'] }}" class="rounded-2"/>
                                            </div>
                                            <div class="mt-2">
                                              <p class="nomargin mx-lg-3 mx-2 mobile-cart-title-text mb-0">{{ $details['name'] }}</p>
                                              <p class="nomargin mx-lg-3 mx-2 mobile-cart-title-text text-black-50">Color: purple</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Quantity">
                                    <div class="d-flex">
                                         <button class="update-cart-plus cart-btn btn white-smoke">+</button>
                                         <span class="w-25 px-3 p-lg-0 quantity d-flex justify-content-center align-items-center">{{ $details['quantity'] }}</span>
                                         <button class="update-cart-minus cart-btn btn white-smoke">-</button>
                                    </div>
                                </td>
                                <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                                <!-- <td class="actions d-none d-lg-block mt-4-5" data-th="">
                                    <button class="btn btn-danger btn-sm remove-from-cart">Remove From Cart</button>
                                </td>  -->
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"> There is no items</td>
                            </tr>
                        @endforelse
                    @else
                         <tr>
                            <td colspan="3"> <p class="text-center font-weight-bolder mt-5">There is no items</p></td>
                        </tr>
                    @endif
                    </tbody>
                   </table>
                </div>
                <div class="p-1 mx-5 d-flex justify-content-lg-between justify-content-center">
                 <a href="/products/all" class="btn btn-outline-dark rounded-0 d-lg-flex align-items-center d-none"> 
                    <i class="fas fa-long-arrow-alt-left"></i> 
                    <span class="mx-2">Continue to Shopping</span>
                 </a>
                 @if (session('cart'))
                 <a href="{{ url('/billing') }}" class="btn btn-dark rounded-0 text-small">Proceed to Checkout</a>
                 @endif
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card border-0">
                    <div class="card-header p-lg-5 border-0">
                        <div class="d-flex align-items-center mb-3">
                            <h3 class="order-summary-title">Order Summary </h3> 
                            @if (count((array) session('cart')) < 1)
                              <span class="mx-2">( {{ count((array) session('cart')) }} item)</span>
                            @else
                              <span class="mx-2">( {{ count((array) session('cart')) }} items )</span>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between mb-5">
                            <span class="font-weight-bolder">Subtotal</span>
                            <span class="font-weight-bolder">$ {{ $total }}</span>
                        </div>
                        <hr class="bg-secondary ">
                        <div class="mb-1">
                            <span class="text-info font-weight-bolder">Use Discount Code</span>
                        </div>
                        <div class="d-flex justify-content-between mb-5">
                            <span class="font-weight-bolder">Total</span>
                            <span class="font-weight-bolder">$ {{ $total }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(".update-cart-plus").on('click',function (e) {
            e.preventDefault();
            var ele = $(this);
            var number = this.nextElementSibling.textContent++;
            
            $.ajax({

                url: "{{ route('update.cart') }}",

                method: "patch",

                data: {

                    _token: '{{ csrf_token() }}', 

                    id: ele.parents("tr").attr("data-id"), 

                    quantity: this.nextElementSibling.textContent

                },

                success: function (response) {

                   window.location.reload();

                }
            });
    });

    $(".update-cart-minus").on('click',function (e) {
            e.preventDefault();
            var ele = $(this);
            var number = this.previousElementSibling.textContent--;

            if(number <= 1){
                $(this.parentElement.parentElement.parentElement).hide()
                $.ajax({

                    url: "{{ route('remove.from.cart') }}",

                    method: "DELETE",

                    data: {

                        _token: '{{ csrf_token() }}', 

                        id: ele.parents("tr").attr("data-id")

                    },

                    success: function (response) {

                        window.location.reload();

                    }
                });

            }else{

                $.ajax({

                    url: "{{ route('update.cart') }}",

                    method: "patch",

                    data: {

                        _token: '{{ csrf_token() }}', 

                        id: ele.parents("tr").attr("data-id"), 

                        quantity: this.previousElementSibling.textContent

                    },

                    success: function (response) {

                      window.location.reload();

                    }
                });
                            
            }
        
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {

            $.ajax({

                url: "{{ route('remove.from.cart') }}",

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