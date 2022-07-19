@extends('admin.master')
@section('title', 'List Of Users')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <section class="students-List-section">
        <div class="d-flex justify-content-between flex-wrap">
            <h1 class="page-heading float-left"> User List <small> (Total Record : <span id="countTotal">0</span>)</small></h1>
            @can('add_user_role_permission')
            <div>
            <a href="{{ route('user.create') }}" class="btn edit_save"><i
                                    class="fas fa-fw fa-plus"></i>Add User</a>
            </div>
            @endcan
        </div>
        <div class="mm-stdlist-main">

            <table id="users" class="table table-bordered table-responsive">
                <thead class="s-list-thead">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>DOB</th>
                        <th class="no-sort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @include('admin.modals.deleteModal')
@endsection

@section('scripts')
   
    <script>
        var table;
        $(document).ready(function() {

            table = $('#users').DataTable({
                // responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('user.index') }}",
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'dob',
                        name: 'dob'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
                drawCallback: function(response) {

                    $('#countTotal').empty();
                    $('#countTotal').append(response['json'].recordsTotal);
                },
                
            });
        });

        function changeStatus(id, status) {
            var result =
                Swal.fire({
                    title: "Are you sure change this Status?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Change it!"
                }).then(result => {
                    if (result.value) {
                        $.ajax({
                            method: "POST",
                            url: "{{ route('user.status') }}",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                'id': id,
                                'status': status
                            },
                            success: function(response) {
                                if(response.status == 1)
                                    {
                                        Swal.fire("Activated!", response.message, "success");
                                        $('#users').DataTable().ajax.reload();
                                    }
                                else{
                                    Swal.fire("Suspended!", response.message, "success");
                                    $('#users').DataTable().ajax.reload();
                                }
                            }
                        });
                    }
                });
        };
    </script>
  
@endsection
