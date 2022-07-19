@extends('admin.master')

@section('content')
<div class="students-List-section mm-task-list">
    <h1 class="students-list-hed" style="display: inline-block;">Task List</h1>
    <button class="btn edit_save float-right" class="img-fluid edit-icon" data-bs-toggle="modal"
                data-bs-target="#add_task">Add New Task</button>
    <div class="table-responsive">
        <table id="example" class="table table-bordered">
            <thead class="s-list-thead">
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="custem-text-center">Action</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                <input style="display: none;" value="{{$student_id ?? ''}}" class="student_id">
                <input style="display: none;" class="rowIdForComment">
                @php
                $authUser = App\Models\User::find(auth()->user()->id);
                $authUserRole = $authUser->getRoleNames()[0];
                @endphp
                @if($authUserRole == 'Counsellor')
                @foreach ($tasks as $item)
                @php
                $user = App\Models\User::find($item->created_users_id);
                $userRole = $user->getRoleNames()[0];
                @endphp
                @if(($item->created_users_id == auth()->user()->id) || ($userRole == 'Admissions'))
                <tr>

                    <th scope="row" class="w-60">
                        {{$loop->iteration}}
                    </th>
                    <td>{{$item->task_name ?? ''}}</td>
                    <td>{{date('M d, Y', strtotime($item->date ?? ''))}}</td>
                    <td class="complete_status_val">{{$item->status ?? ''}}</td>
                    <td class="custem-text-center std-list-icon">
                        <a href="{{ route('showTaskComments',$item->id.'/'.$student_id)}}" class="edit-list-icons comment_icon"
                            ><i class="fas fa-comment"></i></a>
                        <a href="{{ route('edit_task',$item->id)}}" class="edit-list-icons" id="edit_task_btn"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/delete_task/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        @if(auth()->user()->getRoleNames()[0] != 'Master User')
                          @can('add comment on tasks')
                          <div style="display: inline-block;">
                            <input class="complete_status" type="checkbox" @if(isset($item->status) && $item->status == 'Complete') ? checked : ''  @endif>
                          </div>
                          @endcan
                        @endif
                          <input type="hidden" value="{{$item->id ?? ''}}" class="edit_id">
                    </td>
                </tr>
                @endif
                @endforeach
                @endif

                @if($authUserRole == 'Management')
                @foreach ($tasks as $item)
                @php
                $user = App\Models\User::find($item->created_users_id);
                $userRole = $user->getRoleNames()[0];
                @endphp
                @if($userRole == 'Finance')
                <tr>

                    <th scope="row" class="w-60">
                        {{$loop->iteration}}
                    </th>
                    <td>{{$item->task_name ?? ''}}</td>
                    <td>{{date('M d, Y', strtotime($item->date ?? ''))}}</td>
                    <td class="complete_status_val">{{$item->status ?? ''}}</td>
                    <td class="custem-text-center std-list-icon">
                        <a href="{{ route('showTaskComments',$item->id.'/'.$student_id)}}" class="edit-list-icons comment_icon"
                            ><i class="fas fa-comment"></i></a>
                        <a href="{{ route('edit_task',$item->id)}}" class="edit-list-icons" id="edit_task_btn"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/delete_task/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <input type="hidden" value="{{$item->id ?? ''}}" class="edit_id">
                    </td>
                </tr>
                @endif
                @endforeach
                @endif


                @if(($authUserRole == 'Admissions') || ($authUserRole == 'Finance'))
                @foreach ($tasks as $item)
                @if($item->created_users_id == auth()->user()->id)
                <tr>

                    <th scope="row" class="w-60">
                        {{$loop->iteration}}
                    </th>
                    <td>{{$item->task_name ?? ''}}</td>
                    <td>{{date('M d, Y', strtotime($item->date ?? ''))}}</td>
                    <td class="complete_status_val">{{$item->status ?? ''}}</td>
                    <td class="custem-text-center std-list-icon">
                        <a href="{{ route('showTaskComments',$item->id.'/'.$student_id)}}" class="edit-list-icons comment_icon"
                            ><i class="fas fa-comment"></i></a>
                        <a href="{{ route('edit_task',$item->id)}}" class="edit-list-icons" id="edit_task_btn"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/delete_task/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        @if(auth()->user()->getRoleNames()[0] != 'Master User')
                          @can('add comment on tasks')
                          <div style="display: inline-block;">
                            <input class="complete_status" type="checkbox" @if(isset($item->status) && $item->status == 'Complete') ? checked : ''  @endif>
                          </div>
                          @endcan
                        @endif
                          <input type="hidden" value="{{$item->id ?? ''}}" class="edit_id">
                    </td>
                </tr>
                @endif
                @endforeach
                @endif



                @if(auth()->user()->hasRole('Master User') == true)
                @foreach ($tasks as $item)
                <tr>

                    <th scope="row" class="w-60">
                        {{$loop->iteration}}
                    </th>
                    <td>{{$item->task_name ?? ''}}</td>
                    <td>{{date('M d, Y', strtotime($item->date ?? ''))}}</td>
                    <td class="complete_status_val">{{$item->status ?? ''}}</td>
                    <td class="custem-text-center std-list-icon">
                        <a href="{{ route('showTaskComments',$item->id.'/'.$student_id)}}" class="edit-list-icons comment_icon"
                            ><i class="fas fa-comment"></i></a>
                        <a href="{{ route('edit_task',$item->id)}}" class="edit-list-icons" id="edit_task_btn"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$item->id}},'/delete_task/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        @if(auth()->user()->getRoleNames()[0] != 'Master User')
                          @can('add comment on tasks')
                          <div style="display: inline-block;">
                            <input class="complete_status" type="checkbox" @if(isset($item->status) && $item->status == 'Complete') ? checked : ''  @endif>
                          </div>
                          @endcan
                        @endif
                          <input type="hidden" value="{{$item->id ?? ''}}" class="edit_id">
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>

    </div>
</div>
<!-- Add Task Modal -->
<div class="modal fade" id="add_task" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('save_task')}}" id="add_task_form">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Task Name</label>
                        <input type="text" class="form-control" name="name">
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Task Date</label>
                        <input type="Date" class="form-control" name="date">
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn edit_save" id="add_task_btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Task Model -->
<!-- Edit Task Modal -->
<div class="modal fade" id="edit_task" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('update_task')}}" id="update_task_form">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Task Name</label>
                        <input type="text" class="form-control edit_name" name="update_name">
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Task Date</label>
                        <input type="Date" class="form-control edit_date" name="update_date">
                        <input type="hidden" class="form-control updated_id" name="updated_id">
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn edit_save" id="update_task_btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Edit Task Model -->
<!-- Comment Modal -->
<div class="modal fade" id="comment_modal" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Comment</h5>
                <button type="button" class="btn-close comment_close_btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Add Comment</label>
                        <!-- <input type="text" value="{{$student->info->name ?? ''}}" class="form-control course_name" disabled> -->
                        <textarea rows="4" class="form-control comment_textarea"></textarea>
                        <p class="comment_textarea_p"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn edit_save save_comment" value="{{$student_id ?? ''}}">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Comment Model -->
@include('admin.modals.deleteModal')
@endsection
@section('scripts')
<script>
    $('.comment_close_btn').on('click', function(e){
        e.preventDefault();
        $('#comment_modal').modal('hide');
        location.reload();
    })
    $('.complete_status').on('change', function(e){
        e.preventDefault();
        // $('#comment_modal').modal('show');
        var row = $(this).closest('tr');
        var val = row.find('.complete_status_val').text();

        var updated_row_id = row.find('.edit_id').val();
        $('body').find('.rowIdForComment').val(updated_row_id);
        // var updated_row_id = row.find('.edit_id').val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            data:{ val : val, updated_row_id : updated_row_id},
            url: "{{ route('update_task_status') }}",
            type: "POST",
            dataType: "json",
            success: function (data) {
                // alert(val);
                if(val == 'UnComplete'){
                    $('#comment_modal').modal('show');
                }else{
                    location.reload();
                }

            }
        });
    })
    $('.save_comment').on('click', function(e){
        e.preventDefault();
        // alert($(this).val());
        var student_id = $(this).val();
        var val = $('.comment_textarea').val();
        var course_rw_id = $('.rowIdForComment').val();
        if(val == ''){
            $('.comment_textarea').addClass('course_comment_error');
            $('.comment_textarea_p').text('Enter The Comment');
        }else{
            // alert('no value');
            $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            });
            $.ajax({
                data:{ val : val, student_id : student_id, course_rw_id : course_rw_id},
                url: "{{ route('save_task_comment') }}",
                type: "POST",
                dataType: "json",
                success: function (data) {
                    // toastr.success("Record Added Successfully");
                    location.reload();
                    // $('#comment_modal').modal('hide');
                }
            });
        }

    });






    // Save Task Request
    $(document).on("click", "#add_task_btn", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            data: $("#add_task_form").serialize() +
                "&student_id=" +
                $(".student_id").val(),
            url: "{{ route('save_task') }}",
            type: "POST",
            dataType: "json",
            success: function (data) {
                toastr.success("Record Added Successfully");
                setInterval(function () {
                    location.reload();
                }, 1000);

            },
            error: function (responce) {
                $.each(responce.responseJSON.errors, function (index, el) {
                    var field = $("body").find("[name='" + index + "']");
                    field.addClass("error");
                    var box = field.closest("div");
                    box.find(".invalid-feedback").css("display", "block");
                    box.find("p").text(el[0]);
                });
            }
        });
    });
    // update Task Request
    $(document).on("click", "#update_task_btn", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            data: $("#update_task_form").serialize(),
            url: "{{ route('update_task') }}",
            type: "POST",
            dataType: "json",
            success: function (data) {
                toastr.success("Record Updated Successfully");
                setInterval(function () {
                    location.reload();
                }, 1000);
            },
            error: function (responce) {
                $.each(responce.responseJSON.errors, function (index, el) {
                    var field = $("body").find("[name='" + index + "']");
                    field.addClass("error");
                    var box = field.closest("div");
                    box.find(".invalid-feedback").css("display", "block");
                    box.find("p").text(el[0]);
                });
            }
        });
    });
    // Edit Task Request
    $(document).on("click", "#edit_task_btn", function (e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        var edit_id = row.find('.edit_id').val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            data: {edit_id:edit_id},
            url: "{{ route('edit_task') }}",
            type: "GET",
            dataType: "json",
            success: function (response) {
                $(".edit_name").val(response.task_name);
                $(".edit_date").val(response.date);
                $(".updated_id").val(response.id);
                $("#edit_task").modal("show");
            }
        });
    });
      // when put value in input remove the errors
    $("input").on("change", function () {
        if ($(this).val()) {
            $(this).removeClass("error");
            var box = $(this).closest("div");
            box.find(".invalid-feedback").css("display", "none");
            box.find("p").text("");
        }
    });
</script>
@endsection
