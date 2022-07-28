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
                    @foreach ($tickets as $ticket)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <th>{{ $ticket->ticket_no }}</th>
                            <td>{{ $ticket->users->name }}</td>
                            <td>{{ $ticket->title }}</td>
                            <td>{{ $ticket->periority }}</td>
                            <td>{{ $ticket->message }}</td>
                            <td>{{ $ticket->status }}</td>
                            <td>{{date('M d, Y', strtotime($ticket->created_at ?? ''))}}</td>

                            <td>
                                <a href="{{ route('ticket.show',$ticket->id)}}" class="edit-list-icons"><img
                                    src="{{ asset('admin/images/list-icon-std.png')}}" alt="view-ticket"
                                    class="img-fluid" /></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <!-- dataTable links -->
    <!-- <script src="{{ asset('admin/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/js/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/datatable/jquery-3.5.1.js') }}"></script> -->
@endsection
