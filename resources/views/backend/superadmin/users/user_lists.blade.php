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
                          <span> <i class="fas fa-users mr-1"></i> User Lists</span>
                          <!-- <a href="{{ route('store_admin.user.create') }}" class="btn btn-sm btn-primary">Create User</a> -->
                       </div>
                    </div>
                    <div class="card-body">
                        <table id="userListTable" class="table table-borderless">
                            <thead>
                                <tr>
                                    <td>id</td>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Role</td>
                                    <td>Address</td>
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
        $('#userListTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              'url': "{{ route('store_admin.get_user_list.datatable') }}",
          },
          columns: [
              {data: 'id'},
              {data: 'name'},
              {data: 'email'},
              {
                data: 'role',
                render: function(data, type, row) {
                    console.log(row)
                    if(row.ban == null){
                        var role = `<span class="badge badge-info">USER</span>`;
                    }else{
                        var role = `<span class="badge badge-danger">banned</span>`;
                    }
                    return  role;
                }
              },
              {data: 'address'},
              {
                data: 'action',
                render: function(data, type,row) {

                    if(row.ban == null){
                        var ban = `
                            <form action="{{ route('user.ban',':id')}}" method="post">
                            @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Ban
                                </button>
                            </form>`;
                  
                            ban=ban.replace(':id', data);
                            return  ban;
                    }else{
                        var ban = `
                            <form action="{{ route('user.ban.restore')}}" method="post">
                            @csrf
                             <input type="hidden" name="id" value="${data}">
                                <button type="submit" class="btn btn-info btn-sm ">
                                    unban
                                
                                </button>
                            </form>`;
                  
                            ban=ban.replace(':id', data);
                            return  ban;
                    }
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
    </script>
@endpush