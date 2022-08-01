@extends('admin.master')
@section('css')
    <style>
        .comment_div {
            position: relative;
        }

        .comment_cust {
            position: absolute;
            right: 0;
            top: 50%;
        }
    </style>
@endsection
@section('content')
    <div class="students-List-section list-of-stds">
        <div class="mm-add-std-top-social">
            <h1 class="page-heading">Ticket View</h1>
            {{-- <div class="list-std-btns">
            @can('add_user_role_permission')
            <a class="edit-bg" href="{{ route('ticket.show',$ticket->id)}}"><i class="fas fa-pen"></i> &nbsp;
                Edit</a>
            <a class="del-bg" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
            onclick="deleteRecord({{$ticket->id}},'/delete_visa/')"><i class="fas fa-trash"></i>
                &nbsp; Delete</a>
            @endcan
        </div> --}}
        </div>
        <div class="list-of-student-inner list-std1">
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <h3>Ticket No:</h3>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <p>{{ $ticket->ticket_no }}</p>

                </div>
                <div class="col-xl-3 col-sm-6">
                    <h3>Date:</h3>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <p>{{ date('M d, Y', strtotime($ticket->created_at ?? '')) }}</p>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <h3>User Name:</h3>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <p>{{ $ticket->users->name }}</p>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <h3>User Role:</h3>
                </div>
                <div class="col-xl-3 col-sm-6">
                    @php
                        $user = \Spatie\Permission\Models\Role::where('id', $ticket->users->type)->first();
                        $role = $user->name;
                        // dd($role);
                    @endphp
                    <p>{{ $role }}</p>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <h3>Title:</h3>
                </div>
                <div class="col-xl-3 col-sm-6">

                    <p>{{ $ticket->title }}</p>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <h3>Status:</h3>
                </div>
                <div class="col-xl-3 col-sm-6">
                    @if ($ticket->status == 'open')
                        <p class="text-success">{{ $ticket->status }}</p>
                    @else
                        <p class="text-danger">{{ $ticket->status }}</p>
                    @endif
                </div>

                <div class="col-xl-12 col-sm-12">
                    <h3>Message:</h3>
                </div>
                <div class="col-xl-12 col-sm-12">
                    <p>{{ $ticket->message }}</p>
                </div>
            </div>
        </div>

        {{-- Div for Comments --}}
        <div class="list-of-student-inner list-std1 mt-3">
            <div class="row">
                <div class="col-xl-11 col-sm-12 mx-auto">
                    {{-- {{ dd($ticketComments) }} --}}
                    @if (count($ticketComments) > 0)
                        @foreach ($ticketComments as $ticketComment)
                            <div class="comment_div border p-3 mt-3">
                                {{-- <p class="d-none">{{ $ticketComment->tickets->id }}</p> --}}
                                <p class="d-none comment_id">{{ $ticketComment->id }}</p>
                                <h4>{{ $ticketComment->users->name }}</h4>
                                <p class="comment"><input type="text" class="form-control" readonly
                                        value="{{ $ticketComment->comment }}"> </p>
                                <div class="comment_cust">
                                    <a href="#" class="edit-list-icons edit_comment"><img
                                            src="{{ asset('admin/images/edit-std.png') }}" alt="edit-std"
                                            class="img-fluid edit-application" data-id="{{ $ticketComment->id }}" /></a>
                                    <a href="#" class="edit-list-icons dlt_comment"><img
                                            src="{{ asset('admin/images/list-delet-std.png') }}" alt="edit-std"
                                            class="img-fluid" /></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>
                            {{ 'No any comment yet' }}
                        </p>
                    @endif
                </div>
                <div class="col-xl-11 col-sm-12 mx-auto mt-3">
                    @if ($ticket->status == 'open')
                        <form class="form" action="{{ route('ticket_comment.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class=" form-group col-xl-12 col-sm-12 mx-auto">
                                    <input type="hidden" name="tickets_id" value="{{ $ticket->id }}">
                                    <input type="hidden" name="users_id" value="{{ $ticket->users_id }}">
                                    <textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" form-group col-xl-12 col-sm-12">
                                    <button class="btn btn-outline-secondary float-end" type="submit">Comment</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <p class="text-danger">This ticket is closed now.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
    {{-- @include('admin.modals.deleteModal') --}}
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.dlt_comment').on('click', function(e) {
                e.preventDefault();
                console.log("abc");
                var comment_div = $(this).closest('.comment_div');
                var comment_id = $(comment_div).find('.comment_id').html();
                console.log(comment_div);
                console.log(comment_id);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    method: "post",
                    url: "{{ route('ticket_comment_destroy') }}",
                    data: {
                        id: comment_id
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        toastr.error("Comment deleted Successfully");
                        setInterval(function() {
                            $(comment_div).remove();
                        }, 1000);

                    }
                })

            })
        })
    </script>
@endsection
