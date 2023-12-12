
@extends('frontend.layout.app')
@section('title','A-Mobile | Register')
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
  .user-login {
    border: 1px solid #d5d5d5;
    box-shadow: 0px 0px 9px 0px #d5d5d5;
    border-radius: 5px;
  }
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
  /* Tablet */
  @media (max-width: 767px) {
    
  }

  /* Mobile */
  @media screen and (max-width: 480px) {
    .user-login {
      border: none;
      box-shadow: none;
    }
  }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 my-5 p-3 p-md-5 user-login">
            <div class="">
                <div class="">
                    <h3 class="mb-4">{{ __('Register') }}</h3>
                    @error('attempt_error')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>{{ $message }}</strong> 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                      <form method="POST" action="{{ route('checkmail') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name" class="col-form-label semi-bold">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="email" class="col-form-label semi-bold">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="password" class="col-form-label semi-bold">{{ __('Password') }}</label>
                           <div class="position-relative">
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                              <i class="fas fa-eye-slash" id="togglePassword" onclick="toggleEye(this)"></i>
                           </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="password-confirm" class="col-form-label semi-bold">{{ __('Confirm Password') }}</label>
                            <div class="position-relative">
                               <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                               <i class="fas fa-eye-slash" id="togglePassword" onclick="confirmToggleEye(this)"></i>
                            </div>
                        </div>

                        <button type="submit" class="login-button mt-3">
                            {{ __('Register') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
    function toggleEye(e){
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
            } else {
                x.type = "password";
            }
            $(e).toggleClass('fas fa-eye-slash fas fa-eye');
    }

    function confirmToggleEye(e){
        var x = document.getElementById("password-confirm");
        if (x.type === "password") {
            x.type = "text";
            } else {
                x.type = "password";
            }
            $(e).toggleClass('fas fa-eye-slash fas fa-eye');
    }
    </script>
@endpush
