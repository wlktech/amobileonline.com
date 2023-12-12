@extends('backend.layout.app')
@section('title','A Mobile | Products List')
@push('style')
<style>
    .image{
        width: 70px;
    }
    @media screen and (max-width: 972px) {
        .mobile{
            display: none;
        }
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
                       <div class="d-flex justify-content-between">
                          <span>News Lists</span>
                          <a href="{{ route('store_admin.post.create') }}" class="btn btn-sm btn-primary">Create NEWS</a>
                       </div>
                    </div>
                    <div class="card-body"> 
                     <table id="postsTable" class="table table-borderless">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Title</td>
                                    <td>Image</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                        </table>
                    </div> <!---- Card Body end --->
                  
                </div>
                <!-- card end  -->
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#postsTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              'url': "{{ route('store_admin.post.all.datatable') }}",
          },
          columns: [
              {data: 'id'},
              {data: 'title'},
              {
                data: 'image',
                render: function(data, type) {
                    var img =  `<img src="{{ asset(':img') }}" class="image rounded-2">`;
                    img=img.replace(':img', data);
                    return img;
                }
            
              },
              {
                data: 'action',
                render: function(data, type) {
                    var edit = `<a href="{{ route('store_admin.post.edit',':id') }}" type="button" class="mr-3 btn btn-info btn-sm ">
                                   <i class="fa fa-edit"></i>
                               </a>`;
                    var del = `<button type="button" onclick="Delete()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                <form action="{{ route('store_admin.post.delete',':id')}}" method="post" id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                </form> `;
                  
                    edit=edit.replace(':id', data);
                    del=del.replace(':id', data);
                    return  `
                       <div class="w-100 d-flex">
                       ${edit}  ${del}
                       </div>
                      `;
                }
              },
              {data: 'created_at'},
          ],

          responsive: true,
          lengthChange: true,
          autoWidth: false,
          paging: true,
          dom: 'Blfrtip',
          buttons: ["copy", "csv", "excel", "pdf", "print"],
          columnDefs: [
              { responsivePriority: 1, targets: 1 },
              { responsivePriority: 2, targets: 2 },
              { responsivePriority: 3, targets: 3},
              { responsivePriority: 4, targets: 4},
          
              {
                  'targets': [4],
                  'orderable': false,
                   'visible': false,
                   'searchable': false,  
              },
            
          ],
          language: {
              "search" : '<i class="fas fa-search"></i>',
              "searchPlaceholder": 'Search',
              paginate: {
                  next: '<i class="fa fa-angle-right"></i>', // or '→'
                  previous: '<i class="fa fa-angle-left"></i>' // or '←'
              }
          },

          "order": [[ 4, "desc" ]],
        });

         
    </script>
@endpush