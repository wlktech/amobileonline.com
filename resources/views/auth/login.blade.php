@extends('frontend.layout.app')
@section('title','A-Mobile | Login')
@push('style')
<style>
  a:hover {
    color: #000;
  }
  h3, h4, .bold {
    font-weight: 900;
  }
  .semi-bold {
    font-weight: 600;
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
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 my-5 p-3 p-md-5 user-login">
            <div class="">
                <div class="">
                    <h3 class="mb-4">{{ __('Login') }}</h3>
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
                          <div class="position-relative">
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                              <i class="fas fa-eye-slash" id="togglePassword" onclick="toggleEye(this)"></i>
                          </div>
                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                        <div class="form-check">
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

                        <button type="submit" class="login-button mt-3">
                            {{ __('Login') }}
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
    </script>
@endpush