@extends('backend.layout.app')
@section('title','A Mobile | Products List')
@push('style')
    <style>
        .product-image{
            width: 95px;
            height: 90px;
        }

        @media screen and (max-width: 485px) {
            .product-image{
               width: 45px;
               height: 40px;
            }

        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4">
                <!-- card start  -->
                <div class="card">
                    <div class="card-header">
                       <div class="d-flex justify-content-between">
                          <span>  <i class="nav-icon fas fa-chart-pie"></i> Product Lists</span>
                          <a href="{{ route('store_admin.product.create') }}" class="btn btn-sm btn-primary">Create Product</a>
                       </div>
                    </div>
                    <div class="card-body">
                        <table id="productsTrashTable" class="table table-borderless">
                            <thead>
                                <tr>
                                    <td>id</td>
                                    <td>Title</td>
                                    <!-- <td>Image</td> -->
                                    <td>Price</td>
                                    <td>Stock</td>
                                    <td>Count</td>
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
        
        $('#productsTrashTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              'url': "{{ route('store_admin.product.get_all_trashed_datatable') }}",
          },
          columns: [
              {data: 'id'},
              {data: 'title'},
  
              { data: 'price' },
              {
                data: 'stock',
                render: function(data, type) {
                    if(data == 1){
                      var stock = `<span class="badge badge-success">In Stock</span>`;
                    }else{
                        var stock = `<span class="badge badge-danger">Out Of Stock</span>`;
                    }
        
                    return  stock;
                }
            
               },
              {data: 'count'
               },
               {
                data: 'action',
                render: function(data, type) {
                    var edit = `<a href="{{ route('store_admin.product.restore',':id') }}" type="button" class="mr-3 btn btn-info btn-sm ">
                                <i class="fas fa-trash-restore"></i>
                               </a>`;
                    var del = ` <form action="{{ route('store_admin.product.force_delete',':id')}}" method="post" id="deleteForm">
                               @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-danger btn-sm" onclick="DeleteProduct(this)"><i class="fa fa-trash"></i></button>
                              </form>
                    `;
                  
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
              },
              {
                  'targets': [6],
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

          "order": [[ 6, "desc" ]],
      });

      function DeleteProduct(e) {
            $(function () {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger ml-2',
                        cancelButton: 'btn btn-info'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.parentNode.submit();
                    }
                })
            });
      };
    </script>
@endpush