@extends('admin.master')

@section('content')
<div class="students-List-section mm-task-list">
    <h1 class="students-list-hed" style="display: inline-block;">Courses List</h1>
    <button class="btn edit_save float-right" class="img-fluid edit-icon" data-bs-toggle="modal"
                data-bs-target="#add_task">Add New Courses</button>
    <div class="table-responsive">
        <table id="example" class="table table-bordered">
            <thead class="s-list-thead">
                <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Accepted Status</th>
                        <th scope="col">Complete</th>
                        <th scope="col" class="custem-text-center">Action</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                <input style="display: none;" class="updated_course_id">
                <input style="display: none;" class="updated_row_id">
                @if(!empty($courses))
                @foreach ($courses as $item)
                <tr>
                    <th scope="row" class="w-60">
                        {{$loop->iteration}}
                    </th>
                    <td>{{$item->name ?? ''}}</td>
                    <td class="accepted_status_val">{{$item->pivot->course_accepted ?? ''}}</td>
                    <td class="complete_status_val">{{$item->pivot->course_complete ?? ''}}</td>
                    <input type="hidden" class="course_row_idd">
                    <input type="hidden" class="pivot_id" value="{{$item->pivot->id}}">

                    <td class="custem-text-center std-list-icon">
                        <a href="{{ route('showCourseComments',$item->id.'/'.$student->id)}}" class="edit-list-icons comment_icon"
                            ><i class="fas fa-comment"></i></a>
                        <a class="edit-list-icons" id="edit_task_btn"
                            ><img
                                src="{{ asset('admin/images/edit-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$item->pivot->id ?? ''}},'/delete_course/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        <div class="dropdown" style="display: inline-block;">
                            <button class="btn tbl-dropdown dropdown-toggle" title="Status" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            </button>
                            <div class="dropdown-menu dropdown accepted_status" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">Accepted</a>
                              <a class="dropdown-item" href="#">Not Accepted</a>
                            </div>
                          </div>
                          @if(auth()->user()->getRoleNames()[0] != 'Master User')
                          @can('add comment on courses')
                          <div style="display: inline-block;margin-left: 15px;">
                            <input class="complete_status"  type="checkbox"  data-id="{{$item->id}}" @if(isset($item->pivot->course_complete) && $item->pivot->course_complete == 'Complete') ? checked : ''  @endif>
                          </div>
                          @endcan
                          @endif
                          <input type="hidden" value="{{$item->pivot->id ?? ''}}" class="edit_id">
                          <input type="hidden" value="{{$item->id ?? ''}}" class="course_row_id">
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
                <h5 class="modal-title" id="staticBackdropLabel">Add Courses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('save_courses')}}" id="add_courses_form">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Student Name</label>
                        <input type="text" value="{{$student->info->name ?? ''}}" class="form-control course_name" disabled>
                    </div>
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Add Multiple Courses</label>
                        <select class="form-control " name="Courses[]" multiple style="width: 100%" required>
                            @foreach($allcourses as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn edit_save" value="{{$student->id}}" id="add_courses_btn">Add</button>
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
                <h5 class="modal-title" id="staticBackdropLabel">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Course Name</label>
                        <input type="text" class="form-control course_name" disabled>
                    </div>
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Select Other Course Name</label>
                        <div class="course_edit"></div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn edit_save" id="update_course_btn">Save</button>
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
                    <div class="mb-1">
                        <label class="form-label">When will you start this course?</label>
                        <input type="date" value="" class="form-control course_start_date"  id="course_start_date" name="course_start_date">
                        <p class=""></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn edit_save save_comment" data-id="" value="{{$student->id}}">Add</button>
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
        var row = $(this).closest('tr');
        var val = row.find('.complete_status_val').text();
        // alert(start_date);
        var corse_rw_id = row.find('.course_row_id').val();
        $('body').find('.course_row_idd').val(corse_rw_id);
        var updated_row_id = row.find('.edit_id').val();
        $('.save_comment').data('id',updated_row_id);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            data:{ val : val, updated_row_id : updated_row_id},
            url: "{{ route('complete_status') }}",
            type: "POST",
            dataType: "json",
            success: function (data) {
                if(val == 'In-Complete'){
                    $('#comment_modal').modal('show');
                }else{
                    console.log($('#course_start_date').val());
                    // location.reload();
                }
                // toastr.success("Status Updated Successfully");
                // location.reload();

            }
        });
    })
    $('.accepted_status a').on('click', function(e){
        e.preventDefault();

        var val = $(this).text();
        var row = $(this).closest('tr');
        var updated_row_id = row.find('.edit_id').val();
        row.find('.accepted_status_val').text(val);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            data:{ val : val, updated_row_id : updated_row_id},
            url: "{{ route('accepted_status') }}",
            type: "POST",
            dataType: "json",
            success: function (data) {
                toastr.success("Status Updated Successfully");
            }
        });
    })
    $('.save_comment').on('click', function(e){
        e.preventDefault();
        var student_id = $(this).val();
        var id = $(this).data(id);
        var val = $('.comment_textarea').val();
        var course_rw_id = $('.course_row_idd').val();
        var start_date =$('#course_start_date').val();
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
                data:{ val : val, student_id : student_id, course_rw_id : course_rw_id,course_start_date:start_date,id:id},
                url: "{{ route('save_course_comment') }}",
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
</script>
<script>
    $(document).ready(function() {
        // Initialize Select2 select box
        $("select[name=\"validation-select2\"]").select2({
            allowClear: true,
            placeholder: "Select gear...",
        }).change(function() {
            $(this).valid();
        });
        // Initialize Select2 multiselect box
        $("select[name=\"Courses[]\"]").select2({
            placeholder: "Select Courses...",
        }).change(function() {
            $(this).valid();
        });
    });

    // Save course Request
    $(document).on("click", "#add_courses_btn", function (e) {
        e.preventDefault();
        var student_id = $(this).val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            data: $("#add_courses_form").serialize() + "&student_id=" + student_id,
            url: "{{ route('save_courses') }}",
            type: "POST",
            dataType: "json",
            success: function (data) {
                toastr.success("Record Added Successfully");
                setInterval(function () {
                    location.reload();
                }, 1000);
            }
        });
    });
    // // update course Request
    $(document).on("click", "#update_course_btn", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var updated_id = $('.updated_course_id').val();
        var row = $(this).closest('tr');
        var row_id = $('.updated_row_id').val();

        $.ajax({
            data: {updated_id:updated_id,row_id:row_id},
            url: "{{ route('update_course') }}",
            type: "POST",
            dataType: "json",
            success: function (data) {
                toastr.success("Record Updated Successfully");
                $('.updated_course_id').val('');
                $('.updated_row_id').val('');
                setInterval(function () {
                    location.reload();
                }, 1000);
            }
        });
    });
    // // Edit Task Request
    $(document).on("click", "#edit_task_btn", function (e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        var edit_id = row.find('.edit_id').val();
        $('.updated_row_id').val(edit_id);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            data: {edit_id:edit_id},
            url: "{{ route('edit_course') }}",
            type: "GET",
            dataType: "json",
            success: function (response) {
                $('.course_name').val(response[0]);
                var data = '<select class="form-control" onchange="getCourse(this)"><option disabled selected value>Select Other Course</option>';
                $.each(response[1], function (index, el) {
                    data +="<option value='"+el.id+"'>" + el.name + "</option>";
                });
                data += '</select>';
                $('.course_edit').html(data);
                $("#edit_task").modal("show");
            }
        });
    });
    function getCourse(val) {
        var name = val.options[val.selectedIndex].text;
        $('.course_name').val(name);
        $('.updated_course_id').val(val.value);
    }
</script>
@endsection
