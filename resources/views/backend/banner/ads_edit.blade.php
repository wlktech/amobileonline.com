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
                          <div class="card-title">Edit Ads</div>
                          <div class=""><a href="{{ route('store_admin.ads.all')}}"><i class="fas fa-list"></i></a></div>
                       </div>
                    </div>
                    <div class="card-body">
                        <div class=" mb-2">
                           <img src="{{ asset($ads->image)}}" alt="" class="w-100">
                        </div>
                    <form action="{{ route('store_admin.ads.update',$ads->id ) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Photo</label>
                            <div class="font-weight-bolder text-danger mb-1">
                                <span>Photo size must be width=1810px/height=184 px</span>
                            </div>
                            <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                            @error('file')
                                <span class="text-danger font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="select">Select Page ({{ $ads->page }})</label>
                            <select class="form-select form-select mb-3" name="page" id="select">
                                <option value="home">Home Page</option>
                                <option value="product">Product Page</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit"  class="btn btn-primary">Update</button>
                            <a href="{{ route('store_admin.ads.all')}}" class="btn btn-outline-dark">Cancel</a>
                        </div>
                    </form>
                    </div> <!---- Card Body end --->
                </div>
                <!-- card end  -->
            </div>
        </div>
    </div>
@endsection