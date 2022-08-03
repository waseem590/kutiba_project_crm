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
            <h1 class="page-heading">Ticket List</h1>
        </div>
        <div class="mm-studentlist-main  table-responsive">
            <table id="mm-ticket-List" class="table table-bordered  student_list_table">
                <thead class="s-list-thead">

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-capitalize">ticket no</th>
                        <th scope="col" class="text-capitalize">User</th>
                        <th scope="col" class="text-capitalize">title</th>
                        <th scope="col" class="text-capitalize">periority</th>
                        <th scope="col" class="text-capitalize">message</th>
                        <th scope="col" class="text-capitalize">status</th>
                        <th scope="col">Date</th>

                        <th scope="col" class="custem-text-center">Action</th>

                    </tr>
                </thead>
                <tbody id="ticket_filter_table">
                    @if (count($tickets) > 0)
                    @foreach ($tickets as $ticket)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <th>
                            {{ $ticket->ticket_no }}
                        </th>
                        <td>{{ $ticket->users->name }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->periority }}</td>
                        <td>{{ $ticket->message }}</td>
                        <td class="tr_ticket_status">{{ $ticket->status }}</td>
                        <td>{{ date('M d, Y', strtotime($ticket->created_at ?? '')) }}</td>

                        <td>
                            <a href="{{ route('ticket.show', $ticket->id) }}" class="edit-list-icons"><img
                                    src="{{ asset('admin/images/list-icon-std.png') }}" alt="view-ticket"
                                    class="img-fluid" /></a>
                            @role('Master User')
                            <div class="dropdown" style="display: inline-block;">
                                <a href="#" class="edit-list-icons dlt_ticket"><img
                                    src="{{ asset('admin/images/list-delet-std.png') }}" alt="edit-std"
                                    class="img-fluid" /></a>
                                <button class="btn tbl-dropdown dropdown-toggle ticket_status_dropdown" title="Status"
                                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" value="{{ $ticket->id }}">
                                </button>
                                <div class="dropdown-menu dropdown ticket_status" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">open</a>
                                    <a class="dropdown-item" href="#">close</a>

                                </div>
                            </div>
                            @endrole
                        </td>
                    </tr>
                @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center"> List is empty yet </td>
                        </tr>
                    @endif

                </tbody>
            </table>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.ticket_status a').on('click', function(e) {
                e.preventDefault();
                // var status = $(this).text();
                var row = $(this).closest('tr');
                var status = $(this).text();
                var ticket_id = $(row).find('.ticket_status_dropdown').val();
                console.log(ticket_id);

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                $.ajax({
                    method: "POST",
                    url: "{{ route('ticket_update') }}",
                    data: {
                        id: ticket_id,
                        status: status
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        toastr.success("Status Updated Successfully");
                        setInterval(1000);
                        $(row).find('.tr_ticket_status').text(data.status);
                    }
                });
            });

            $('.dlt_ticket').on('click', function(e){
                e.preventDefault();
                // var status = $(this).text();
                var row = $(this).closest('tr');
                var ticket_id = $(row).find('.ticket_status_dropdown').val();
                console.log(ticket_id);
                if (window.confirm('Do you want to delete this ticket?')) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });

                    $.ajax({
                        method: "post",
                        url: "{{ route('ticket_destroy') }}",
                        data: {
                            id: ticket_id
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            toastr.error("Ticket deleted Successfully");
                            setInterval(1000);
                            $(row).remove();
                        }
                    });
                }
            })
        });
    </script>
@endsection
