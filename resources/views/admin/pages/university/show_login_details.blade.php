@extends('admin.master')

@section('content')
<div class="students-List-section">
    <h1 class="page-heading" style="display: inline-block;">Login Details</h1>
    @can('show_login_detail')
        <a href="{{route('add.login.details')}}" class="btn edit_save float-right">Add Login Details</a>
    @endcan
    <div class="table-responsive">
        <table id="example" class="table table-bordered">

            <thead class="s-list-thead">
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Portal Name</th>
                        <th scope="col">Portal Link</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Password</th>
                        @can('show_login_detail')
                            <th scope="col" class="custem-text-center">Action</th>
                        @endcan
                    </tr>
                </tr>
            </thead>
            <tbody>
                @foreach ($login_details as $login_detail)
                <tr>
                    <th scope="row" class="w-60">
                        {{$loop->iteration}}
                    </th>
                    <td>{{$login_detail->portal_name}}</td>
                    <td><a href="{{$login_detail->portal_link}}" target="_blank">{{$login_detail->portal_link}}</a></td>
                    <td>{{$login_detail->user_name ?? ''}}</td>
                    <td>{{$login_detail->show_password}}</td>
                    @can('show_login_detail')
                    <td class="custem-text-center std-list-icon">
                        <a href="{{ route('edit_login_detail',$login_detail->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$login_detail->id}},'/delete_login_detail/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@include('admin.modals.deleteModal')
@endsection
