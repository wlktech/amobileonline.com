@extends('backend.layout.app')
@section('title','A Mobile | Users List')
@push('style')
 <style>
    form i {
        position: absolute;
        bottom :11.5px;
        right: 10px;
        cursor: pointer;
    }
 </style>
    
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 mt-4">
                <!-- card start  -->
                <div class="card">
                    <div class="card-header">
                       <div class="d-flex justify-content-between w-100">
                          <div class="card-title"><i class="fas fa-users mr-1"></i> Admin Create</div>
                          <div class=""><a href="{{ route('store_admin.users.list')}}"><i class="fas fa-list"></i></a></div>
                       </div>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('store_admin.role.create')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control @error('name')
                                    is-invalid
                                @enderror">
                                @error('name')
                                    <span class="font-weight-bolder text-danger">{{ $message}}</span>
                                @enderror
                              
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control @error('email')
                                    is-invalid
                                @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('email')
                                    <span class="font-weight-bolder text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Role</label>
                                <select class="form-control @error('role')
                                    is-invalid
                                @enderror" name="role" id="exampleFormControlSelect1">
                                    <option value="2">Admin</option>
                                    <option value="1">Staff</option>
                                </select>
                                @error('role')
                                    <span class="font-weight-bolder text-danger">{{ $message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="position-relative">
                                    <input type="password" name="password" class="form-control" id="password">
                                    <i class="fas fa-eye-slash " id="togglePassword" onclick="toggleEye(this)"></i>
                                </div>
                                @error('password')
                                    <span class="font-weight-bolder text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="position-relative">
                                  <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                                   <i class="fas fa-eye-slash " id="togglePassword" onclick="confirmToggleEye(this)"></i>
                                </div>
                                @error('password_confirmation')
                                    <span class="font-weight-bolder text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                           
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div> <!---- Card Body end --->
                </div>
                <!-- card end  -->
            </div>
        </div>
    </div>
@endsection
@push('script')
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
        var x = document.getElementById("password_confirmation");
        if (x.type === "password") {
            x.type = "text";
            } else {
                x.type = "password";
            }
            $(e).toggleClass('fas fa-eye-slash fas fa-eye');
    }
    </script>
@endpush