@extends('backend.layout.app')
@section('title','A Mobile | Product Create')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6 mt-5">
                   <!-- card start  -->
                   <div class="card">
                    <div class="card-header">
                       <div class="d-flex justify-content-between w-100">
                          <div class="card-title">Create Post</div>
                          <div class=""><a href="{{ route('store_admin.post.all')}}"><i class="fas fa-list"></i></a></div>
                       </div>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('store_admin.post.update',$post->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control @error('title')
                                is-invalid
                            @enderror" id="title" value="{{ $post->title }}">
                            @error('title')
                                <span class="font-weight-bolder text-danger">{{ $message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="10">{{ $post->description }}</textarea>
                        </div>
                 
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Photo</label>
                            <div class="image w-50 mb-4">
                                <img src="{{ asset($post->img) }}" alt="" class="w-100">
                            </div>
                            <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                            @error('file')
                                <span class="text-danger font-weight-bolder">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit"  class="btn btn-primary">Update</button>
                        </div>
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
            $('#description').summernote({
            height: 200  
        });
    </script>
@endpush