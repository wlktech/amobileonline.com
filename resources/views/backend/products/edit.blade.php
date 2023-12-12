@extends('backend.layout.app')
@section('title','A Mobile | Product Create')
@push('style')
    <style>
        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed rgb(0, 135, 247);
            border-image: none;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .dz-message{
            /* height: 100px; */
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-12  mt-2">
                   <!-- card start  -->
                   <div class="card w-100 border-0 shadow-none">
                    <div class="card-header">
                       <div class="d-flex justify-content-between w-100">
                          <div class="card-title">Edit Product</div>
                          <div class=""><a href="{{ route('store_admin.product.list')}}"><i class="fas fa-list"></i></a></div>
                       </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                            <label for="productTitle">Title</label>
                            <input type="text" value="{{ old('title',$product->title )}}" name="title" class="form-control @error('title')
                                is-invalid
                            @enderror" id="productTitle">
                            @error('title')
                                <span class="font-weight-bolder text-danger">{{ $message}}</span>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control @error('price')
                                is-invalid
                            @enderror" id="price" value="{{ old('price',$product->price )}}">
                            @error('price')
                                <span class="font-weight-bolder text-danger">{{ $message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <select class="form-control @error('stock')
                                is-invalid
                            @enderror" name="stock" id="stock">
                                @if ($product->stock == "1")
                                <option value="1" selected >In Stock</option>
                                <option value="0">Out Of Stock</option>
                                @else
                                <option value="1" >In Stock</option>
                                <option value="0" selected>Out Of Stock</option>
                                @endif
                            </select>
                            @error('stock')
                                <span class="font-weight-bolder text-danger">{{ $message}}</span>
                            @enderror
                        </div>
                        <div class="form-group showCount">
                            <label for="stockCount">Count</label>
                            <input type="text" name="counts" class="form-control @error('count')
                                is-invalid
                            @enderror" id="stockCount"  value="{{ old('counts',$product->counts )}}">
                            @error('count')
                                <span class="font-weight-bolder text-danger">{{ $message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control @error('cat_id')
                                is-invalid
                            @enderror" name="cat_id" id="category">
                               @if ($product->cat_id == '1')
                                <option value="1" selected>Phone</option>
                                <option value="0">laptop</option>
                               @else
                               <option value="1" >Phone</option>
                                <option value="0" selected>laptop</option>
                               @endif
                            </select>
                            @error('cat_id')
                                <span class="font-weight-bolder text-danger">{{ $message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="10">{!! old('description',$product->description) !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="specification">Specification</label>
                            <textarea class="form-control" name="specification" id="specification" rows="10">{!! old('specification',$product->specification) !!}</textarea>
                        </div>

                            </div> <!-- col-end -->
                        <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <div class="edit-view-photo p-3 border">
                                @foreach ($product->getProductPhotos as $foto)
                                    <img src="{{asset($foto->image)}}" alt="product photo" class="w-25">
                                @endforeach
                            </div>
                        </div>
                        <!-- drop Zone Section  -->
                        <div class="form-group">
                            <h6 class="text-center font-weight-bolder">Product Photo Upload</h6>
                            <section>
                                <div id="dropzone">
                                <form class="dropzone needsclick" id="demo-upload" action="/upload">
                                <div class="dz-message needsclick">    
                                <i class="fas fa-upload"></i>
                                 
                                </div>
                                </form>
                                </div>
                            </section>
                            <br/>
                                    <div id="preview-template" style="display: none;">
                                    <div class="dz-preview dz-file-preview">
                                    <div class="dz-image">
                                           <img data-dz-thumbnail="" class="w-100">
                                        </div>
                                    <div class="dz-details">
                                    <div class="dz-size"><SPAN data-dz-size=""></SPAN></div>
                                    <div class="dz-filename"><SPAN data-dz-name=""></SPAN></div></div>
                                    <div class="dz-progress"><SPAN class="dz-upload" 
                                    data-dz-uploadprogress=""></SPAN></div>
                                    <div class="dz-error-message"><SPAN data-dz-errormessage=""></SPAN></div>
                                    <div class="dz-success-mark">
                                    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                        <title>Check</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                            <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                                        </g>
                                    </svg>
                                    </div>
                                    <div class="dz-error-mark">
                                    <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                        <title>error</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                            <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                                <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                                            </g>
                                        </g>
                                    </svg>
                                    </div>
                            </div>
                        </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" id="updateProduct">Update</button>
                            <a href="{{ route('store_admin.product.list')}}" class="btn btn-outline-dark ">Back</a>
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
        let base64data = [];
        let stockName = $('#stock').val();
        $('#description').summernote({
            height: 200  
        });
        $('#specification').summernote({
            height: 200  
        });

        if(stockName == 0){
            $(".showCount").hide();
        }else{
            $(".showCount").fadeIn();
        }
        // $(".showCount").hide();
        $("#stock").on('change',function(){
            let stockNameVal = $(this).val();
            if(stockNameVal == 0){
                $(".showCount").fadeOut();
            }else{
                $(".showCount").fadeIn();
            }
        })
        var dropzone = new Dropzone('#demo-upload', {
                    previewTemplate: document.querySelector('#preview-template').innerHTML,
                    parallelUploads: 2,
                    thumbnailHeight: 1000,
                    thumbnailWidth: 2500,
                    maxFilesize: 3,
                    filesizeBase: 1000,
                    createImageThumbnails: true,
                    maxThumbnailFilesize: 50,
                    acceptedFiles: ".jpeg,.jpg,.png,",
                    thumbnail: function(file, dataUrl) {
                        if (file.previewElement) {
                            file.previewElement.classList.remove("dz-file-preview");
                            var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
                            base64data.push(dataUrl)
                            for (var i = 0; i < images.length; i++) {
                                var thumbnailElement = images[i];
                                thumbnailElement.alt = file.name;
                                thumbnailElement.src = dataUrl;
                            }
                        setTimeout(function() { 
                            file.previewElement.classList.add("dz-image-preview");
                        }, 1);
                        }
                    }

        });

        // Now fake the file upload, since GitHub does not handle file uploads
        // and returns a 404

        var minSteps = 6,
            maxSteps = 60,
            timeBetweenSteps = 100,
            bytesPerStep = 100000;

        dropzone.uploadFiles = function(files) {
            var self = this;

            for (var i = 0; i < files.length; i++) {

                var file = files[i];
                totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

                for (var step = 0; step < totalSteps; step++) {
                var duration = timeBetweenSteps * (step + 1);
                setTimeout(function(file, totalSteps, step) {
                    return function() {
                    file.upload = {
                        progress: 100 * (step + 1) / totalSteps,
                        total: file.size,
                        bytesSent: (step + 1) * file.size / totalSteps
                    };

                    self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
                    if (file.upload.progress == 100) {
                        file.status = Dropzone.SUCCESS;
                        self.emit("success", file, 'success', null);
                        self.emit("complete", file);
                        self.processQueue();
                        //document.getElementsByClassName("dz-success-mark").style.opacity = "1";
                    }
                    };
                }(file, totalSteps, step), duration);
                }
            }
        }

        $("#updateProduct").click(function(e){
        //   $(".create").attr('disabled',true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            e.preventDefault();
            var formData = {
                cat_id : jQuery("select[name=cat_id]").val(),
                title: jQuery("input[name=title]").val(),
                price : jQuery("input[name=price]").val(),
                stock : jQuery("select[name=stock]").val(),
                counts : jQuery("input[name=counts]").val(),
                description : jQuery("textarea[name=description]").val(),
                specification : jQuery("textarea[name=specification]").val(),
                image : base64data
            }
            $.ajax({
                url: "{{ route('store_admin.product.update',$product->id)}}",
                method: "PUT",
                data: formData,
                // beforeSend: function() {
                //     $("#loader").show();
                // },
                error:function(err){
                // $("#loader").hide();
                    console.warn(err.responseJSON.errors);
                    $('.mydivclass').remove();
                    $.each(err.responseJSON.errors, function (i, error) {
                        var al = $(document).find('[name="'+i+'"]');
                        var el = al.parent();
                        // var pl = al.parents('div.image_area');
                        // pl.addClass('photo-invalid');
                        el.after($('<small class="text-danger font-weight-bolder mydivclass"> <i class="fas fa-exclamation-circle"></i> '+error[0]+'</small>'));
                        al.addClass('is-invalid');
                    });
                // $(".create").attr('disabled',false);


                },
                success:function(response){
                    window.location.href = "{{ route('store_admin.product.list')}}";
                },

            });
       });
    </script>
@endpush