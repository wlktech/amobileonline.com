@extends('backend.layout.app')
@section('title','A Mobile | Product Create')
@push('style')
    <style>
        .banner{
            width: 200px;
            height: 100px;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6 mt-5">
                   <!-- card start  -->
                   <div class="card">
                    <div class="card-header">
                       <div class="d-flex justify-content-between w-100">
                          <div class="card-title">Edit Banner</div>
                          <div class=""><a href="{{ route('store_admin.banner.all')}}"><i class="fas fa-list"></i></a></div>
                       </div>
                    </div>
                    <div class="card-body">
                        <div class="banner mb-5">
                           <img src="{{ asset($banner->image)}}" alt="" class="w-100">
                        </div>
                    <form action="{{ route('store_admin.banner.update',$banner->id ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Photo</label>
                            <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                            @error('file')
                                <span class="text-danger font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit"  class="btn btn-primary">Update</button>
                            <a href="{{ route('store_admin.banner.all')}}" class="btn btn-outline-dark">Cancel</a>
                        </div>
                    </form>
                    </div> <!---- Card Body end --->
                </div>
                <!-- card end  -->
            </div>
        </div>
    </div>
@endsection