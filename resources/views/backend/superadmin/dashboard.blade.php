@extends('backend.layout.app')
@section('title','Amobile | Dashboard')
@push('style')
    <style>
        .count-card{
            height: auto;
            background-color: #ffffff;
        }
        .counter{
            font-size: 30px;
            font-weight: 900;
        }

        .count-card-body{
            height: 150px;
        }

        .bg-parpel{
            background-color: #f4f7fe;
        }

        .count-card:hover{
            box-shadow: 7px 9px 15px -3px rgba(0,0,0,0.1);
        }
    </style>
@endpush
@section('content')
  <div class="container-fluid bg-parpel vh-100 p-5">
    <div class="row">
        <a href="{{ route('store_admin.users.list')}}" class="col-12 count-column col-md-3 mb-2">
            <div class="count-card rounded-3">
                  <div class="d-flex w-100 py-3 justify-content-center align-items-center">
                    <i class="fas fa-users mr-2"></i>
                    User Counts
                  </div>
               <div class="d-flex count-card-body w-100 justify-content-center align-items-center">
                  <span class="counter">{{ count($users_count) }}</span>
               </div>
            </div>
        </a>
        <a href="{{ route('store_admin.admin.list')}}" class="col-12 count-column col-md-3 mb-2">
            <div class="count-card rounded-3">
                  <div class="d-flex w-100 py-3 justify-content-center align-items-center">
                    <i class="fas fa-user-tie mr-2"></i>
                   
                    Admin Counts
                  </div>
               <div class="d-flex count-card-body w-100 justify-content-center align-items-center">
                  <span class="counter">{{ count($admins_count)}}</span>
               </div>
            </div>
        </a>
        <a href="{{ route('store_admin.product.list')}}" class="col-12 count-column col-md-3 mb-2">
            <div class="count-card rounded-3">
                  <div class="d-flex w-100 py-3 justify-content-center align-items-center">
                    <i class="fas fa-chart-pie mr-2"></i>
                    Product Counts
                  </div>
               <div class="d-flex count-card-body w-100 justify-content-center align-items-center">
                  <span class="counter">{{ count($products_count) }}</span>
               </div>
            </div>
        </a>
        <a href="{{ route('store_admin.post.all')}}" class="col-12 count-column col-md-3 mb-2">
            <div class="count-card rounded-3">
                  <div class="d-flex w-100 py-3 justify-content-center align-items-center">
                  <i class="fas fa-newspaper mr-2"></i>
                    NEWS Counts
                  </div>
               <div class="d-flex count-card-body w-100 justify-content-center align-items-center">
                  <span class="counter">{{ count($news_count)}}</span>
               </div>
            </div>
        </a>
    </div>
  </div>
    
@endsection
@push('script')
    <script>
        jQuery(document).ready(function($) {
            $('.counter').counterUp({
                delay: 100,
                time: 1000
            });
        });
    </script>
@endpush




