@extends('layouts.app')
@push('style')
<style>
  a:hover {
    color: #000;
  }
  h3, h4, .bold {
    font-weight: 900 !important;
  }
  .semi-bold {
    font-weight: 600 !important;
  }
  /* .user-login {
    
  } */
  .user-login .form-control  {
    height: 45px;
    background: #fff;
  }
  .forget-pass {
    color: #54e18d;
    text-decoration: none;
    font-weight: 600;
  }
  .login-button {
    color: #fff;
    border: 1px solid #101d30;
    background: #101d30;
    width: 100%;
    padding: 8px;
    font-weight: 900;
    font-size: 16px;
    border-radius: 5px;
  }
  .login-button:hover {
    color: #101d30;
    border: 1px solid #101d30;
    background: transparent;
  }
  .upper-header {
    border-top: 3px solid #101d30;
    width: 40px;
    border-radius: 25px;
    margin-bottom: 7px;
  }
  .login-for-show {
    background: #101d30 !important;
    height: 100vh;
    position: relative;
  }
  .login-for-show div {
    margin: 30vh 0;
  }
  .login-for-show .logo {
    width: 150px;
    margin-bottom: 35px;
  }
  .login-for-show .bg-left {
    position: absolute;
    bottom: 0;
    left: -10px;
    opacity: 0.08;
  }
  .login-for-show .bg-right {
    position: absolute;
    bottom: 0;
    right: 0px;
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
    opacity: 0.08;
  }
  .login-for-show-mobile {
    background: #101d30 !important;
    height: 20vh;
    position: relative;
  }
  .login-for-show-mobile .bg-left {
    width: 100px;
    position: absolute;
    bottom: 0;
    left: -10px;
    opacity: 0.08;
  }
  .login-for-show-mobile .bg-right {
    width: 100px;
    position: absolute;
    bottom: 0;
    right: 0px;
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
    opacity: 0.08;
  }
  .login-for-show-mobile img {
    width: 145px;
  }
  /* Tablet */
  @media (max-width: 767px) {
    
  }

  /* Mobile */
  @media screen and (max-width: 480px) {
    
  }
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="d-none d-md-block col-md-6 login-for-show">
          <div class="text-center">
            <img src="{{ asset('images/logos/logo.png')}}" alt="" class="logo">
            <h3 class="text-white">Welcome from A-Mobile</h3>
          </div>
          <span class="bg-left"><img src="{{ asset('images/logos/logoasbg.png')}}" alt="" class=""></span>
          <span class="bg-right"><img src="{{ asset('images/logos/logoasbg.png')}}" alt="" class=""></span>
        </div>
        <div class="col-md-6 p-3 p-md-5 user-login bg-white">
            <div class="text-center mt-5 d-sm-block d-md-none">
              <img src="{{ asset('images/logos/logo.png')}}" alt="" class="w-25 mb-4">
              <h3 class="">Welcome from A-Mobile</h3>
            </div>
            <div class="my-5 pt-5">
                <div class="">
                    @error('login_error')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                  <div class="upper-header d-none d-md-block"></div>
                  <h3 class="mb-4">{{ __('Login as Super Admin') }}</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="email" class="col-form-label semi-bold">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="password" class="col-form-label semi-bold">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-check d-flex align-items-center align-self-center justify-content-between">
                            <div>
                              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                              <label class="form-check-label" for="remember">
                                  {{ __('Remember Me') }}
                              </label>
                            </div>
                            <div>
                              @if (Route::has('password.request'))
                                  <a class="btn btn-link px-0 forget-pass" href="{{ route('password.request') }}">
                                      {{ __('Forgot Your Password?') }}
                                  </a>
                              @endif
                            </div>
                        </div>
                        
                        <button type="submit" class="login-button mt-3">
                            {{ __('Login') }}
                        </button>

                    </form>
                </div>
            </div>
        </div>

        <div class="d-sm-block d-md-none login-for-show-mobile">
          <span class="bg-left"><img src="{{ asset('images/logos/logoasbg.png')}}" alt="" class=""></span>
          <span class="bg-right"><img src="{{ asset('images/logos/logoasbg.png')}}" alt="" class=""></span>
        </div>
    </div>
</div>
@endsection
