@extends('admin.master')
@section('content')
<div class="students-List-section">
    <h1 class="students-list-hed">Dropdown Type</h1>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label class="tab-inner-label float-right"><strong>Dropdowns</strong></label>
            </div>
            <div class="form-group col-md-6">
                <select name="dropdowns_id" class="form-control show_dropdown_type">
                        <option selected disabled>Select Dropdown</option>
                    @foreach ($dropdowns as $dropdown)
                        <option value="{{ $dropdown->id }}">{{ $dropdown->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    <div class="row" style="position:realtive">
    <div class="col-md-2" style="position:absolute; right:0">
            <button class="btn edit_save" class="img-fluid edit-icon" data-bs-toggle="modal" data-bs-target="#AddDropdownType">Add New Dropdown Type</button>
    </div>
    </div>

    <div class="pt-5">

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
            <tbody id="tbody">
               <!-- body of table -->
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="dropdown_type_form" method="POST" action="">
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
                    <button type="button" class="btn edit_save" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn edit_save">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Update Permission Model -->
<!-- Add dropdown type Modal -->
<div class="modal fade" id="AddDropdownType" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Dropdown</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_dropdown_type" method="POST" action="{{ route('adddropdownType') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Dropdown</label>
                        <input type="text" disabled class="form-control" name="dropdown_name" id="dropdown_name" value="">
                        <input type="hidden" class="form-control" name="dropdowns_id" id="dropdown_id" value="">
                        <label class="form-label">Type Name</label>
                        <input type="text" class="form-control" name="name" value="">
                        @error('permission')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn edit_save" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn edit_save">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End dropdown type Model -->
@include('admin.modals.deleteModal')
@endsection
@section('scripts')
<script>
    $(document).on('click', '.update', function (e) {

        e.preventDefault();

        var update_url = $(this).attr('href');
        var name = $(this).data('id');
        
        $('#dropdown_type_form').attr('action', update_url);
        $('#update_name').val(name);
    });
</script>
<script>
    $(document).on('change',function(){
        var selected_dropdown=$('.show_dropdown_type').val();
        var dropdown_name=$('.show_dropdown_type option:selected').text();
        $('#dropdown_name').val(dropdown_name);
        $('#dropdown_id').val(selected_dropdown);

        $.ajax({
            url:"{{route('show.dropdowntype')}}",
            method:'GET',
            data:{dropdowns_id:selected_dropdown},
            success:function(res){
                console.log(res);
                $('#tbody').html(res);
            }
        });
    });
</script>
<!-- dataTable links -->
<script src="{{asset('admin/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/js/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/js/datatable/jquery-3.5.1.js')}}"></script>
@endsection
