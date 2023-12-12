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
                    <h3 class="font-weight-bolder">Billing Address</h3>
                    <a href="" class="">Edit</a>
                </div>
                <div class="col-12">
                    @if(Session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>{{ Session('success')}}</strong> 
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="col-12 p-0">
                        <form method="post" action="{{ route('billing_address.store',Auth::id())}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" rows="10">{{ $user->address }}</textarea>
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
@push('script')
    <script>
            $('#description').summernote({
            height: 200  
        });
    </script>
@endpush
