@extends('frontend.layout.app')
@section('title','A-Mobile | Contact us')
@push('style')
<style>
  a:hover {
    color: #000;
  }
  h3, h4, .bold {
    font-weight: 600;
  }
  .sn-contact input {
    height: 45px;
  }
  .sn-contact textarea {
    height: 120px;
  }
  .contact-button {
    color: #fff;
    border: 1px solid #101d30;
    background: #101d30;
    width: 100%;
    padding: 10px;
  }
  .contact-button:hover {
    color: #101d30;
    border: 1px solid #101d30;
    background: transparent;
  }
  .contact-banner-container{
    display: flex;
    justify-content: center;
  }
  .contact-banner, .overlay {
    width: 80%;
    height: 500px;
    margin-left: 5%;
    border-radius: 5px;
  }
  .overlay {
    position: absolute; 
    bottom: 0; 
    background: rgb(0, 0, 0);
    background: rgba(0, 0, 0, 0.3); /* Black see-through */
    color: #f1f1f1; 
    height: 100%;
    transition: .5s ease;
    opacity:1;
    color: white;
    font-size: 20px;
    padding: 20px;
    text-align: center;
  }
  /* Tablet */
  @media (max-width: 767px) {
    .contact-banner-container{
      display:none;
    }
  }

  /* Mobile */
  @media screen and (max-width: 480px) {
    
  }
</style>
@endpush
@section('content')
<section class="row justify-content-center px-3 px-lg-5 py-5">
  <div class="container">
    <div class="row sn-contact">
      <div class="col-12 d-flex justify-content-center col-md-6 mb-2">
        <div class="w-100">
          <h3>Contact Us</h3>
              <p class="text-secondary">Our Friendly team would love to hear from you!</p>
              <form action="{{ route('contact.store')}}" class="mt-4" method="post">
                @csrf
                <div class="form-group mb-3">
                <label for="name" class="bold">Name</label>
                  <input type="text" class="form-control mt-1 bg-white @error('name')
                    is-invalid
                  @enderror" id="name" name="name">
                  @error('name')
                    <span class="font-weight-bolder text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group mb-3">
                <label for="phone" class="bold">Phone Number</label>
                  <input type="text" class="form-control mt-1 bg-white @error('phone')
                    is-invalid
                  @enderror" id="phone" name="phone">
                  
                  @error('phone')
                    <span class="font-weight-bolder text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label for="email" class="bold">Email</label>
                  <input type="email" name="email" class="form-control mt-1 bg-white @error('email')
                    is-invalid
                  @enderror" id="email" placeholder="Email">
                  @error('email')
                    <span class="font-weight-bolder text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group mb-3">
                  <label for="message" class="bold">Message</label>
                  <textarea class="form-control @error('message')
                    is-invalid
                  @enderror mt-1 bg-white" id="message" name="message" rows="3"></textarea>
                  @error('message')
                    <span class="font-weight-bolder text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <button type="submit" class="btn contact-button mt-2">Submit</button>
                
              </form>
        </div>
      </div>
      <div class="col-sm col-md-6 mb-4 ps-2 ">
        <div class="position-relative contact-banner-container">
          <img src="{{ asset('images/assets/contact.png')}}" alt="" class="contact-banner">
          <div class="overlay"></div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection