@extends('admin.master')
@push('css')
<style>
    .accomodation tr th:last-child {
    width: 1%;
    white-space: nowrap;
    }
    .accomodation .table > :not(:last-child) > :last-child > *{
        white-space: nowrap;
    }
</style>
@endpush
@section('content')
<div class="students-List-section mm_accommodation">
    <h1 class="students-list-hed" style="display: inline-block;">Accommodation List</h1>
   <span class="mm_mobile"><a href="{{route('add_accomodation',$student_id)}}" class="btn edit_save float-right">Add New Accommodation</a></span>
    <div class=" accomodation table-responsive">
        <table id="example" class="table table-bordered" width="100%" cellspacing="0">
            <thead class="s-list-thead">
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Accommodation Type</th>
                        <th scope="col">Placement Fee</th>
                        <th scope="col">Accommodation Fee</th>
                        <th scope="col">Arrival Date</th>
                        <th scope="col">Airport Pick Up</th>
                        <th scope="col">Airport Pick Up Fee</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="custem-text-center">Action</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                @foreach ($accommodation as $item)
                <tr>
                    <th scope="row" class="w-60">
                        {{$loop->iteration}}
                    </th>
                    <td>
                        @if(!empty($accomodation_types))
                            @foreach($accomodation_types as $val)
                                @if($val->id == $item->accommodation_type)
                                    {{$val->name}}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td>{{$item->placement_fee ?? ''}}</td>
                    <td> {{$item->accommodation_fee ?? ''}}</td>
                    <td>{{ date('M d, Y', strtotime($item->arrival_date)) }}</td>
                    <!-- <td>{{$item->arrival_date ?? ''}}</td> -->
                    <td>{{$item->airport_pickup ?? ''}}</td>
                    <td>{{$item->airport_pickup_fee	 ?? ''}}</td>

                    <td>
                        @if(!empty($accomodation_status))
                            @foreach($accomodation_status as $val)
                                @if($val->id == $item->status)
                                    {{$val->name}}
                                @endif
                            @endforeach
                        @endif
                    </td>

                    <td class="custem-text-center std-list-icon">
                        <a href="{{ route('edit_accomodation',$item->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/delete_accommodation/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@include('admin.modals.deleteModal')
@endsection
