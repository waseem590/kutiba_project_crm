@extends('admin.master')
@push('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<style>
    @import url('https://fonts.googleapis.com/css?family=Arimo:400,700&display=swap');

    .warpper {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .tab {
        cursor: pointer;
        padding: 10px 20px;
        margin: 0px 2px;
        background: #f5981f;
        display: inline-block;
        color: #fff;
        border-radius: 3px 3px 0px 0px;
        box-shadow: 0 0.5rem 0.8rem #00000080;
    }

    .panels {
        background: #fffffff6;
        box-shadow: 0 2rem 2rem #00000080;
        min-height: 200px;
        width: 100%;
        border-radius: 3px;
        overflow: hidden;
        padding: 20px;
    }

    .panel {
        display: none;
        animation: fadein .8s;
    }

    @keyframes fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .panel-title {
        font-size: 1.5em;
        font-weight: bold
    }

    .radio {
        display: none;
    }

    #one:checked~.panels #one-panel,
    #two:checked~.panels #two-panel,
    #three:checked~.panels #three-panel {
        display: block
    }
    #four:checked~.panels #four-panel,
    #five:checked~.panels #five-panel,
    #six:checked~.panels #six-panel {
        display: block
    }
    #one:checked~.tabs #one-tab,
    #two:checked~.tabs #two-tab,
    #three:checked~.tabs #three-tab {
        background: #fffffff6;
        color: #000;
        border-top: 3px solid #f5981f;
    }
    #four:checked~.tabs #four-tab,
    #five:checked~.tabs #five-tab,
    #six:checked~.tabs #six-tab {
        background: #fffffff6;
        color: #000;
        border-top: 3px solid #f5981f;
    }

    @media (max-width:1032px){
    .tab{
     margin: 4px 2px;
    }

    }
</style>
@endpush
@section('content')
<div class="students-List-section">
    <h1 class="students-list-hed" style="display: inline-block;">Visa List</h1>
    <div class="warpper">
        <input class="radio" id="one" name="group" type="radio" checked>
        <input class="radio" id="two" name="group" type="radio">
        <input class="radio" id="three" name="group" type="radio">
        <input class="radio" id="four" name="group" type="radio">
        <input class="radio" id="five" name="group" type="radio">
        <input class="radio" id="six" name="group" type="radio">
        <div class="tabs">
            @can('submitted_more_information_information_provided')
            <label class="tab" id="one-tab" for="one">All</label>
            @endcan
            @can('expire visa within 2 months')
            <label class="tab" id="two-tab" for="two">Expire Within 2 Months</label>
            @endcan
            @can('unpaid visa fee')
            <label class="tab" id="three-tab" for="three">Unpaid</label>
            @endcan
            @can('submitted_more_information_information_provided')
            <label class="tab" id="four-tab" for="four">Submitted</label>
            <label class="tab" id="five-tab" for="five">More Information</label>
            <label class="tab" id="six-tab" for="six">Information Provided</label>
            @endcan
        </div>
        <div class="panels">
            <div class="table-responsive panel" id="one-panel">
                <table id="example" class="table table-bordered">
                    <thead class="s-list-thead">
                        <tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Case Officer</th>
                            <th scope="col">Visa Type</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="custem-text-center">Action</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($student_visa as $item)
                        <tr>
                            <th scope="row" class="w-60">
                                {{$loop->iteration}}
                            </th>
                            <td>
                                <?php $case_officer = \App\Models\DropdownType::find($item->case_officer)?>
                                {{$case_officer['name'] ?? ''}}
                            </td>

                            <td>
                                <?php $case_officer = \App\Models\DropdownType::find($item->visa_type)?>
                                {{$case_officer['name'] ?? ''}}
                            </td>
                            <td>
                                {{$item->student->info['name'] ?? ''}}
                            </td>
                            <td class="status_td">
                               {{$item->select_status ?? 'Submitted'}}
                            </td>

                            <td class="custem-text-center std-list-icon">
                                @can('add visa')
                                <a href="{{ route('edit_visa',$item->id)}}" class="edit-list-icons"><img
                                        src="{{ asset('admin/images/edit-std.png')}}" alt="edit-std"
                                        class="img-fluid" /></a>
                                @endcan
                                <a href="{{ route('view.visa',$item->id)}}" class="edit-list-icons"><img
                                        src="{{ asset('admin/images/list-icon-std.png')}}" alt="edit-std"
                                        class="img-fluid" /></a>
                                @can('add visa')
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/delete_visa/')"><img
                                        src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std"
                                        class="img-fluid" /></a>
                                @endcan
                                <div class="dropdown" style="display: inline-block;">
                                    <button class="btn tbl-dropdown dropdown-toggle status_dropdown" title="Status"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" value="{{$item->id}}">

                                    </button>
                                    <div class="dropdown-menu dropdown status" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item select_status_submitted" href="1">Submitted</a>
                                        <a class="dropdown-item select_status_approved" href="2">Approved</a>
                                        <a class="dropdown-item select_status_more_info_reqired" href="3">More Information Required</a>
                                        <a class="dropdown-item select_status_information_provided" href="4">Information Provided</a>
                                    </div>
                                </div>
                                <input type="hidden" value="{{$item->id ?? ''}}" class="app_id">
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="table-responsive panel" id="two-panel">
                <table id="expire_datatable" class="table table-bordered">
                    <thead class="s-list-thead">
                        <tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Case Officer</th>
                            <th scope="col">Visa Type</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="custem-text-center">Action</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody id="expire_visa_body">

                        @foreach ($visa_arr as $item)
                        <tr>
                            <th scope="row" class="w-60">
                                {{$loop->iteration}}
                            </th>
                            <td>
                                <?php $case_officer = \App\Models\DropdownType::find($item->case_officer)?>
                                {{$case_officer['name'] ?? ''}}
                            </td>

                            <td>
                                <?php $case_officer = \App\Models\DropdownType::find($item->visa_type)?>
                                {{$case_officer['name'] ?? ''}}
                            </td>
                            <td>
                                {{$item->student->info['name'] ?? ''}}
                            </td>
                            <td class="complete_status_val">{{$item->select_status ?? ''}}</td>
                            <td class="custem-text-center std-list-icon">
                                @role('Managment|Finance|Visa|Counselor|')
                                <a href="{{ route('show_visa_comment',$item->id)}}"
                                    class="edit-list-icons comment_icon"><i class="fas fa-comment"></i></a>
                                @endrole
                                @can('add visa')
                                <a href="{{ route('edit_visa',$item->id)}}" class="edit-list-icons"><img
                                        src="{{ asset('admin/images/edit-std.png')}}" alt="edit-std"
                                        class="img-fluid" /></a>
                                @endcan
                                <a href="{{ route('view.visa',$item->id)}}" class="edit-list-icons"><img
                                        src="{{ asset('admin/images/list-icon-std.png')}}" alt="edit-std"
                                        class="img-fluid" /></a>
                                @can('add visa')
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/delete_visa/')"><img
                                        src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std"
                                        class="img-fluid" /></a>
                                @endcan
                                @role('Managment|Finance|Visa|Counselor|')
                                <div style="display: inline-block;margin-left: 15px;" class="edit-list-icons">
                                    <!-- <input class="complete_status" type="checkbox" data-id="{{$item->id}}"> -->
                                    <input type="checkbox" checked data-toggle="toggle" id="complete" data-on="Complete" {{ $item->student=='Complete' ? 'checked': ''}}  data-off="Incomplete" class="complete_status custom-switch-lg complete" data-id="{{$item->id}}" data-onstyle="success" data-offstyle="danger">
                                    <input type="hidden" value="{{$item->id}}" data-id='{{$item->student->mark ?? "" }}' class="edit_id">
                                    <input type="hidden" value="{{$item->id}}" class="visa_row_id">
                                </div>

                                @endrole

                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="table-responsive panel" id="three-panel">
                <table id="unpaid" class="table table-bordered">
                    <thead class="s-list-thead">
                        <tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Case Officer</th>
                            <th scope="col">Visa Type</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="custem-text-center">Action</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($unpaid_visa as $item)
                        <tr>
                            <th scope="row" class="w-60">
                                {{$loop->iteration}}
                            </th>
                            <td>
                                <?php $case_officer = \App\Models\DropdownType::find($item->case_officer)?>
                                {{$case_officer['name'] ?? ''}}
                            </td>

                            <td>
                                <?php $case_officer = \App\Models\DropdownType::find($item->visa_type)?>
                                {{$case_officer['name'] ?? ''}}
                            </td>
                            <td>
                                {{$item->student->info['name'] ?? ''}}
                            </td>
                            <td class="complete_status_val">{{$item->status ?? ''}}</td>
                            <td class="custem-text-center std-list-icon">
                                <a href="{{ route('show_visa_comment',$item->id)}}"
                                    class="edit-list-icons comment_icon"><i class="fas fa-comment"></i></a> <a
                                    href="{{ route('view.visa',$item->id)}}" class="edit-list-icons"><img
                                        src="{{ asset('admin/images/list-icon-std.png')}}" alt="edit-std"
                                        class="img-fluid" /></a>
                                <div style="display: inline-block;margin-left: 15px;" class="edit-list-icons">
                                    <input class="complete_status" type="checkbox" data-id="{{$item->id}}">
                                    <input type="hidden" value="{{$item->id}}" class="edit_id">
                                    <input type="hidden" value="{{$item->id}}" class="visa_row_id">
                                </div>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            @can('submitted_more_information_information_provided')
            <div class="table-responsive panel" id="four-panel">
                <table id="example" class="table table-bordered">
                    <thead class="s-list-thead">
                        <tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Case Officer</th>
                            <th scope="col">Visa Type</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="custem-text-center">Action</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($student_visa as $item)
                            @if($item->select_status == "Submitted")
                                <tr>
                                    <th scope="row" class="w-60">
                                        {{$loop->iteration}}
                                    </th>
                                    <td>
                                        <?php $case_officer = \App\Models\DropdownType::find($item->case_officer)?>
                                        {{$case_officer['name'] ?? ''}}
                                    </td>

                                    <td>
                                        <?php $case_officer = \App\Models\DropdownType::find($item->visa_type)?>
                                        {{$case_officer['name'] ?? ''}}
                                    </td>
                                    <td>
                                        {{$item->student->info['name'] ?? ''}}
                                    </td>
                                    <td class="status_td">
                                    {{$item->select_status ?? 'Submitted'}}
                                    </td>

                                    <td class="custem-text-center std-list-icon">
                                        @can('add visa')
                                        <a href="{{ route('edit_visa',$item->id)}}" class="edit-list-icons"><img
                                                src="{{ asset('admin/images/edit-std.png')}}" alt="edit-std"
                                                class="img-fluid" /></a>
                                        @endcan
                                        <a href="{{ route('view.visa',$item->id)}}" class="edit-list-icons"><img
                                                src="{{ asset('admin/images/list-icon-std.png')}}" alt="edit-std"
                                                class="img-fluid" /></a>
                                        @can('add visa')
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/delete_visa/')"><img
                                                src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std"
                                                class="img-fluid" /></a>
                                        @endcan
                                        <div class="dropdown" style="display: inline-block;">
                                            <button class="btn tbl-dropdown dropdown-toggle status_dropdown" title="Status"
                                                type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" value="{{$item->id}}">

                                            </button>
                                            <div class="dropdown-menu dropdown status" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="1">Submitted</a>
                                                <a class="dropdown-item" href="2">Approved</a>
                                                <a class="dropdown-item" href="3">More Information Required</a>
                                                <a class="dropdown-item" href="4">Information Provided</a>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$item->id ?? ''}}" class="app_id">
                                    </td>

                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="table-responsive panel" style="height:200px !important;" id="five-panel">
                <table id="more_information"  class="table table-bordered">
                    <thead class="s-list-thead">
                        <tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Case Officer</th>
                            <th scope="col">Visa Type</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="custem-text-center">Action</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($student_visa as $item)
                            @if($item->select_status == "More Information Required")
                                <tr>
                                    <th scope="row" class="w-60">
                                        {{$loop->iteration}}
                                    </th>
                                    <td>
                                        <?php $case_officer = \App\Models\DropdownType::find($item->case_officer)?>
                                        {{$case_officer['name'] ?? ''}}
                                    </td>

                                    <td>
                                        <?php $case_officer = \App\Models\DropdownType::find($item->visa_type)?>
                                        {{$case_officer['name'] ?? ''}}
                                    </td>
                                    <td>
                                        {{$item->student->info['name'] ?? ''}}
                                    </td>
                                    <td class="status_td">
                                    {{$item->select_status ?? 'Submitted'}}
                                    </td>

                                    <td class="custem-text-center std-list-icon">
                                        @can('add visa')
                                        <a href="{{ route('edit_visa',$item->id)}}" class="edit-list-icons"><img
                                                src="{{ asset('admin/images/edit-std.png')}}" alt="edit-std"
                                                class="img-fluid" /></a>
                                        @endcan
                                        <a href="{{ route('view.visa',$item->id)}}" class="edit-list-icons"><img
                                                src="{{ asset('admin/images/list-icon-std.png')}}" alt="edit-std"
                                                class="img-fluid" /></a>
                                        @can('add visa')
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/delete_visa/')"><img
                                                src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std"
                                                class="img-fluid" /></a>
                                        @endcan
                                        <div class="dropdown" style="display: inline-block;">
                                            <button class="btn tbl-dropdown dropdown-toggle status_dropdown" title="Status"
                                                type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" value="{{$item->id}}">

                                            </button>
                                            <div class="dropdown-menu dropdown status" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="1">Submitted</a>
                                                <a class="dropdown-item" href="2">Approved</a>
                                                <a class="dropdown-item" href="3">More Information Required</a>
                                                <a class="dropdown-item" href="4">Information Provided</a>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$item->id ?? ''}}" class="app_id">
                                    </td>

                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="table-responsive panel" id="six-panel" style="height:200px !important;">
                <table id="information_provided" class="table table-bordered">
                    <thead class="s-list-thead">
                        <tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Case Officer</th>
                            <th scope="col">Visa Type</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="custem-text-center">Action</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($student_visa as $item)
                            @if($item->select_status == "Information Provided")
                                <tr>
                                    <th scope="row" class="w-60">
                                        {{$loop->iteration}}
                                    </th>
                                    <td>
                                        <?php $case_officer = \App\Models\DropdownType::find($item->case_officer)?>
                                        {{$case_officer['name'] ?? ''}}
                                    </td>

                                    <td>
                                        <?php $case_officer = \App\Models\DropdownType::find($item->visa_type)?>
                                        {{$case_officer['name'] ?? ''}}
                                    </td>
                                    <td>
                                        {{$item->student->info['name'] ?? ''}}
                                    </td>
                                    <td class="status_td">
                                    {{$item->select_status ?? 'Submitted'}}
                                    </td>

                                    <td class="custem-text-center std-list-icon">
                                        @can('add visa')
                                        <a href="{{ route('edit_visa',$item->id)}}" class="edit-list-icons"><img
                                                src="{{ asset('admin/images/edit-std.png')}}" alt="edit-std"
                                                class="img-fluid" /></a>
                                        @endcan
                                        <a href="{{ route('view.visa',$item->id)}}" class="edit-list-icons"><img
                                                src="{{ asset('admin/images/list-icon-std.png')}}" alt="edit-std"
                                                class="img-fluid" /></a>
                                        @can('add visa')
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/delete_visa/')"><img
                                                src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std"
                                                class="img-fluid" /></a>
                                        @endcan
                                        <div class="dropdown" style="display: inline-block;">
                                            <button class="btn tbl-dropdown dropdown-toggle status_dropdown" title="Status"
                                                type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" value="{{$item->id}}">

                                            </button>
                                            <div class="dropdown-menu dropdown status" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="1">Submitted</a>
                                                <a class="dropdown-item" href="2">Approved</a>
                                                <a class="dropdown-item" href="3">More Information Required</a>
                                                <a class="dropdown-item" href="4">Information Provided</a>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$item->id ?? ''}}" class="app_id">
                                    </td>

                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endcan
        </div>
    </div>

</div>
<!-- Comment Modal -->
<div class="modal fade" id="comment_modal" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="commend_form" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Add Comment</label>
                        <!-- <input type="text" value="{{$student->info->name ?? ''}}" class="form-control course_name" disabled> -->
                        <textarea rows="4" class="form-control comment_textarea" name="visa_comment"></textarea>
                        <p class="comment_textarea_p"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn edit_save save_comment" type="submit" value="">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Comment Model -->
<!-- Add Approved Visa Modal -->
<div class="modal fade" id="add_task" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Change Visa Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" id="add_visa_approved_form">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Approval Date</label>
                        <input type="date" class="form-control" name="approval_date" required>
                    </div>
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Expiration Date</label>
                        <input type="date" class="form-control" name="expiration_date" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn edit_save" value="" id="add_courses_btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Approved Visa Model -->

@include('admin.modals.deleteModal')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script>
    $('input[type="checkbox"]').click(function (e) {
        var current = $(this);
        if (current.is(":checked")) {
            console.log("checked");
            // e.preventDefault();
            var visa_id = $(this).data('id');
            $('.save_comment').val(visa_id);
            $('#commend_form').attr('action', `/visa_comment/` + visa_id + ``)
            $('#comment_modal').modal('show');
            var row = current.closest('tr');
            var val = row.find('.complete_status_val').text();
            var visa_row_id = row.find('.visa_row_id').val();
            $('body').find('.visa_row_id').val(visa_row_id);
            var updated_row_id = row.find('.edit_id').val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                data: {
                    val: val,
                    updated_row_id: updated_row_id
                },
                url: "{{ route('visa_complete_status') }}",
                type: "POST",
                dataType: "json",
                success: function (data) {
                    row.find('.complete_status_val').text(data);
                    if (data == "Complete") {
                        current.prop('checked');
                    } else {
                        current.prop('unchecked');
                    }
                }
            });
        } else if ($(this).is(":not(:checked)")) {
            var row = current.closest('tr');
            row.find('.complete_status_val').text('UnComplete');
            console.log("Checkbox is unchecked.");
        }
    });

</script>
<script>
    $(document).on('click', '.status a', function (e) {
        e.preventDefault();

        var val = $(this).text();
        var row = $(this).closest('tr');
        var visa_id = row.find('.app_id').val();
        if (val == 'Approved') {
            $('#add_task').modal('show');
            $('#add_visa_approved_form').attr('action','/approved_status/'+visa_id);
        }
        else {
            row.find('.status_td').text(val);
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                data: {
                    val: val,
                    visa_id: visa_id
                },
                url: "{{ route('visa_status_two') }}",
                type: "POST",
                dataType: "json",
                success: function (data) {
                    console.log("completed");
                    toastr.success("Status Updated Successfully");
                }
            });
            $(document).ajaxStop(function(){
                window.location.reload();
            })
        }
    })

</script>
<script>
    $('.complete').bootstrapToggle('off');
    function status_complete(flag,id){
        $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                data: {
                    flag: flag,
                    id:id
                },
                url: "{{ route('complete') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    toastr.success(data);
                }
            });
    }
    $(document).on('change','#complete', function(){
        var flag = 'Incomplete';
        var id = $(this).data('id');
        if($(this).prop('checked') == true){
            flag = 'Complete';
            status_complete(flag,id);
        }
        else{
            flag = 'Incomplete';
            status_complete(flag,id);
        }
    });

    // $('.select_status_information_provided').on('click', function(){
    //     var select_status_information_provided = $(this).text();
    //     var select_status_information_provided_html = $(this).html();

    //     console.log(select_status_information_provided);
    //     console.log(select_status_information_provided_html);

    // });
</script>
@endsection
