@extends('admin.master')
@section('title', 'List Of Users')
@section('styles')
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection
@section('content')

<section class="students-List-section">
    <div class="d-flex justify-content-between">
        <h1 class="page-heading float-left"> User Clock List</h1>
        <div>
            <a href="{{$user_id}}" data-bs-toggle="modal"
                data-bs-target="#clock_modal" class="btn edit_save" id="add_clock"><i class="fas fa-fw fa-plus"></i>Add Clocks</a>
                <a href="{{ url()->previous() }}" class="btn edit_save"><i class="fas fa-step-backward"></i> &nbsp; Back</a>
        </div>
    </div>
    <div class="mm-stdlist-main">
        <table id="user_clocks" class="table table-bordered">
            <thead class="s-list-thead">
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>TimeZone</th>
                    <th class="no-sort">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($users_clocks))
                @foreach($users_clocks as $clock)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$clock->name}}</td>
                    <td>{{$clock->timezone->timezone ?? ''}}</td>
                    <td class="std-list-icon">
                        <!-- <a class="edit-list-icons" id="edit_task_btn"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a> -->
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteClockRecord({{$user_id}},{{$clock->id}},'/users/delete_clock/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                       </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@include('admin.modals.deleteModal')
@endsection
<!-- Add Clock Modal -->
<div class="modal fade" id="clock_modal" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Multiple Clock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="#" id="user_clock">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Add Clocks</label>
                        <select class="form-control chosen-select" name="clock[]" multiple style="width: 100%" required>
                            @foreach($dropdownType as $value)
                            <option value="{{ $value->id }}">
                                {{ $value->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn edit_save" value="" id="add_courses_btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Clock Model -->
@section('scripts')
<script>
    $(document).ready(function () {
        // Initialize Select2 select box
        $("select[name=\"validation-select2\"]").select2({
            allowClear: true,
            placeholder: "Select gear...",
        }).change(function () {
            $(this).valid();
        });
        // Initialize Select2 multiselect box
        $("select[name=\"clock[]\"]").select2({
            placeholder: "Select Courses...",
        }).change(function () {
            $(this).valid();
        });
        $(document).on('click', '#add_clock', function () {
            var user_id = $(this).attr('href');
            $('#user_clock').attr('action','/users/storeـusersـclock/'+user_id);
        });
    });
</script>
<script>
    var table;
    $(document).ready(function () {

        table = $('#users').DataTable({
            responsive: true,
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
                    orderable: false,
                    searchable: false
                },
            ],
            drawCallback: function (response) {

                $('#countTotal').empty();
                $('#countTotal').append(response['json'].recordsTotal);
            },
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.childRowImmediate,
                    type: "none",
                    target: "",
                },
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
                        success: function (response) {
                            if (response.status == 1) {
                                Swal.fire("Activated!", response.message, "success");
                                $('#users').DataTable().ajax.reload();
                            } else {
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
