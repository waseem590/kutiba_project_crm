@extends('admin.master')

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
                <p>{{$ticket->ticket_no}}</p>
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
                <p>{{$ticket->users->name}}</p>
            </div>
            <div class="col-xl-3 col-sm-6">
                <h3>User Role:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$ticket->users->type}}</p>
            </div>
            <div class="col-xl-3 col-sm-6">
                <h3>Title:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">

                <p>{{$ticket->title}}</p>
            </div>

            <div class="col-xl-3 col-sm-6">
                <h3>Status:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$ticket->status}}</p>
            </div>

            <div class="col-xl-12 col-sm-12">
                <h3>Message:</h3>
            </div>
            <div class="col-xl-12 col-sm-12">
                <p>{{$ticket->message}}</p>
            </div>

            {{-- <div class="col-xl-3 col-sm-6">
                <h3>Payment Method:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
            <?php //$immigeration_pay_method = \App\Models\DropdownType::find($visa->immigration_pay_method)?>
                <p>{{$immigeration_pay_method['name']}}</p>
            </div>

            <div class="col-xl-3 col-sm-6">
                <h3> Date of Payment: </h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$visa->immigration_dop}}</p>
            </div> --}}

            {{-- <div class="col-xl-3 col-sm-6">
                <h3> Service Fee :</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$visa->service_fee}}</p>
            </div>

            <div class="col-xl-3 col-sm-6">
                <h3> Payment Method :</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <?php //$service_pay_method = \App\Models\DropdownType::find($visa->service_pay_method)?>
                <p>{{$service_pay_method['name']}}</p>
            </div>
            <div class="col-xl-3 col-sm-6">
                <h3> Date of Payment :</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$visa->service_dop}}</p>
            </div> --}}
        </div>
    </div>

</div>
{{-- @include('admin.modals.deleteModal') --}}
@endsection
