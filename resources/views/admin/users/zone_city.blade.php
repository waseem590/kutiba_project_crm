@extends('admin.master')

@section('content')
<div class="students-List-section mm-task-list">
    <h1 class="students-list-hed" style="display: inline-block;">Add City and Timezone</h1>
    <button class="btn edit_save float-right" class="img-fluid edit-icon" data-bs-toggle="modal"
        data-bs-target="#add_task">Add Timezone</button>
    <div class="table-responsive">
        <table id="example" class="table table-bordered">
            <thead class="s-list-thead">
                <tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">City</th>
                    <th scope="col">TimeZone</th>
                    <th scope="col" class="custem-text-center">Action</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                <input style="display: none;" class="updated_course_id">
                <input style="display: none;" class="updated_row_id">
                @if(count($zone_cities)>0)

                @foreach ($zone_cities as $city)
                <tr>
                    <th scope="row" class="w-60">{{$loop->iteration}}</th>
                    <?php $city_name = \App\Models\DropdownType::find($city->dropdown_types_id) ?>
                    <td>{{$city_name->name}}</td>
                    <td>{{$city->timezone}}</td>
                  
                    <td class="custem-text-center std-list-icon">
                        <!-- <a class="edit-list-icons edit_timezone" href="{{ route('update.zone.city', $city->id) }}" data-bs-toggle="modal" data-bs-target="#edit_timezone">
                            <img src="{{ asset('admin/images/edit-std.png')}}" alt="edit-std" class="img-fluid" />
                        </a> -->
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            class="edit-list-icons" onclick="deleteRecord({{$city->id}},'/delete_zone_city/')"><img
                                src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std"
                                class="img-fluid" /></a>
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
                <h5 class="modal-title" id="staticBackdropLabel">Select Timezone and City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('store.zone.city')}}" id="add_courses_form">
                @csrf
                <div class="modal-body">
                <div class="mb-3 error-placeholder">
                        <label class="form-label">City</label>
                        <select class="form-control" name="name" id="timezone-offset" class="span5">
                        @if(!empty($cities))
                        @foreach($cities as $city)    
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                        @endif
                        </select>
                    </div>
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">TimeZone</label>
                        <select class="form-control" name="timezone" id="timezone-offset" class="span5">
                            <option value="+03:00">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
                            <option value="+10:00">(GMT +10:00) Melbourne VIC, Australia</option>
                            <option value="+08:00">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
                            <option value="+05:30">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
                            <option value="+07:00">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn edit_save" value=""
                        id="add_courses_btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Task Model -->
<!-- Add Edit Timezone Modal -->
<div class="modal fade" id="edit_timezone" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Select Timezone and City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="#" id="update_timezone_form">
                @csrf
                <div class="modal-body">
                <div class="mb-3 error-placeholder">
                        <label class="form-label">City</label>
                        <select class="form-control" name="name" id="timezone-offset" class="span5">
                        @if(!empty($cities))
                        @foreach($cities as $city)    
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                        @endif
                        </select>
                    </div>
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">TimeZone</label>
                        <select class="form-control" name="timezone" id="timezone-offset" class="span5">
                            <option value="+03:00">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
                            <option value="+11:00">(GMT +11:00) Melbourne VIC, Australia</option>
                            <option value="+08:00">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
                            <option value="+05:50">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
                            <option value="+07:00">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn edit_save" value=""
                        id="add_courses_btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Task Model -->
@include('admin.modals.deleteModal')
@endsection

@section('scripts')
    <script>
        $('.edit_timezone').on('click',function(e){
            e.preventDefault();
            var update_url = $(this).attr('href');
            $('#update_timezone_form').attr('action',update_url);
        });
    </script>
@endsection