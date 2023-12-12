@include('backend.layout.alert')
<div class="card">
    <div class="card-body">
        <div class="col-12 mb-4">
            <div class="w-100 d-flex justify-content-center mb-3">
                <div class="profile border rounded-circle">
                <img src="{{ asset('images/assets/default-profile.png')}}" class="w-100" alt="">
                </div>
            </div>
            <h3 class="text-center">{{ Auth::user()->name }}</h3>
        </div>
        <a href="{{ route('home')}}" class="{{  Request::url() ===  $url . 'home' ? 'user-active' : '' }}">
            <div class="col-12 mb-2 d-flex justify-content-center">
                <div class="d-flex bg-smoke justify-content-between w-100 rounded-1 mb-2">
                    <div class="p-3 align-items-center d-flex justify-content-around">
                      <i class="far fa-user"></i>
                      <span class="ml">My Profile</span>
                    </div>
                    <div class="p-3">
                    <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </a>
        <div class="col-12 mb-2 d-flex justify-content-center">
            <div class="d-flex bg-smoke justify-content-between w-100 rounded-1 mb-2">
                <div class="p-3 d-flex align-items-center">
                <i class="fas fa-cart-plus"></i>
                <span class="ml">Orders</span>
                </div>
                <div class="p-3">
                <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
      
        <a href="{{ route('wishlist')}}" class="{{  Request::url() ===  $url . 'user/wishlists' ? 'user-active' : '' }}"> 
            <div class="col-12 mb-2 d-flex justify-content-center">
                <div class="d-flex bg-smoke justify-content-between w-100 rounded-1 mb-2">
                    <div class="p-3 d-flex align-items-center">
                        <i class="far fa-heart text-dark"></i>
                    <span class="ml">Wishlist</span>
                    </div>
                    <div class="p-3">
                    <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('billing_address')}}" class="{{  Request::url() ===  $url . 'user/billing_address' ? 'user-active' : '' }}">
            <div class="col-12 mb-2 d-flex justify-content-center">
                <div class="d-flex bg-smoke justify-content-between w-100 rounded-1 mb-2">
                    <div class="p-3 d-flex align-items-center">
                    <i class="fas fa-map-marker-alt"></i>
                <span class="ml">Billing Address</span>
                    </div>
                    <div class="p-3">
                    <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('change_password')}}" class="{{  Request::url() ===  $url . 'user/changepassword' ? 'user-active' : '' }}"> 
            <div class="col-12 mb-2 d-flex justify-content-center">
                <div class="d-flex bg-smoke justify-content-between w-100 rounded-1 mb-2">
                    <div class="p-3 d-flex align-items-center">
                    <i class="far fa-eye"></i>
                    <span class="ml">Change Password</span>
                    </div>
                    <div class="p-3">
                    <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>