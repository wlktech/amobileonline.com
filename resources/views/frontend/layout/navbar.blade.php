<div class="w-100 bg-blue search">
  <div class="row justify-content-center align-items-center  search-bar-row p-3">
      <div class="col-12 col-lg-9 d-flex justify-content-between align-items-center">
        <div class="w-100">
          <form class="form-inline" action="{{ route('products_search')}}" method="Get">
            <div class="input-group input-group-sm">
              <label for="search" class="text-light font-weight-bolder search-title">Search</label>
              <input name="search" id="search" value="{{ old('search')}}" class="form-control form-control-navbar border-0 shadow-0 rounded-0" type="text" placeholder="" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <span class="fas fa-search"></span>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <span class="fas fa-times"></span>
                </button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-gray fixed-top">
  <div class="nav-row container-fluid">
    <div class="d-flex align-items-center">
      <button class="navbar-toggler  collapsed d-flex d-lg-none flex-column justify-content-around" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="toggler-icon top-bar"></span>
            <span class="toggler-icon middle-bar"></span>
            <span class="toggler-icon bottom-bar"></span>
      </button>
      <div class="navbar-brand p-0">
          <a href="/" class="nav-logo">
            <img src="{{ asset('images/logos/logo.png')}}" alt="" class="w-100 h-100">
          </a>
          <a href="/" class="nav-title">A-Mobile</a>
      </div>
    </div>
    <div class="nav-right-mobile">
        <a class="nav-item d-flex align-items-center search-box" ><i class="fas fa-search"></i></a>
        <a class="nav-item d-flex align-items-center position-relative" href="{{ route('cart')}}">
             <i class="fas fa-shopping-cart"></i>
             @if (count((array) session('cart')) > 0)
               <span class="badge badge-top bg-info addCartSession">{{ count((array) session('cart')) }}</span>
               @else
               <span class="badge badge-top bg-info addCart"></span>
             @endif
           </a>
        <div class="nav-item dropdown d-flex justify-content-end">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <i class="fas fa-user"></i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @if (Auth::check())
              <li><a class="dropdown-item" href="/home">My Account</a></li>
              <div>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
            @else
              <li><a class="dropdown-item" href="{{ route('register')}}">Register</a></li>
              <li><a class="dropdown-item" href="{{ route('login')}}">Login</a></li>
            @endif
          </ul>
        </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item px-5">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item px-5">
            <a class="nav-link" href="{{ route('products')}}">Product</a>
          </li>
          <li class="nav-item px-5">
            <a class="nav-link" href="{{ url('/news')}}">News</a>
          </li>
          <li class="nav-item px-5">
            <a class="nav-link" href="{{ url('/contact')}}">Contact</a>
          </li>
          
        </ul>
        <div class="nav-right">
          <a class="nav-item search-box" ><i class="fas fa-search"></i></a>
          <a class="nav-item position-relative" href="{{ route('cart')}}">
             <i class="fas fa-shopping-cart"></i>
             @if (count((array) session('cart')) > 0)
               <span class="badge badge-top bg-info addCartSessionDesktop">{{ count((array) session('cart')) }}</span>
               @else
               <span class="badge badge-top bg-info addCart"></span>
             @endif
             
           </a>
          <div class="nav-item dropdown d-flex justify-content-end">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @if (Auth::check())
              <li><a class="dropdown-item" href="/home">My Account</a></li>
              <li>
              <div>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
              </li>
              @else
              <li><a class="dropdown-item" href="{{ route('register')}}">Register</a></li>
              <li><a class="dropdown-item" href="{{ route('login')}}">Login</a></li>
              @endif
            </ul>
          </div>
        </div>
    </div>
  </div>
</nav>


 