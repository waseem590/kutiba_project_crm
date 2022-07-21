@extends('admin.master')

@section('content')
<div class="students-List-section">
    <h1 class="page-heading" style="display: inline-block;">School Contacts List</h1>
    <a href="{{route('school.contacts')}}" class="btn edit_save float-right">Add New School Contacts</a>
    <div class="table-responsive">
        <table id="example" class="table table-bordered mm-school" width="100%" cellspacing="0">

            <thead class="s-list-thead">
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Staff Name</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Institution</th>
                        <!-- <th scope="col">Contact Number</th> -->
                        <!-- <th scope="col">Alternative Contact Number</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Notes</th> -->
                        <th scope="col" class="custem-text-center">Action</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <th scope="row" class="w-60">
                        {{$loop->iteration}}
                    </th>
                    <td>{{$item->staff_name ?? ''}}</td>
                    <td>{{$item->job_title ?? ''}}</td>
                    <td> {{$item->email ?? ''}}</td>
                    <td> {{$item->institution ?? ''}}</td>
                    <!-- <td>{{$item->contact_no ?? ''}}</td>
                    <td>{{$item->contact_no2 ?? ''}}</td>
                    <td>{{date('M d, Y', strtotime($item->dob ?? ''))}}</td>
                    <td>{{$item->notes ?? ''}}</td> -->


                    <td class="custem-text-center std-list-icon">
                        <a href="{{ route('edit_school_contacts',$item->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <a href="{{ route('show.school.contacts',$item->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/list-icon-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/guidelines/delete_school_contacts/')"
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
