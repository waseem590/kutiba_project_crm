@extends('admin.master')

@section('content')
<div class="students-List-section">
    <h1 class="students-list-hed" style="display: inline-block;">Visa List</h1>
    <div class="table-responsive">
        <table id="example" class="table table-bordered">
            <thead class="s-list-thead">
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Case Officer</th>
                        <th scope="col">Visa Type</th>
                        <th scope="col">Student Name</th>
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
                        {{$case_officer['name']}}
                    </td>

                    <td>
                        <?php $case_officer = \App\Models\DropdownType::find($item->visa_type)?>
                        {{$case_officer['name']}}
                    </td>
                    <td>
                        {{$item->student->info['name']}}
                    </td>

                    <td class="custem-text-center std-list-icon">
                        @can('add visa')
                        <a href="{{ route('edit_visa',$item->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        @endcan
                        <a href="{{ route('view.visa',$item->id)}}" class="edit-list-icons"
                            ><img
                                src="{{ asset('admin/images/list-icon-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        @can('add visa')
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/delete_visa/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@include('admin.modals.deleteModal')
@endsection
@section('scripts')
@endsection
