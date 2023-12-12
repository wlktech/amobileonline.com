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
            <div class="col-12  mt-4">
                <!-- card start  -->
                <div class="card">
                    <div class="card-header">
                       <div class="d-flex justify-content-between w-100">
                          <div class="card-title"><i class="fas fa-users mr-1"></i> User Edit</div>
                          <div class=""><a href="{{ route('store_admin.admin.list')}}"><i class="fas fa-list"></i></a></div>
                       </div>
                    </div>
                    <div class="card-body">
                   
                            <div class="form-row">
                                <div class="col-12 col-md-6 p-3">
                                  <h4 class="font-weight-bolder mb-4">Infomation</h4>
                                    <form action="{{ route('admin.update', $user->id )}}" method="post">
                                     @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name="name" class="form-control @error('name')
                                                is-invalid
                                            @enderror" value="{{old('name',$user->name)}}">
                                            @error('name')
                                                <span class="font-weight-bolder text-danger">{{ $message }}</span>
                                            @enderror
                                    
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" name="email" class="form-control @error('email')
                                                is-invalid
                                            @enderror"  value="{{ old('email',$user->email)}}">
                                            @error('email')
                                                <span class="font-weight-bolder text-danger">{{ $message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Role</label>
                                            <select class="form-control @error('role')
                                                is-invalid
                                            @enderror" name="role" id="exampleFormControlSelect1">

                                                <option value="{{ $user->role }}">{{ $user->role == 2 ? 'Admin' : 'Staff'}}</option>
                                                
                                            </select>
                                            @error('role')
                                                <span class="font-weight-bolder text-danger">{{ $message}}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                                <div class="col-12 col-md-6 p-3">
                                  <h4 class="font-weight-bolder mb-4">Change Password</h4>
                                    <form action="{{ route('admin_change_password.store')}}" method="post">
                                        @csrf
                                        <div class="form-group">
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
                                        <div class="form-group">
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
                                        <div class="form-group">
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
                                        <button type="submit" class="btn btn-primary">Save Change</button>
                                   </form>
                                </div>
                            </div>
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