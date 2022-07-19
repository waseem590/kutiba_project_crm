@extends('admin.master')
@section('title', 'List Of Permission')
@section('styles')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
<section class="students-List-section mmaduser">
    <div class="d-flex justify-content-between flex-wrap container-fluid">
        <h1 class="page-heading"> Permission's</h1>
        <div>
            <button class="btn  edit_save" data-bs-toggle="modal" data-bs-target="#addPermission"><i
                    class="fas fa-fw fa-plus"></i>Add Permission</button>
        </div>
    </div>
    <div class="container-fluid">
        <div class="mm-stdlist-main table-responsive">
            <table id="Permission" class="table table-bordered">
                <thead class="s-list-thead">
                    <tr>
                        <th>Sr.No</th>
                        <th>Permission Name</th>
                        <th class="no-sort" style="width: 200px">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- Add Permission Modal -->
        <div class="modal fade" id="addPermission" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Enter Permission Name...">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class=" btn  permi-close-model edit_save"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn edit_save">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Permission Model -->
        <!-- Update Permission Modal -->
        <div class="modal fade" id="updatePermission" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formID" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3 error-placeholder">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control permission" name="permission"
                                    placeholder="Enter Permission Name...">
                                @error('permission')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="permi-close-model edit_save"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn edit_save">Update</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Update Permission Model -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('scripts')
<script>
    // Edit Premission's

    var table;
    $(document).ready(function () {
        $("body").on("click", ".editPermission", function () {
            let id = $(this).attr("data-id");
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                type: "get",
                url: "permissions/edit/" + id,
                dataType: "json",
                beforeSend: function () {
                    $(".loader-wrapper").fadeIn("slow");
                },
                success: function (response) {
                    console.log(response);
                    $("#updatePermission .permission").val(response.permission);
                    $("#formID").attr("action", "permissions/update/" + id);
                    $("#updatePermission").modal("show");
                },
                error: function (response) {},
                complete: function () {
                    $(".loader-wrapper").fadeOut("slow");
                },
            });
        });
        // Delete records
        $("body").on("click", ".del_btn", function () {
            let id = $(this).attr("data-id");
            let url = $(this).attr("data-url");
            let tableName = $(this).attr("data-tab");
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                method: "delete",
                url: deleteRecord(id,'/'+url+'/'),
                success: function (response) {
                    console.log(url);
                },
            });
            // console.log(url);
            // Swal.fire({
            //     title: "Are you sure?",
            //     text: "You won't be able to revert this!",
            //     icon: "warning",
            //     showCancelButton: true,
            //     confirmButtonColor: "#3085d6",
            //     cancelButtonColor: "#d33",
            //     confirmButtonText: "Yes, delete it!",
            // }).then((result) => {
            //     if (result.value) {
            //         $.ajaxSetup({
            //             headers: {
            //                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
            //                     "content"
            //                 ),
            //             },
            //         });
            //         $.ajax({
            //             type: "DELETE",
            //             url: url + "/" + id,
            //             dataType: "json",
            //             success: function (response) {
            //                 Swal.fire("Deleted!", response.message, "success");
            //             },
            //             complete: function () {
            //                 swal.hideLoading();
            //                 $("#" + tableName)
            //                     .DataTable()
            //                     .ajax.reload();
            //             },
            //             error: function () {
            //                 swal.hideLoading();
            //                 swal.fire(
            //                     "!Opps ",
            //                     "Something went wrong, try again later",
            //                     "error"
            //                 );
            //             },
            //         });
            //     }
            // });
        });

        table = $('#Permission').DataTable({
            // responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('permission.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            drawCallback: function (response) {
                $('#countTotal').empty();
                $('#countTotal').append(response['json'].recordsTotal);
            },
            // responsive: {
            // 		details: {
            // 			display:
            // 				$.fn.dataTable.Responsive.display.childRowImmediate,
            // 			type: "none",
            // 			target: "",
            // 		},
            // 	},
        });
    });

</script>

@include('admin.modals.deleteModal')
@endsection
