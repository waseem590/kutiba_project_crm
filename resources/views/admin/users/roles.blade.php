@extends('admin.master')
@section('title', 'List Of Roles')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="students-List-section mmaduser">
        <div class="d-flex justify-content-between flex-wrap container-fluid">
            <h1 class="page-heading"> Roles List <small>  (Total Roles : <span id="countTotal">0</span>)</small></h1>
            <div>
            <button class="btn btn edit_save ml-2" data-bs-toggle="modal"
                                data-bs-target="#addRole"><i class="fas fa-fw fa-plus"></i>Add Role</button>
            </div>
        </div>
        <div class="container-fluid" >
            <div class="mm-stdlist-main table-responsive">
                <table id="Roles" class="table table-bordered">
                    <thead class="s-list-thead">
                        <tr>
                            <th>Sr.No</th>
                            <th>Role </th>
                            <th>Role</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.row -->
            <!-- Add Role Modal -->
            <div class="modal fade" id="addRole" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Role</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="role_form" action="{{ route('role.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3 error-placeholder">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Enter Role Name...">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  edit_save" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn  edit_save">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Role Model -->
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
        var table;
        $(document).ready(function() {
            table = $('#Roles').DataTable({
                // responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('role.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false,searchable: false},
                    {data: 'name',name: 'name'},
                    {data: 'permissions',name: 'permissions'},
                    {data: 'action',name: 'action',orderable: false,searchable: false},
                ],
                drawCallback: function(response) {

                    $('#countTotal').empty();
                    $('#countTotal').append(response['json'].recordsTotal);
                },
            //     responsive: {
            //     breakpoints: [
                  
            //         { name: 'phone',   width: 480 },
            //     ],
            //     details: {
			// 				display:
			// 					$.fn.dataTable.Responsive.display.childRowImmediate,
			// 				type: "none",
			// 				target: "",
			// 			},
            // }
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
@endsection
