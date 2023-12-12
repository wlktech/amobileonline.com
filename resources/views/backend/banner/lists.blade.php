@extends('backend.layout.app')
@section('title','A Mobile | Banner List')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 mt-4">
                <!-- card start  -->
                <div class="card">
                    <div class="card-header">
                       <div class="d-flex justify-content-between">
                          <span>  Banner Lists</span>
                          <a href="{{ route('store_admin.banner.create') }}" class="btn btn-sm btn-primary">Create Banner</a>
                       </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Photo</th>
                             
                                <th scope="col">
                                   action
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $id = 1;
                                @endphp
                                @forelse ($banner as $b)
                                <tr>
                                  <td scope="row">{{ $id++ }}</td>
                                   <td class="w-lg-75 w-50">
                                     <div>
                                       <img src="{{ asset($b->image)}}" alt="" class="w-25">
                                     </div>
                                   </td>
                                   <td class="d-flex">
                                       <a href="{{ route('store_admin.banner.edit',$b->id )}}" class="btn btn-info btn-sm mr-2">
                                        <i class="fas fa-edit"></i>
                                       </a>

                                       <button type="button" onclick="Delete()" class="btn btn-danger btn-sm">
                                       <i class="fas fa-trash"></i>
                                       </button>
                                       <form action="{{ route('store_admin.banner.delete',$b->id )}}" id="deleteForm" method="POST">
                                        @csrf
                                       </form>
                                   </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <span>There is no banner</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
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
      
    </script>
@endpush