 @php
  use App\Models\User;
    function isSuperAdmin()
    {
      if(Auth::user()->role == 2){
        return true;
      }
    }
  @endphp
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary sidebar-bg elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('images/logos/logo.png')}}" alt="A Mobile Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      @if (isSuperAdmin())
        <span class="brand-text font-weight-light">{{ Auth::user()->name}}(Admin)</span>
      @else
        <span class="brand-text font-weight-light">{{ Auth::user()->name}}(Staff)</span>
      @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if (isSuperAdmin())
            <li class="nav-item">
              <a href="{{ route('store_admin.dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('store_admin.users.list')}}" class="nav-link">
         
              <i class="nav-icon fas fa-users"></i>
                <p>
                  Users
                  <span class="badge badge-info right">{{ count(User::where('role',0)->get())}}</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Admins
                  <i class="fas fa-angle-left right"></i>
                  <span class="badge badge-info right">{{ count(User::whereBetween('role', [1, 2])->get())}}</span>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="{{ route('store_admin.user.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add User</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('store_admin.admin.list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Admin List</p>
                  </a>
                </li>
               
              </ul>
            </li>
            
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                  Banner
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('store_admin.banner.all')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lists</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('store_admin.banner.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('store_admin.ads.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Ads</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('store_admin.ads.all')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ads Lists</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-pen-alt"></i>
                <p>
                  News
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('store_admin.post.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create News</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('store_admin.post.all')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All News</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Products
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('store_admin.product.list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All Products</p>
                  </a>
                </li>
             {{--   <li class="nav-item">
                  <a href="{{ route('store_admin.color.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Color</p>
                  </a>
                </li> --}}
                <li class="nav-item">
                  <a href="{{ route('store_admin.product.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Products</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('store_admin.product.trash')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Trash</p>
                  </a>
                </li>
              </ul>
            </li>
  
            <li href="#" class="nav-link text-center">
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

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>