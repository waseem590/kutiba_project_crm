@extends('admin.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <style>
        .btn-primary-outline {
            width: 125px;
            height: 40px;
            font-size: 14px;
            font-weight: 400;
            background-color: white !important;
            border: none;
            border-radius: 50px;
            margin-bottom: 20px;

        }

        .btn-primary-outline:hover {
            background-color: #f5981f !important;
            border-color: #ffffff !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
            color: white;

        }

        .contact_bg {
            background-color: #f5981f !important;
            border-color: #ffffff !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
            color: white;
        }
    </style>
@endpush
@section('content')
    <div class="students-List-section">
        <div class="d-flex justify-content-between flex-wrap">
            <h1 class="page-heading">Students List</h1>

            @cannot('Master_user')
                @can('filter_management_table')
                    <div class="d-flex justify-content-center">
                        <h5 for="" class="mt-2 mr-2" style="color:#37353e !important">Filter Students</h5>
                        <select name="filter" class="form-control aduser-input-inner-text mm-sl-select" id="filter">
                            <option selected="" disabled="">Select</option>
                            <option value="1">
                                Counsellor Commence in 2 Months Students</option>
                            <option value="2">
                                Finance mark completed Students</option>
                            <option value="3">
                                Finance task completed Students</option>
                            <option value="4">
                                Counsellor & Admissions Submitted Application</option>
                            <option value="5">
                                Counsellor & Admissions Information Provided Applications</option>
                            <option value="6">
                                Counsellor & Admissions Acceptance Sent</option>
                            <option value="7">
                                Counsellor & Admissions Acceptance Information provided </option>
                        </select>
                    </div>
                @endcan
            @endcannot
        </div>

        <button class="std-detail_btns white-bg" data-toggle="modal" data-target="#form" style="float:right;"><i
                class="fa fa-search"></i>&nbsp;&nbsp; Advance Search</button>









        <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel">Advance Search</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="search2" method="GET">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="email1" style="color:black;">Counsellor</label>

                                <select class="form-control" name="search">
                                    <option></option>
                                    @foreach ($counsellor as $key => $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="password1" style="color:black;">Admission Officer</label>
                                <select class="form-control" name="search2">
                                    <option></option>
                                    @foreach ($admission_officer as $key => $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="password1" style="color:black;">Status</label>
                                <select class="form-control" name="status">
                                    <option></option>

                                    <option value="Acceptance Information Requested">Acceptance Information Requested
                                    </option>

                                </select>
                            </div>





                        </div>
                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="mm-stdlist-main  table-responsive">

            <table id="mm-std-List" class="table table-bordered  student_list_table">
                <thead class="s-list-thead">
                    <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <!-- <th scope="col">Email</th> -->
                        <th scope="col">Phone</th>
                        <th scope="col">Country</th>
                        <th scope="col">Counsellor</th>
                        <th scope="col">Officer</th>
                        <th scope="col">Date</th>

                        <th scope="col" class="custem-text-center">Action</th>

                    </tr>
                    </tr>
                </thead>
                <tbody id="student_filter_table">
                    <?php $counter = 0; ?>
                    @foreach ($add_students as $key => $item)
                        @php
                            if (!empty($item->info->name)) {
                                $name = explode(' ', $item->info->name);
                            }
                        @endphp
                        <tr>
                            <th scope="row" class="w-60">
                                {{ ++$counter }}
                            </th>
                            <td class="text-nowrap"><a href="{{ route('student.show', $item->id) }}">{{ $name[1] ?? '' }}
                                    {{ $name[0] ?? '' }}</a></td>
                            <!-- <td>{{ $item->contact->email ?? '' }}</td> -->
                            <td>{{ $item->contact->contact_number ?? '' }}</td>
                            <td>
                                @if (!empty($item->contact->country))
                                    @foreach ($countries as $country)
                                        @if ($country->id == $item->contact->country)
                                            {{ $country->name }}
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @foreach ($counsellor as $val)
                                    @if ($val->id == $item->counsellor)
                                        {{ $val->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($admission_officer as $val)
                                    @if ($val->id == $item->admission_officer)
                                        {{ $val->name }}
                                    @endif
                                @endforeach

                            </td>
                            <td>{{ date('M d, Y', strtotime($item->created_at ?? '')) }}</td>
                            <td class="custem-text-center std-list-icon">
                                <a href="https://api.whatsapp.com/send?phone={{ $item->contact->contact_number ?? '' }}"
                                    class="edit-list-icons" target="_blank" data-bs-toggle="" data-bs-target=""><img
                                        src="{{ asset('admin/images/whatsapp.png') }}" alt="edit-std"
                                        class="img-fluid"></a>
                                <a href="{{ $item->info->name ?? '' }}" class="edit-list-icons sms" data-bs-toggle="modal"
                                    data-bs-target="#sms-modal" data-id="{{ $item->id }}"><img
                                        src="{{ asset('admin/images/sms.png') }}" alt="edit-std" class="img-fluid">
                                    <input type="hidden" class="first_contact_num"
                                        value="{{ $item->contact->contact_number ?? '' }}">
                                    <input type="hidden" class="second_contact_num"
                                        value="{{ $item->contact->secondary_contact_number ?? '' }}">
                                </a>
                                <a href="mailto:{{ $item->contact->email ?? '' }}?subject={{ $item->info->name ?? '' }}-{{ $item->id }}"
                                    class="edit-list-icons " data-bs-toggle="" data-bs-target=""><img
                                        src="{{ asset('admin/images/mails.png') }}" alt="edit-std"
                                        class="img-fluid"></a>
                                <a href="{{ route('student.edit', $item->id) }}" class="edit-list-icons"><img
                                        src="{{ asset('admin/images/edit-std.png') }}" alt="edit-std"
                                        class="img-fluid std-list-edit-img" /></a>
                                <a href="{{ route('student.show', $item->id) }}" class="edit-list-icons"><img
                                        src="{{ asset('admin/images/list-icon-std.png') }}" alt="edit-std"
                                        class="img-fluid" /></a>
                                @can('delete student')
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        class="edit-list-icons" onclick="deleteRecord({{ $item->id }},'/student/')"><img
                                            src="{{ asset('admin/images/list-delet-std.png') }}" alt="edit-std"
                                            class="img-fluid" /></a>
                                    <!-- <a href="https://wa.me/923080411788" target="_blank">Link Text Here</a> -->
                                @endcan
                                @if ($item->mark == 'Complete')
                                    <input type="checkbox" checked data-toggle="toggle" id="complete_stu"
                                        data-on="Complete" data-off="Incomplete"
                                        class="complete_status custom-switch-lg complete1" data-id="{{ $item->id }}"
                                        data-onstyle="success" data-offstyle="danger">
                                @else
                                    <input type="checkbox" checked data-toggle="toggle" id="complete_stu"
                                        data-on="Complete" data-off="Incomplete"
                                        class="complete_status custom-switch-lg complete" data-id="{{ $item->id }}"
                                        data-onstyle="success" data-offstyle="danger">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    @include('admin.modals.emailModal')
    @include('admin.modals.smsModal')
    @include('admin.modals.whatsupModal')
    @include('admin.modals.deleteModal')
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <!-- dataTable links -->
    <!-- <script src="{{ asset('admin/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/js/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/datatable/jquery-3.5.1.js') }}"></script> -->
    <script>
        $(document).on('click', '.sms', function(e) {
            var current = $(this);
            e.preventDefault();
            var std_id = $(this).data('id');
            var std_name = $(this).attr('href');
            $('.id_name').text(std_name + '-' + std_id);
            var first_contact_num = current.children(".first_contact_num");
            var second_contact_num = current.children(".second_contact_num");
            var contact_first = $('.first_name_btn').text(first_contact_num.val());
            var contact_second = $('.second_name_btn').text(second_contact_num.val());
            if ($('.second_name_btn').text() == '') {
                $('.second_name_btn').css('display', 'none');
            } else {
                $('.first_name_btn').css('display', 'inline-block');
            }
            if ($('.first_name_btn').text() == '') {
                $('.first_name_btn').css('display', 'none');
            } else {
                $('.first_name_btn').css('display', 'inline-block');
            }

        });
        $('.first_name_btn').on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('contact_bg');
            if ($(this).hasClass('contact_bg')) {
                $('#first_num').val($(this).text());
                console.log($('#first_num').val($(this).text()));
            } else {
                $('#first_num').val('');
                $(this).removeClass('contact_bg');
                console.log($('#first_num').val());
            }
        });
        $('.second_name_btn').on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('contact_bg');
            if ($(this).hasClass('contact_bg')) {
                $('#second_num').val($(this).text());
                console.log($('#second_num').val($(this).text()));
            } else {
                $('#second_num').val('');
                $(this).removeClass('contact_bg');
                console.log($('#second_num').val());
            }
        });
        $(document).ready(function() {
            $('#mm-std-List').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    lengthChange: false,
                    extend: 'csv',
                    text: '<i class="fa fa-download" aria-hidden="true"></i>',
                    filename: 'Students Record',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    },
                }],
                // responsive: {
                //  details: {
                //      display:
                //          $.fn.dataTable.Responsive.display.childRowImmediate,
                //      type: "none",
                //      target: "",
                //  },
                // },
            });
        });
    </script>
    <script>
        $(document).on('change', '#filter', function() {
            let filter_val = $("#filter option:selected").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('studentlists') }}',
                method: 'get',
                data: {
                    filter_val: filter_val
                },
                success: function(res) {
                    // console.log(res);
                    $('#student_filter_table').html(res);
                },
            });
        });
    </script>
    <script>
        $('.complete').bootstrapToggle('off');

        function status_complete(flag, id) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                data: {
                    flag: flag,
                    id: id
                },
                url: "{{ route('complete') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    toastr.success(data);
                }
            });
        }
        $(document).on('change', '#complete_stu', function() {
            var flag = 'incomplete';
            var id = $(this).data('id');
            if ($(this).prop('checked') == true) {
                flag = 'Complete';
                status_complete(flag, id);

            } else {
                flag = 'Incomplete';
                status_complete(flag, id);
            }
        });
    </script>
@endsection
