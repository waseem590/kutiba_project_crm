@extends('admin.master')
@section('content')
<div class="students-List-section">
    <h1 class="students-list-hed">Dropdown List</h1>
    <form action="{{ route('dropdown.store') }}" method="POST" id="dropdown">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-2">
                <label class="tab-inner-label float-right"><strong>Dropdown</strong></label>
            </div>
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="name"><br>
                @error('name')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <button class="btn edit_save" type="submit">Save</button>
            </div>
        </div>
    </form>
    <div class="">
        <table id="example" class="table table-bordered">
            <thead class="s-list-thead">
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col" class="custem-text-center">Action</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                @foreach($dropdowns as $dropdown)
                <tr>
                    <td>{{$dropdown->id}}</td>
                    <td>{{$dropdown->name}}</td>
                    <td>
                        <a href="{{route('updateDropdown',$dropdown->id)}}"  data-id="{{$dropdown->name}}" class="edit-list-icons update" ><img src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std" class="img-fluid edit-icon"
                                data-bs-toggle="modal" data-bs-target="#updateDropdown"></a>
                        <!-- <a href="javascript:void(0)" class="edit-list-icons" onclick="deleteRecord({{$dropdown->id}},'/dropdown/')"><img
                                src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std"
                                class="img-fluid" data-bs-toggle="modal"
                                data-bs-target="#alert_modal"></a> -->
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<!-- Update dropdown Modal -->
<div class="modal fade" id="updateDropdown" data-bs-backdrop="static" data-bs-keyboard="false"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Update Dropdown</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close">button>
        </div>
        <form id="updatedropdown" method="POST" action="">
            @csrf
            <div class="modal-body">
                <div class="mb-3 error-placeholder">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" id="update_name" name="name" value="">
                    @error('permission')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success update-btn">Update</button>
            </div>
        </form>
    </div>
</div>
</div>
<!-- End Update Permission Model -->
@include('admin.modals.deleteModal')
@endsection
@section('scripts')
<script>
    $(document).on('click','.update',function(e){
        
        e.preventDefault();
        
        var update_url = $(this).attr('href');
        var name = $(this).data('id');
        
        $('#updatedropdown').attr('action',update_url);
        $('#update_name').val(name);
    });

</script>
<!-- dataTable links -->
<script src="{{asset('admin/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/js/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/js/datatable/jquery-3.5.1.js')}}"></script>
@endsection
