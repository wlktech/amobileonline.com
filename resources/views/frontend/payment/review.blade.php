@extends('frontend.layout.app')
@section('title','A-Mobile | Review')
@push('style')
<style>
  .edit{
    color: rgb(1, 29, 150);
  }
  .edit:hover {
    color: rgb(1, 29, 150);
  }
  h3, h4, .bold {
    font-weight: 600;
  }
  .sn-bar div {
    height: 3px;
    background: #ddd;
    width: 11%;
    border-radius: 10px;
  }
  .sn-bar .active {
    background: #101d30;
  }

  .review-form .back-button, .review-form .continue-button:hover {
    background: none;
    color: #101d30;
  }
  .review-form .continue-button, .review-form .back-button:hover {
    background: #101d30;
    color: #fff;
  }
  .review-form .back-button,
  .review-form .continue-button {
    border: 1px solid #101d30;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }
  .billing-edit, .payment-edit {
    background: #f8f8f8;
    border-radius: 3px;
  }
  .order-summary {
    background: #f8f8f8;
  }
  .order-summary h4 span {
    color: #8d8d8d;
    font-size: 18px;
  }
  .pro-info img {
    width: 75px;
    aspect-ratio: 1/1;
    background: #ddd;
  }
  .pro-info h5, .sub-total h5, .price-total h5 {
    width: 90%;
    font-weight: 900;
  }
  .pro-info span, .sub-total span {
    color: #686868;
  }
  .pro-info .price, .sub-total .price, .price-total .price {
    font-weight: 900;
    text-align: right;
    font-size: 17px;
    width: 90px;
  }
  .price-total .price {
    font-size: 19px;
  }
  .sub-total {
    border-bottom: 1px solid #ddd;
    padding: 15px 0;
  }
  /* Tablet */
  @media (max-width: 767px) {
    
  }

  /* Mobile */
  @media screen and (max-width: 480px) {
    .payment-form input, .payment-form select {
      background: #fff !important;
      border: 1px solid #9e9e9e !important;
    }
    .sn-bar div {
      width: 15%;
    }
    .pro-info h5, .pro-info .price {
      font-size: 16px;
    }
  }
</style>
@endpush
@section('content')
@php $total = 0 @endphp
<section class="row justify-content-center px-3 px-lg-5 py-5">
  <div class="container">
    @if (session('billing'))
        <form action="" method="" class="row review-form">
          @csrf
          <div class="col-12 col-md-6">
            <div class="d-flex justify-content-center align-items-center sn-bar">
              <div class="me-3 active"></div>
              <div class="me-3 active"></div>
              <div class="active"></div>
            </div>
            @foreach(session('billing') as $id => $details )
            <div class="mt-4 mt-md-5">
              <p class="text-secondary mb-1">Step 02</p>
              <h3 class="mb-4 mb-md-5">Choose Your Payment Method</h3>
              <div class="billing-edit p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="bold text-dark">Billing Address</h5>
                  <a href="http://" class="bold edit">Edit</a>
                </div>
                <p class="bold text-secondary mb-0">{{ $details['address']}}</p>
              </div>
              <div class="payment-edit p-4 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="bold text-dark">Payment Method</h5>
                  <a href="http://" class="bold edit">Edit</a>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    @if ($details['payment'] == 1)
                     <h6 class="mb-0">Bank</h6>
                    @else
                    <h6 class="mb-0">Cash on Delivery</h6>
                    @endif
                    
                  </div>
               
                  <div class="price">
                    <p class="mb-0 bold text-secondary">$ {{$total}}</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-none d-md-block">
              <div class="d-flex justify-content-between mt-5">
                <a href="{{ url('/payment') }}" class="back-button"><i class="fas fa-arrow-left me-2"></i> Back</a>
                <a href="{{ url('/') }}" class="continue-button">Place Order</a>
              </div>
            </div>
            @endforeach
          </div>
          <div class="col-12 col-md-6">
            <div class="m-0 ms-md-5 p-4 p-md-5 my-3 order-summary">
            <h4>Order Summary 
              @if (count((array) session('cart')) < 1)
                <span class="mx-2">( {{ count((array) session('cart')) }} item)</span>
              @else
                <span class="mx-2">( {{ count((array) session('cart')) }} items )</span>
              @endif
              </h4>
             

                @if(session('cart'))
                    @forelse(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <div class="d-flex align-items-start pro-info mt-5 mb-4">
                          <img src="{{ $details['image'] }}" alt="" class="sn-product-image me-3 me-md-4 flex-fill">
                          <div class="flex-fill me-2">
                            <h5>{{ $details['name'] }}</h5>
                            <p>Quantity : {{ $details['quantity']}}</p>
                          </div>
                          <div class="flex-fill price">
                            <p>${{ $details['price'] * $details['quantity'] }}</p>
                          </div>
                        </div>
                    
                    @empty
                        <tr>
                            <td colspan="3"> There is no items</td>
                        </tr>
                    @endforelse
                @endif
              <div class="d-flex align-items-between sub-total">
                <h5>Subtotal</h5>
                <div class="flex-fill price">
                  <p>$ {{$total}}</p>
                </div>
              </div>
              <div class="my-4">
                <p class="bold" style="color: green;">Use Discount Code</p>
              </div>
              <div class="d-flex align-items-between price-total">
                <h5>Total</h5>
                <div class="flex-fill price">
                  <p>$ {{$total}}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 d-block d-md-none">
            <a href="{{ url('/') }}" class="continue-button w-100 mt-3">Place Order</a>
          </div>
        </form>
    @endif
  </div>
</section>
@endsection
@push('script')
  <script>
    $(document).ready(function(){ 
      $("#cashInDeli").click(function() {
        $("#bankPaymentForm").addClass('d-none');
      });
      $("#bankPayment").click(function() {
        $("#bankPaymentForm").removeClass('d-none');
      }); 
    });
  </script>
@endpush