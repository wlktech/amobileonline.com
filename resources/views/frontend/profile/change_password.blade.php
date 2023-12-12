@extends('frontend.layout.app')
@php
    $user = Auth::user();
    $url = 'http://127.0.0.1:8000/';
@endphp
@push('style')
    <style>

        .user-active{
                font-weight: 900;
         }
        .profile{
            width: 100px;
            height: 100px;
        }
        .bg-smoke{
            background-color: #f5f5f5;
        }

        .ml{
            margin-left: 10px;
        }
        .bg-blue-dark{
            background-color: #101d30;
        }
        .bg-blue-dark:hover{
            background-color: #ffffff;
            color: #000;
            border: 1px solid #000 !important;
        }
    </style>
@endpush
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 mb-5 d-flex justify-content-center p-0">
            @include('frontend.profile.sidebar')
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-12 d-flex justify-content-between p-3">
                    <h3 class="font-weight-bolder">Change Password</h3>
                    <a href="" class="">Edit</a>
                </div>
                <div class="col-12">
                    <div class="col-12 p-lg-5">
                        <form method="post" action="{{ route('change_password.store')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="oldPassword" class="form-label">Current Password</label>
                                <div class="position-relative">
                                  <input type="password" name="current_password" class="form-control @error('current_password')
                                    is-invalid
                                    @enderror" id="oldPassword">
                                    <i class="fas fa-eye-slash" id="togglePassword" onclick="toggleEye(this)"></i>
                                </div>
                                @error('current_password')
                                    <span class="text-danger font-weight-bolder">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="new-password" class="form-label">New Password</label>
                                <div class="position-relative">
                                   <input type="password" name="new_password" class="form-control @error('new_password')
                                       is-invalid
                                    @enderror" name="email" id="new-password">
                                    <i class="fas fa-eye-slash" id="togglePassword" onclick="toggleEyeNewPassword(this)"></i>
                                </div>
                                @error('new_password')
                                    <span class="text-danger font-weight-bolder">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="new-confirm-password" class="form-label">New Confirm Password</label>
                                <div class="position-relative">
                                  <input type="password" name="new_confirm_password" class="form-control @error('email')
                                    is-invalid
                                  @enderror" name="email" id="new-confirm-password">
                                  <i class="fas fa-eye-slash" id="togglePassword" onclick="toggleEyeNewConfirmPassword(this)"></i>
                                </div>
                                @error('new_confirm_password')
                                    <span class="text-danger font-weight-bolder">{{ $message}}</span>
                                @enderror
                            </div>
                         
                            <div class="w-100 d-flex justify-content-center">
                              <button type="submit" class="btn btn-primary bg-blue-dark border-0" >Save Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
    function toggleEye(e){
        var x = document.getElementById("oldPassword");
        if (x.type === "password") {
            x.type = "text";
            } else {
                x.type = "password";
            }
            $(e).toggleClass('fas fa-eye-slash fas fa-eye');
    }

    function toggleEyeNewPassword(e){
        var x = document.getElementById("new-password");
        if (x.type === "password") {
            x.type = "text";
            } else {
                x.type = "password";
            }
            $(e).toggleClass('fas fa-eye-slash fas fa-eye');

    }

    function toggleEyeNewConfirmPassword(e){
        var x = document.getElementById("new-confirm-password");
        if (x.type === "password") {
            x.type = "text";
            } else {
                x.type = "password";
            }
            $(e).toggleClass('fas fa-eye-slash fas fa-eye');

    }
    </script>
@endpush
