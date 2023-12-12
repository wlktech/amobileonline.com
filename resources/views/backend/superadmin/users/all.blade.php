@extends('backend.layout.app')
@section('title','A Mobile | Users List')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4">
                <!-- card start  -->
                <div class="card">
                    <div class="card-header">
                       <div class="d-flex justify-content-between">
                          <span> <i class="fas fa-users mr-1"></i> Admin Lists</span>
                          <a href="{{ route('store_admin.user.create') }}" class="btn btn-sm btn-primary">Create Admin</a>
                       </div>
                    </div>
                    <div class="card-body">
                        <table id="adminListTable" class="table table-borderless">
                            <thead>
                                <tr>
                                    <td>id</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Role</td>
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
        $('#adminListTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              'url': "{{ route('store_admin.get_admin_list.datatable') }}",
          },
          columns: [
              {data: 'id'},
              {data: 'name'},
              {data: 'email'},
              {
                data: 'role',
                render: function(data, type) {
                    if(data == 2){
                        var role = `<span class="badge badge-danger">ADMIN</span>`;
                      
                    }else if(data == 1){
                        var role = `<span class="badge badge-primary">STAFF</span>`;
                    }else{
                        var role = `<span class="badge badge-info">USER</span>`;
                    }
                    return  role;
                }
              },
              {
                data: 'action',
                render: function(data, type) {
                    console.log(data)
                    if(`{{Auth::user()->id}}` == data ){
                        var edit = `<a href="{{route('store_admin.admin.edit',':id')}}" type="button" class="btn btn-info btn-sm ">
                                     <i class="fa fa-edit"></i>
                                    </a>`;
                    }else{
                        var edit = `-`;
                    }
                    
                    edit=edit.replace(':id', data);
                    return  edit;
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
                  'targets': [5],
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

          "order": [[ 5, "desc" ]],
      });
    </script>
@endpush