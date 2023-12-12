@extends('frontend.layout.app')
@section('title','A-Mobile | Profile')
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
                    <h3 class="font-weight-bolder">My Profile</h3>
                    <a href="" class="">Edit</a>
                </div>
                <div class="col-12">
                    
                    <div class="col-12 p-lg-5">
                    @error('not_data_changes')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>{{ $message }}</strong> 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                        <form method="post" action="{{ route('user.update')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="mb-3">
                                <label for="userName" class="form-label">User Name</label>
                                <input type="text" name="name" class="form-control @error('name')
                                    is-invalid
                                @enderror" id="userName" value="{{ old('name',$user->name) }}">
                                @error('name')
                                    <span class="text-danger font-weight-bolder">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email')
                                    is-invalid
                                @enderror" name="email" id="exampleInputEmail1"value="{{ old('email',$user->email) }}">
                                @error('email')
                                    <span class="text-danger font-weight-bolder">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone',$user->phone)}}">

                            </div>
                            <div class="w-100 d-flex justify-content-center">
                              <button type="submit" class="btn btn-primary bg-blue-dark border-0">Save Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
