@extends('frontend.layout.app')
@section('title','A-Mobile | Payment')
@push('style')
<style>
  a:hover {
    color: #000;
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
  .payment-form input[type=text], input[type=number] {
    height: 45px;
    background: #f8f8f8;
    border: #f8f8f8;
    border-radius: 5px;
  }

  .payment-form .back-button, .payment-form .continue-button:hover {
    background: none;
    color: #101d30;
  }
  .payment-form .continue-button, .payment-form .back-button:hover {
    background: #101d30;
    color: #fff;
  }
  .payment-form .back-button,
  .payment-form .continue-button {
    border: 1px solid #101d30;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }
  .payment-method {
    border: 1px solid #ddd !important;
    border-radius: 7px;
    padding: 15px;
  }
  .payment-radio {
    width: 22px;
    height: 22px;
    background: #fff;
  }
  .payment-radio:checked {
    /* border: #000 !important;
    background-color: #000 !important; */
  }
  input[type='radio'] {
    -webkit-appearance:none;
    border:1px solid #ddd;
    border-radius:50%;
    outline:none;
  }
  input[type='radio']:before {
    content:'';
    display:block;
    width:60%;
    height:60%;
    margin: 20% auto;    
    border-radius:50%;    
  }
  input[type='radio']:checked {
    border:1px solid #000 !important;
    background-color: #fff;
  }
  input[type='radio']:checked:before {
    background:#000;
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
<section class="row justify-content-center px-3 px-lg-5 py-5">
  <div class="container">
   
    <form action="{{ route('payment.session.store')}}" method="post" class="row payment-form">
      @csrf
      <div class="col-12 col-md-6">
        <div class="d-flex justify-content-center align-items-center sn-bar">
          <div class="me-3 active"></div>
          <div class="me-3 active"></div>
          <div></div>
        </div>
        <div class="mt-4 mt-md-5">
          <p class="text-secondary mb-1">Step 02</p>
          <h3 class="mb-4 mb-md-5">Choose Your Payment Method</h3>
          @error('flexRadioDefault')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please Choose Payment Method!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
         @enderror
          <div class="payment-method mb-4">
            <div id="cashInDeli" class="form-check d-flex align-items-center">
              <input class="form-check-input payment-radio" type="radio" value="0" name="flexRadioDefault" id="flexRadioDefault1">
              <label class="form-check-label ms-3 flex-fill" for="flexRadioDefault1">
                <h5 class="mb-1 bold">Cash on Delivery</h5>
                <span class="text-secondary">You can pay after your order has arrived</span>
              </label>
            </div>
          </div>
          <div id="bankPayment" class="payment-method mb-5">
            <div class="form-check d-flex align-items-center">
              <input class="form-check-input payment-radio" type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault1">
              <label class="form-check-label ms-3 flex-fill" for="flexRadioDefault1">
                <h5 class="mb-1 bold">Bank</h5>
                <span class="text-secondary">KBZ, CB, AYA</span>
              </label>
            </div>
          </div>
          <div id="bankPaymentForm" class="d-none">
            <div class="form-group mb-3 mb-md-4">
              <label for="card" class="bold">Card Number</label>
              <input type="text" class="form-control mt-1" id="card" aria-describedby="" placeholder="">
            </div>
            <div class="form-group mb-3 mb-md-4">
              <label for="cardholder" class="bold">Cardholder Name</label>
              <input type="number" class="form-control mt-1" id="cardholder" aria-describedby="" placeholder="">
            </div>
            <div class="row mb-3 mb-md-4">
              <div class="form-group col-6 position-relative">
                <label for="expire-date" class="bold">Expire Date</label>
                <input type="text" class="form-control mt-1" id="expire-date" aria-describedby="" placeholder="">
              </div>
              <div class="form-group col-6 position-relative">
                <label for="cvv" class="bold">CVV Code</label>
                <input type="text" class="form-control mt-1" id="cvv" aria-describedby="" placeholder="">
              </div>
            </div>
          </div>
        </div>
        <div class="d-none d-md-block">
          <div class="d-flex justify-content-between mt-5">
            <a href="{{ url('/billing') }}" class="back-button"><i class="fas fa-arrow-left me-2"></i> Back</a>
            <button type="submit" class="continue-button">Continue to Review</button>
          </div>
        </div>
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
   
          @php $total = 0 @endphp

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
        <button type="submit"  class="continue-button w-100 mt-3">Continue to Review</button>
      </div>
    </form>
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