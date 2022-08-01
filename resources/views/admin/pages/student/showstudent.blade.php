@extends('admin.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/jquery.datetimepicker.css') }}" />
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
#spans{
    font-family: "robotomedium";
    font-size: 14px;
    color: #5a5a5a;
    margin-left: 14px;
}

#spans2{
        display: inline-block;
    padding-left: 12px;
    line-height: 17px;
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

        #preview img {
            width: 100px !important;
            height: 100px !important;
            margin: 2px !important;
        }

        /* Radio toggle button */
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #8f54a0;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #8f54a0;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        /* table for heading */
        .heading-table .li-switch{
            margin: 20px 0;
            text-align: center;
        }
    </style>
@endpush
@section('content')
    <div class=" students-List-section list-of-stds">
        <div class="mm-add-std-top-social">
            <!-- <h1 class="page-heading">Add Student</h1> -->
            <div class="list-std-btns">
                <a class="edit-bg" href="{{ route('student.edit', $user->id) }}"><i class="fas fa-pen"></i> &nbsp; Edit</a>
                <a class="del-bg" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                    onclick="deleteRecord({{ $user->id }},'/student/')"><i class="fas fa-trash"></i> &nbsp; Delete</a>
                <a href="{{ route('studentlists') }}"><i class="fas fa-step-backward"></i> &nbsp; Back</a>
            </div>
            <div class="std-detail_list float-right">

                <!-- <a class="std-detail_btns white-bg" href="https://api.whatsapp.com/send?phone={{ $user->contact->contact_number ?? '' }}" target="_blank" title="Whatsapp"> <i class="fab fa-whatsapp"></i>
                                                    &nbsp;<span>Whatsapp</span> </a> -->

                <a class="std-detail_btns white-bg sms" href="{{ $user->info->name ?? '' }}" title="SMS"
                    data-bs-toggle="modal" data-bs-target="#sms-modal" data-id="{{ $user->id }}"><i
                        class="fas fa-comment"></i>
                    &nbsp;<span>SMS</span>
                    <input type="hidden" class="first_contact_num" value="{{ $user->contact->contact_number ?? '' }}">
                    <input type="hidden" class="second_contact_num"
                        value="{{ $user->contact->secondary_contact_number ?? '' }}">
                </a>

                <a class="std-detail_btns white-bg"
                    href="mailto:{{ $user->contact->email ?? '' }}?subject={{ $user->id }}-{{ $user->info->surname ?? '' }} {{ $user->info->name ?? '' }}"
                    title="Student"> <i class="fas fa-envelope"></i> &nbsp;<span>Student</span></a>

                <a class="std-detail_btns white-bg"
                    href="@if ($user->role_counsellor) mailto:{{ $user->role_counsellor['email'] }}?subject={{ $user->id }}-{{ $user->info->surname }} {{ $user->info->name }}@else # @endif"
                    tiltle="Counselor"><i class="fas fa-envelope"></i> &nbsp;<span>Counsellor</span></a>


                <a class="std-detail_btns white-bg"
                    href="@if ($user->role_admission) mailto:{{ $user->role_admission['email'] }}?subject={{ $user->id }}-{{ $user->info->surname }} {{ $user->info->name }} @else # @endif"
                    tiltle="admission officer"><i class="fas fa-envelope"></i> &nbsp;<span>Admission</span></a>

                {{-- @can('add application')
                    <a class="std-detail_btns white-bg" href="{{ route('application', $user->id) }}" title="Add Application"
                        id="add_application" data-id="{{ $user->id }}"> <i class="fas fa-plus-circle"></i>
                        &nbsp;<span>Application</span> </a>
                @endcan --}}
                <!-- <a class="std-detail_btns gray-bg" href="#" title="Status Application"><i class="fas fa-list-alt"></i> &nbsp;<span>Status</span></a> -->
                <!-- <a class="std-detail_btns blue-bg" href="{{ route('visa.list', $user->id) }}" title="Add Visa"><i class="fas fa-plus-circle"></i>  &nbsp;Visa</a> -->
                <a class="std-detail_btns white-bg" href="{{ route('accomodation', $user->id) }}"
                    title="Accommodation">Accommodation</a>
                <a class="std-detail_btns white-bg" href="#" data-bs-toggle="modal" data-bs-target="#add_task">
                    &nbsp;New Task</a>
                <!-- <a class="std-detail_btns yellow-bg" href="{{ route('student.edit', $user->id) }}">
                                                <img src="{{ asset('admin/images/edit-std.png') }}" alt="edit-std" class="img-fluid">
                                                </a> -->
                <!-- <a class="std-detail_btns white-bg" href="{{ route('course', $user->id) }}" title="Add Courses"> <i class="fas fa-plus-circle"></i> &nbsp;<span>Courses</span> </a> -->
                <!-- <a class="std-detail_btns darkblue-bg" href="#"> &nbsp;Attachment</a> -->
                <a class="std-detail_btns white-bg" data-bs-toggle="modal" data-bs-target="#add_attachment">
                    &nbsp;Attachment</a>
                <a href="{{ route('user.application_logs', $user->id) }}" class="std-detail_btns white-bg" >
                    &nbsp;View Log</a>
                {{-- <a class="std-detail_btns white-bg" data-bs-toggle="modal" data-bs-target="#view_log" id="view_log">
                    &nbsp;View Log</a> --}}

                @can('delete student')
                    <!-- <a class="std-detail_btns pink-bg" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteRecord({{ $user->id }},'/student/')">Delete</a> -->
                @endcan

            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <table class="table heading-table">
                    <tr>
                        <td>
                            <li class="breadcrumb-item active " id="heading-div" aria-current="page">
                                <h2 class="page-hed-pt page-heading">Student Detail</h2>
                            </li>
                        </td>
                        <td>
                            <li class="li-switch">
                                <label class="switch" id="switch-div">
                                    <input type="checkbox" title="toggle to show/hide application form">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                        </td>
                    </tr>
                </table>


            </ol>
        </nav>
        <div class="div-display-data" id="div-display-data">

            <div class="list-of-student-inner list-std1">
                <div class="row">
                    <div class="col-xl-4 col-lg-6">
                        <h3>Office: </h3>
                        <span  id="spans">
                            @if (!empty($dropdown[0]->dropdownType))
                                @foreach ($dropdown[0]->dropdownType as $val)
                                    @if ($val->id == $user->office)
                                        {{ $val->name }}
                                    @endif
                                @endforeach
                            @endif
                        </span>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <h3>Counsellor: </h3>
                        <span  id="spans">
                            @foreach ($counsellor as $val)
                                @if ($val->id == $user->counsellor)
                                    {{ $val->name }}
                                @endif
                            @endforeach
                        </span>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <h3>Admission Officer: </h3>
                        <span  id="spans">
                            @foreach ($admission_officer as $val)
                                @if ($val->id == $user->admission_officer)
                                    {{ $val->name }}
                                @endif
                            @endforeach
                        </span>
                    </div>
                </div>
            </div>
            <h6 class="page-hed-pt">Student Information</h6>
            <div class="list-of-student-inner list-std2">

                <div class="row">
                    <!-- <div class="col-xl-4 col-lg-6">
                                                        <h3>Surname: </h3>
                                                        <span id="spans">{{ $user->info->surname ?? '' }}</span>
                                                    </div> -->
                    <div class="col-xl-4 col-lg-6">
                        <h3 style="white-space:nowrap">Name: </h3>
                        <span  id="spans">{{ $user->info->name ?? '' }}</span>
                        <input type="hidden" value="{{ $user->id }}">
                    </div>

                    <div class="col-xl-4 col-lg-6">
                        <h3>Date of Birth: </h3>
                        <span  id="spans">{{ date('M d, Y', strtotime($user->info->dob ?? '')) }}</span>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <h3>Gender: </h3>
                        <span  id="spans">{{ $user->info->gender ?? '' }}</span>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <h3>Nationality: </h3>
                        <span  id="spans">
                            @if (!empty($user->info->nationality))
                                @foreach ($countries as $country)
                                    @if ($country->id == $user->info->nationality)
                                        {{ $country->name }}
                                    @endif
                                @endforeach
                            @endif
                        </span>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <h3>Student visa: </h3>
                        <span  id="spans">{{ $user->info->visa ?? '' }} </span>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-12">
                        <div class="mm-notes w-100  ">
                            <h3>Note: </h3>
                           &nbsp; <span id="spans"  data-toggle="modal" data-target="#myModal">{{ $user->info->note ?? '' }}</span>
                        
                        </div>

                    </div>

                </div>
            </div>
            <h6 class="page-hed-pt">Contact Details</h6>

            <div class="list-of-student-inner list-std3">
                @if (!empty($user->contact))
                    <div class="custom_row">
                        <div class=" custom-column">
                            <h3>Email address: </h3>
                            <span data-toggle="modal" data-target="#myModal"
                                class="mm-mail-list">{{ $user->contact->email ?? '' }}</span>
                        </div>
                        <div class=" custom-column">
                            <h3>Secondary Email address: </h3>
                            <span data-toggle="modal" data-target="#myModal"
                                class="mm-mail-list">{{ $user->contact->secondary_email ?? '' }}</span>
                        </div>
                        <div class=" custom-column">
                            <h3>Contact number1: </h3>
                            <span class="mm-mail-list">{{ $user->contact->contact_number ?? '' }}</span>
                        </div>
                        <div class=" custom-column">
                            <h3>Contact number2: </h3>
                            <span class="mm-mail-list">{{ $user->contact->secondary_contact_number ?? '' }} </span><br>
                        </div>
                    </div>
                @endif

                <div class="w-100">
                    <h3 class="cust-h3-mb List_hed">Address Details 1: </h3>
                    <span id="spans"> </span>
                </div>
                @if (!empty($user->contact))
                    <div class="custom_row">
                        <div class=" custom-column">
                            <h3>Street address: </h3>
                            <span id="spans">{{ $user->contact->street_address ?? '' }}</span>
                        </div>
                        <div class=" custom-column">
                            <h3>Suburb: </h3>
                            <span id="spans">{{ $user->contact->suburb ?? '' }}</span>
                        </div>
                        <div class=" custom-column">
                            <h3>State: </h3>
                            <span id="spans">{{ $user->contact->state ?? '' }} </span>
                        </div>
                        <div class=" custom-column">
                            <h3>Post code: </h3>
                            <span id="spans">{{ $user->contact->post_code ?? '' }}</span>
                        </div>
                        <div class=" custom-column">
                            <h3>Country: </h3>
                            <span id="spans">
                                @foreach ($countries as $country)
                                    @if ($country->id == $user->contact->country)
                                        {{ $country->name }}
                                    @endif
                                @endforeach
                            </span>
                        </div>

                    </div>
                @endif

            </div>
            <h6 class="page-hed-pt">Other Information</h6>
            <div class="list-of-student-inner list-std4">
                <div class="row">
                    @if (!empty($user->otherInfo))
                        <div class="col-xl-4 col-lg-6">
                            <h3>Type of Funding: </h3>
                            <span id="spans">
                                @if (!empty($dropdown[1]->dropdownType))
                                    @foreach ($dropdown[1]->dropdownType as $val)
                                        @if ($val->id == $user->otherInfo->funding_type ?? '')
                                            {{ $val->name }}
                                        @endif
                                    @endforeach
                                @endif
                            </span>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <h3>Name of sponsor: </h3>
                            <span id="spans">
                                @if (!empty($dropdown[2]->dropdownType))
                                    @foreach ($dropdown[2]->dropdownType as $val)
                                        @if ($val->id == $user->otherInfo->sponsor_name)
                                            {{ $val->name }}
                                        @endif
                                    @endforeach
                                @endif
                            </span>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <h3>Student source: </h3>
                            <span id="spans">
                                @if (!empty($dropdown[3]->dropdownType))
                                    @foreach ($dropdown[3]->dropdownType as $val)
                                        @if ($val->id == $user->otherInfo->student_source)
                                            {{ $val->name }}
                                        @endif
                                    @endforeach
                                @endif
                            </span>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <h3>Cohort: </h3>
                            <span id="spans">{{ isset($user->otherInfo->cohort_name) ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <h3>Name of Cohort: </h3>
                            <span id="spans">
                                @if (!empty($dropdown[4]->dropdownType))
                                    @foreach ($dropdown[4]->dropdownType as $val)
                                        @if ($val->id == $user->otherInfo->cohort_name)
                                            {{ $val->name }}
                                        @endif
                                    @endforeach
                                @endif
                            </span>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <h3>Name of Partner: </h3>
                            <span id="spans">
                                @if (!empty($dropdown[17]->dropdownType))
                                    @foreach ($dropdown[17]->dropdownType as $val)
                                        @if ($val->id == $user->otherInfo->partner)
                                            {{ $val->name }}
                                        @endif
                                    @endforeach
                                @endif
                            </span>
                        </div>
                    @endif
                    <div class="col-xl-4 col-lg-6">

                    </div>
                </div>
            </div>
            {{-- <h1 class="page-heading page-hed-pt" style="margin-top: 50px;">Comments</h1>
            <div class="list-of-student-inner list-std4">
                <div class="row">
                    <div class="col-lg-12 comment_div">
                        @if (!empty($comments))
                        @foreach ($comments as $val)
                        <div>
                            <span id="spans">
                                <img class="main-logo img-fluid" src="{{ asset('admin/images/'.$val->user->profile_photo )}}" alt="" />
                                {{$val->user->name ?? ''}}
                                @if ($val->user_id == auth()->user()->id)
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$val->id}},'/delete_comment/')"
                                    ><img
                                        src="{{ asset('admin/images/list-delet-std.png')}}"
                                        alt="edit-std"
                                        class="img-fluid"
                                /></a>
                                @endif
                            </span>
                            <span id="spans">{{$val->comment_text ?? ''}}</span>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="col-lg-12">
                        <form method="POST" action="{{route('save_comment')}}" id="">
                            @csrf
                            <textarea class="form-control comment_textarea" name="text_area" rows="2" placeholder="Write Comment" required></textarea>
                            <input type="hidden" name="student_id" value="{{$user->id}}">
                            <button class="comment_btn" type="submit">Add Comment</button>
                        </form>
                    </div>
                </div>
            </div> --}}
            <div class="d-flex justify-content-end">

                <div class="list-std-btns mt-4">
                    <a class="edit-bg" href="{{ route('student.edit', $user->id) }}"><i class="fas fa-pen"></i> &nbsp;
                        Edit</a>
                    <a class="del-bg" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                        onclick="deleteRecord({{ $user->id }},'/student/')"><i class="fas fa-trash"></i> &nbsp;
                        Delete</a>
                    <a href="{{ route('studentlists') }}"><i class="fas fa-step-backward"></i> &nbsp; Back</a>
                </div>
            </div>
            {{-- Tasks --}}
            <div class="mm-visible table-responsive">
                <h4 class="text-capitalize">Task List</h4>
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
                        <input style="display: none;" value="{{ $id ?? '' }}" class="student_id">
                        <input style="display: none;" class="rowIdForComment">
                        @php
                            $authUser = App\Models\User::find(auth()->user()->id);
                            $authUserRole = $authUser->getRoleNames()[0];
                        @endphp
                        @if ($authUserRole == 'Counsellor')
                            @foreach ($tasks as $item)
                                @php
                                    $user = App\Models\User::find($item->created_users_id);
                                    $userRole = $user->getRoleNames()[0];
                                @endphp
                                @if ($item->created_users_id == auth()->user()->id || $userRole == 'Admissions')
                                    <tr>

                                        <th scope="row" class="w-60">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td>{{ $item->task_name ?? '' }}</td>
                                        <td>{{ date('M d, Y', strtotime($item->date ?? '')) }}</td>
                                        <td class="complete_status_val">{{ $item->status ?? '' }}</td>
                                        <td class="custem-text-center std-list-icon">
                                            <a href="{{ route('showTaskComments', $item->id . '/' . $id) }}"
                                                class="edit-list-icons comment_icon"><i class="fas fa-comment"></i></a>
                                            <a href="{{ route('edit_task', $item->id) }}" class="edit-list-icons"
                                                id="edit_task_btn"><img src="{{ asset('admin/images/edit-std.png') }}"
                                                    alt="edit-std" class="img-fluid" /></a>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" class="edit-list-icons"
                                                onclick="deleteRecord({{ $item->id }},'/delete_task/')"><img
                                                    src="{{ asset('admin/images/list-delet-std.png') }}" alt="edit-std"
                                                    class="img-fluid" /></a>
                                            @if (auth()->user()->getRoleNames()[0] != 'Master User')
                                                @can('add comment on tasks')
                                                    <div style="display: inline-block;">
                                                        <input class="complete_status" type="checkbox"
                                                            @if (isset($item->status) && $item->status == 'Complete') ? checked : '' @endif>
                                                    </div>
                                                @endcan
                                            @endif
                                            <input type="hidden" value="{{ $item->id ?? '' }}" class="edit_id">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif

                        @if ($authUserRole == 'Management')
                            @foreach ($tasks as $item)
                                @php
                                    $user = App\Models\User::find($item->created_users_id);
                                    $userRole = $user->getRoleNames()[0];
                                @endphp
                                @if ($userRole == 'Finance')
                                    <tr>

                                        <th scope="row" class="w-60">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td>{{ $item->task_name ?? '' }}</td>
                                        <td>{{ date('M d, Y', strtotime($item->date ?? '')) }}</td>
                                        <td class="complete_status_val">{{ $item->status ?? '' }}</td>
                                        <td class="custem-text-center std-list-icon">
                                            <a href="{{ route('showTaskComments', $item->id . '/' . $id) }}"
                                                class="edit-list-icons comment_icon"><i class="fas fa-comment"></i></a>
                                            <a href="{{ route('edit_task', $item->id) }}" class="edit-list-icons"
                                                id="edit_task_btn"><img src="{{ asset('admin/images/edit-std.png') }}"
                                                    alt="edit-std" class="img-fluid" /></a>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" class="edit-list-icons"
                                                onclick="deleteRecord({{ $item->id }},'/delete_task/')"><img
                                                    src="{{ asset('admin/images/list-delet-std.png') }}" alt="edit-std"
                                                    class="img-fluid" /></a>
                                            <input type="hidden" value="{{ $item->id ?? '' }}" class="edit_id">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif


                        @if ($authUserRole == 'Admissions' || $authUserRole == 'Finance')
                            @foreach ($tasks as $item)
                                @if ($item->created_users_id == auth()->user()->id)
                                    <tr>

                                        <th scope="row" class="w-60">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td>{{ $item->task_name ?? '' }}</td>
                                        <td>{{ date('M d, Y', strtotime($item->date ?? '')) }}</td>
                                        <td class="complete_status_val">{{ $item->status ?? '' }}</td>
                                        <td class="custem-text-center std-list-icon">
                                            <a href="{{ route('showTaskComments', $item->id . '/' . $id) }}"
                                                class="edit-list-icons comment_icon"><i class="fas fa-comment"></i></a>
                                            <a href="{{ route('edit_task', $item->id) }}" class="edit-list-icons"
                                                id="edit_task_btn"><img src="{{ asset('admin/images/edit-std.png') }}"
                                                    alt="edit-std" class="img-fluid" /></a>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" class="edit-list-icons"
                                                onclick="deleteRecord({{ $item->id }},'/delete_task/')"><img
                                                    src="{{ asset('admin/images/list-delet-std.png') }}" alt="edit-std"
                                                    class="img-fluid" /></a>
                                            @if (auth()->user()->getRoleNames()[0] != 'Master User')
                                                @can('add comment on tasks')
                                                    <div style="display: inline-block;">
                                                        <input class="complete_status" type="checkbox"
                                                            @if (isset($item->status) && $item->status == 'Complete') ? checked : '' @endif>
                                                    </div>
                                                @endcan
                                            @endif
                                            <input type="hidden" value="{{ $item->id ?? '' }}" class="edit_id">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif



                        @if (auth()->user()->hasRole('Master User') == true)
                            @foreach ($tasks as $item)
                                <tr>

                                    <th scope="row" class="w-60">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td>{{ $item->task_name ?? '' }}</td>
                                    <td>{{ date('M d, Y', strtotime($item->date ?? '')) }}</td>
                                    <td class="complete_status_val">{{ $item->status ?? '' }}</td>
                                    <td class="custem-text-center std-list-icon">
                                        <a href="{{ route('showTaskComments', $item->id . '/' . $id) }}"
                                            class="edit-list-icons comment_icon"><i class="fas fa-comment"></i></a>
                                        <a href="{{ route('edit_task', $item->id) }}" class="edit-list-icons"
                                            id="edit_task_btn"><img src="{{ asset('admin/images/edit-std.png') }}"
                                                alt="edit-std" class="img-fluid" /></a>
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="edit-list-icons"
                                            onclick="deleteRecord({{ $item->id }},'/delete_task/')"><img
                                                src="{{ asset('admin/images/list-delet-std.png') }}" alt="edit-std"
                                                class="img-fluid" /></a>
                                        @if (auth()->user()->getRoleNames()[0] != 'Master User')
                                            @can('add comment on tasks')
                                                <div style="display: inline-block;">
                                                    <input class="complete_status" type="checkbox"
                                                        @if (isset($item->status) && $item->status == 'Complete') ? checked : '' @endif>
                                                </div>
                                            @endcan
                                        @endif
                                        <input type="hidden" value="{{ $item->id ?? '' }}" class="edit_id">
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>

            </div>
            {{-- Tasks end --}}

            <!-- applications -->
            <div class="mm-visible table-responsive">
                <h4 class="text-capitalize">Application List</h4>

               <table id="example" class="table table-bordered table-responsive-md table-responsive-lg">

            <thead class="s-list-thead">
                <tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Study Destination</th>
                    <th scope="col">Institution Name</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="custem-text-center">Action</th>
                </tr>
                </tr>
            </thead>
            <tbody>

                @foreach ($applications as $item)
                <tr>
                    <th scope="row" class="w-60">
                        {{$loop->iteration}}
                    </th>
                    <td   id="spans">
                        @if(!empty($dropdown[5]->dropdownType))
                        @foreach($dropdown[5]->dropdownType as $val)
                        @if($val->id == $item->study_dest)
                        {{$val->name}}
                        @endif
                        @endforeach
                        @endif
                    </td>
                    <td  id="spans">
                        @if(!empty($dropdown[6]->dropdownType))
                        @foreach($dropdown[6]->dropdownType as $val)
                        @if($val->id == $item->inst_name)
                        {{$val->name}}
                        @endif
                        @endforeach
                        @endif
                    </td>
                    <td class="status_td"  id="spans">{{$item->status ?? ''}}</td>
                    <td class="custem-text-center std-list-icon">

                        <a href="{{ route('edit_application',$item->id)}}" class="edit-list-icons"><img
                                src="{{ asset('admin/images/edit-std.png')}}" alt="edit-std" class="img-fluid" /></a>
                        <a href="{{ route('view_application',$item->id)}}" class="edit-list-icons"><img
                                src="{{ asset('admin/images/list-icon-std.png')}}" alt="edit-std"
                                class="img-fluid" /></a>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            class="edit-list-icons"
                            onclick="deleteRecord({{$item->id}},'/users/delete_application/')"><img
                                src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std"
                                class="img-fluid" /></a>

                        <?php $tuition_fee = filter_var($item->tuition_fee, FILTER_SANITIZE_NUMBER_INT); ?>

                        <div class="dropdown" style="display: inline-block;">
                            <button class="btn tbl-dropdown dropdown-toggle status_dropdown" title="Status"
                                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" value="{{$item->id}}">

                            </button>
                            <div class="dropdown-menu dropdown status" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Submitted</a>
                                <a class="dropdown-item" href="#">Information Requested</a>
                                <a class="dropdown-item" href="#">Information Provided</a>
                                <a class="dropdown-item" href="#">Offered</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#RejecteddModal"
                                    href="#">Rejected</a>
                                <a class="dropdown-item" href="#">Acceptance sent</a>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#AcceptanceModal">Acceptance Information Requested
                                </a>
                                <a class="dropdown-item" href="" >Acceptance Information provided</a>
                                <a class="dropdown-item" href="{{$tuition_fee}}"
                                    data-id="{{$item->start_date}}">Accepted</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#DeclineddModal"
                                    href="#">Declined</a>
                            </div>
                        </div>
                        <input type="hidden" value="{{$item->id ?? ''}}" class="app_id">
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
                <hr>
                @role('Master User')
                    @if (count($trashed) > 0)
                        <h4 class="text-capitalize">Deleted Applications</h4>

                        <table id="example" class="table table-bordered table-responsive-md table-responsive-lg">

                            <thead class="s-list-thead">
                                <tr>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Study Destination</th>
                                    <th scope="col">Institution Name</th>
                                    <th scope="col">Status</th>
                                    {{-- <th scope="col" class="custem-text-center">Action</th> --}}
                                </tr>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($trashed as $item)
                                    <tr>
                                        <th scope="row" class="w-60">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td  style="">
                                            @if (!empty($dropdown[5]->dropdownType))
                                                @foreach ($dropdown[5]->dropdownType as $val)
                                                    @if ($val->id == $item->study_dest)
                                                        {{ $val->name }}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($dropdown[6]->dropdownType))
                                                @foreach ($dropdown[6]->dropdownType as $val)
                                                    @if ($val->id == $item->inst_name)
                                                        {{ $val->name }}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="status_td">{{ $item->status ?? '' }}</td>
                                        <td class="custem-text-center std-list-icon">

                                            {{-- <a href="{{ route('edit_application', $item->id) }}" class="edit-list-icons"><img
                                                    src="{{ asset('admin/images/edit-std.png') }}" alt="edit-std"
                                                    class="img-fluid edit-application" data-id="{{ $item->id }}" /></a> --}}
                                            {{-- <a href="{{ route('view_application', $item->id) }}" class="edit-list-icons"><img
                                                    src="{{ asset('admin/images/list-icon-std.png') }}" alt="view-std"
                                                    class="img-fluid" /></a> --}}
                                            {{-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                class="edit-list-icons"
                                                onclick="deleteRecord({{ $item->id }},'/users/delete_application/')"><img
                                                    src="{{ asset('admin/images/list-delet-std.png') }}" alt="edit-std"
                                                    class="img-fluid" /></a> --}}

                                            {{-- <?php //$tuition_fee = filter_var($item->tuition_fee, FILTER_SANITIZE_NUMBER_INT);
                                            ?> --}}

                                            {{-- <div class="dropdown" style="display: inline-block;">
                                                <button class="btn tbl-dropdown dropdown-toggle status_dropdown"
                                                    title="Status" type="button" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    value="{{ $item->id }}">

                                                </button>
                                                <div class="dropdown-menu dropdown status"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Submitted</a>
                                                    <a class="dropdown-item" href="#">Information Requested</a>
                                                    <a class="dropdown-item" href="#">Information Provided</a>
                                                    <a class="dropdown-item" href="#">Offered</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#RejecteddModal" href="#">Rejected</a>
                                                    <a class="dropdown-item" href="#">Acceptance sent</a>
                                                    <a class="dropdown-item" href="#"
                                                        data-id="{{ $item }}">Acceptance
                                                        Information Requested
                                                    </a>
                                                    <a class="dropdown-item" href="">Acceptance Information
                                                        provided</a>
                                                    <a class="dropdown-item" href="{{ $tuition_fee }}"
                                                        data-id="{{ $item->start_date }}">Accepted</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#DeclineddModal" href="#">Declined</a>
                                                </div>
                                            </div> --}}
                                            <input type="hidden" value="{{ $item->id ?? '' }}" class="app_id">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endrole
            </div>
            <!-- applications end -->
        </div>
        <div class="div-app-form pt-3 d-none" id="div-app">
            {{-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <h2 class="page-hed-pt page-heading">Application Form</h2>
                    </li>
                </ol>
            </nav> --}}
            <form class="add-application-form list-of-student-inner" action="{{ route('save_application') }}"
                method="post" id="add_application_form">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="custom-padd-right">
                            <label for="study-destination" class="tab-inner-label">Study
                                Destination</label>
                            <select name="destination" class="form-control1 form-control select-inner-text"
                                id="study-destination">
                                <option disabled selected value>
                                    Select Study Destination
                                </option>
                                @if (!empty($dropdown[5]->dropdownType))
                                    @foreach ($dropdown[5]->dropdownType as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                @endif

                            </select>
                            <input type="hidden" name="user_id" value="{{ $id ?? '' }}">

                            <input type="hidden" id="applications_id" name="applications_id">
                            <input type="hidden" id="special_education_id" name="special_education_id">
                            <input type="hidden" id="education_id" name="education_id">
                        </div>
                    </div>
                    <div class="form-group col-sm-6 custom-padd">
                        <div class="custom-padd-left">
                            <label for="institute-name" class="tab-inner-label">Institution
                                Name</label>
                            <select name="institute_name" class="form-control1 form-control select-inner-text"
                                id="institute-name">
                                <option disabled selected value>
                                    Select Institute Name
                                </option>
                                @if (!empty($dropdown[6]->dropdownType))
                                    @foreach ($dropdown[6]->dropdownType as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 d-flex" style="position: relative; top: 20px;">
                        <div class="custom-checkbox-1">
                            <label class="application_type" for="app">Application Type</label>
                        </div>

                        <!-- <div class="form-group-custom custom-checkbox-1 ml-3">
                                                                <input class="checkbox2" name="eng" type="checkbox" id="eng" />
                                                                <label for="eng">English</label>
                                                            </div> -->

                    </div>
                    <div class="form-group col-md-12 d-flex" style="position: relative; top: 20px;">
                        <!-- <div class="custom-checkbox-1">
                                                                <label class="application_type" for="app">Application Type</label>
                                                            </div> -->

                        <div class="form-group-custom custom-checkbox-1">
                            <input class="checkbox2" name="eng" type="checkbox" id="eng" />
                            <label for="eng">English</label>
                        </div>

                    </div>
                    <div class="form-group col-sm-6" id="eng-div">
                        <div class="custom-padd-right displayNone">
                            <label class="tab-inner-label" for="">Duration</label>
                            <input name="duration" type="number" class="form-control1 form-control select-inner-text" />
                        </div>
                    </div>
                    <div class="form-group col-sm-6 custom-padd" id="eng-date">
                        <div class="custom-padd-left displayNone2">
                            <label class="tab-inner-label" for="122">
                                Start Date</label>
                            <div class="date-container">
                                <input name="duration_start_date" type="text" id="datetimepicker5"
                                    class="form-control1 form-control select-inner-text " autocomplete="off" />
                            </div>

                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 custom-padd ">
                        <div class="custom-padd-right open-calender">
                            <div class="" id="certificate1-div">
                                <input class="mm-custom-input allcheckbox" type="checkbox" id="c1" />
                                <label class="form-group-custom2 custom-checkbox-1 " for="c1">Certificate
                                    1</label>
                                <div class="date-container displayNone">
                                    <input name="certificate1" type="text" id="datetimepicker6"
                                        class="form-control1 form-control select-inner-text" autocomplete="off" />
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-left" id="certificate2-div">
                                <input class="mm-custom-input" type="checkbox" id="c2" />
                                <label class="form-group-custom2 custom-checkbox-1" for="c2">Certificate
                                    2</label>
                                <div class="date-container displayNone">
                                    <input name="certificate2" type="text" id="datetimepicker2"
                                        class="form-control1 form-control select-inner-text" autocomplete="off" />

                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class="custom-padd-right open-calender">
                            <div class="" id="certificate3-div">
                                <input class="mm-custom-input" type="checkbox" id="c3" />
                                <label class="form-group-custom2 custom-checkbox-1" for="c3">Certificate
                                    3</label>
                                <div class="date-container displayNone">
                                    <input name="certificate3" type="text" id="datetimepicker3"
                                        class="form-control1 form-control select-inner-text" autocomplete="off" />
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-left" id="certificate4-div">
                                <input class="mm-custom-input" type="checkbox" id="c4" />
                                <label class="form-group-custom2 custom-checkbox-1" for="c4">Certificate
                                    4</label>
                                <div class="date-container displayNone">
                                    <input name="certificate4" type="text" id="datetimepicker4"
                                        class="form-control1 form-control select-inner-text" autocomplete="off" />
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class="custom-padd-right open-calender">
                            <div class="" id="foundation-div">
                                <input class="mm-custom-input" type="checkbox" id="c5" />
                                <label class="form-group-custom2 custom-checkbox-1" for="c5">Foundation</label>
                                <div class="date-container displayNone">
                                    <input type="text" name="foundation_date" id="datetimepicker5"
                                        class="form-control1 form-control select-inner-text" autocomplete="off" />
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class="custom-padd-left" id="associate_deg-div">
                            <input class="mm-custom-input" type="checkbox" id="c6" />
                            <label class="form-group-custom2 custom-checkbox-1" for="c6">Associate
                                Degree</label>
                            <div class="date-container displayNone">
                                <input type="text" name="associate_deg_date" id="datetimepicker6"
                                    class="form-control1 form-control select-inner-text" autocomplete="off" />
                            </div>
                        </div>


                    </div>
                </div>

                <div class="row" id="diploma-row">
                    <div class="form-group col-sm-6 ">
                        <div class="custom-padd-right" id="diploma-div">
                            <input class="mm-custom-input checkbox2" type="checkbox" id="c61">
                            <label class="form-group-custom2 custom-checkbox-1" for="c61">Diploma</label>
                            <div class=" displayNone">
                                <input type="text" name="diploma_name"
                                    class="form-control1 form-control select-inner-text" placeholder="Course Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-left displayNone2">
                                <label class="custom-checkbox-1 tab-inner-label" for="c7">Start
                                    Date</label>
                                <div class="date-container">
                                    <input type="text" name="diploma_start_date" id="datetimepicker7"
                                        class="form-control1 form-control select-inner-text" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="advance_diploma-row">
                    <div class="form-group col-sm-6 ">
                        <div class="custom-padd-right" id="advance_diploma-div">
                            <input class="mm-custom-input checkbox2" type="checkbox" id="c66">
                            <label class="form-group-custom2 custom-checkbox-1" for="c66">Advance
                                Diploma</label>
                            <div class="displayNone">
                                <input type="text" name="advance_diploma_name"
                                    class="form-control1 form-control select-inner-text" placeholder="Course Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-left displayNone2">
                                <input class="mm-custom-input" type="checkbox" id="c8">
                                <label class="custom-checkbox-1 tab-inner-label" for="c8">Start
                                    Date</label>
                                <div class="date-container">
                                    <input type="text" name="advance_diploma_date" id="datetimepicker8"
                                        class="form-control1 form-control select-inner-text" autocomplete="off">
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                <div class="row" id="bechelor_deg-row">
                    <div class="form-group col-sm-6 ">
                        <div class="custom-padd-right" id="bechelor_deg-div">
                            <input class="mm-custom-input checkbox2" type="checkbox" id="c10">
                            <label class="form-group-custom2 custom-checkbox-1" for="c10">Bechelor</label>
                            <div class="displayNone">
                                <input type="text" name="bechelor_deg_name"
                                    class="form-control1 form-control select-inner-text" placeholder="Course Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-left displayNone2">
                                <label class="custom-checkbox-1 tab-inner-label" for="c8">Start
                                    Date</label>
                                <div class="date-container">
                                    <input type="text" name="bechelor_deg_date" id="datetimepicker9"
                                        class="form-control1 form-control select-inner-text" autocomplete="off">
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                <div class="row" id="bechelor_honours-row">
                    <div class="form-group col-sm-6 ">
                        <div class="custom-padd-right" id="bechelor_honours-div">
                            <input class="mm-custom-input checkbox2" type="checkbox" id="c11">
                            <label class="form-group-custom2 custom-checkbox-1" for="c11">Bechelor
                                Honours</label>
                            <div class="displayNone">
                                <input type="text" name="bechelor_honours_name"
                                    class="form-control1 form-control select-inner-text" placeholder="Course Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-left displayNone2">
                                <label class="custom-checkbox-1 tab-inner-label" for="c8">Start
                                    Date</label>
                                <div class="date-container">
                                    <input type="text" name="bechelor_honours_date" id="datetimepicker10"
                                        class="form-control1 form-control select-inner-text" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row" id="graduate_diploma-row">
                    <div class="form-group col-sm-6 ">
                        <div class="custom-padd-right" id="graduate_diploma-div">
                            <input class="mm-custom-input checkbox2" type="checkbox" id="c12">
                            <label class="form-group-custom2 custom-checkbox-1" for="c12">Graduate
                                Diploma</label>
                            <div class="displayNone">
                                <input type="text" name="graduate_diploma_name"
                                    class="form-control1 form-control select-inner-text" placeholder="Course Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-left displayNone2">
                                <label class="custom-checkbox-1 tab-inner-label" for="c8">Start
                                    Date</label>
                                <div class="date-container">
                                    <input type="text" name="graduate_diploma_date" id="datetimepicker11"
                                        class="form-control1 form-control select-inner-text" autocomplete="off">
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                <div class="row" id="masters_degree-row">
                    <div class="form-group col-sm-6 ">
                        <div class="custom-padd-right" id="masters_degree-div">
                            <input class="mm-custom-input checkbox2" type="checkbox" id="c13">
                            <label class="form-group-custom2 custom-checkbox-1" for="c13">Master's
                                Degree</label>
                            <div class="displayNone">
                                <input type="text" id="masters_degree_name" name="master_deg_name"
                                    class="form-control1 form-control select-inner-text" placeholder="Course Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-left displayNone2">
                                <label class="custom-checkbox-1  tab-inner-label" for="c8">Start
                                    Date</label>
                                <div class="date-container">
                                    <input type="text" name="master_deg_date" id="datetimepicker13"
                                        class="form-control1 form-control select-inner-text" autocomplete="off">
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                <div class="row" id="doctoral_deg-row">
                    <div class="form-group col-sm-6 ">
                        <div class="custom-padd-right" id="doctoral_deg-div">
                            <input class="mm-custom-input checkbox2" type="checkbox" id="c14">
                            <label class="form-group-custom2 custom-checkbox-1" for="c14">Doctoral
                                Degree</label>
                            <div class="displayNone">
                                <input type="text" name="doctoral_deg_name"
                                    class="form-control1 form-control select-inner-text" placeholder="Course Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-left displayNone2">
                                <label class="custom-checkbox-1  tab-inner-label" for="c8">Start
                                    Date</label>
                                <div class="date-container">
                                    <input type="text" name="doctoral_deg_date" id="datetimepicker13"
                                        class="form-control1 form-control select-inner-text" autocomplete="off">
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-right" id="primary_school-div">
                                <input class="mm-custom-input" type="checkbox" id="c109">
                                <label class="form-group-custom2 custom-checkbox-1" for="c109">Primary
                                    School</label>
                                <div class="date-container displayNone">
                                    <input type="text" name="primary_school" id="datetimepicker14"
                                        class="form-control1 form-control select-inner-text" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-left" id="high_school-div">
                                <input class="mm-custom-input" type="checkbox" id="c17">
                                <label class="form-group-custom2 custom-checkbox-1" for="c17">High
                                    School</label>
                                <div class="date-container displayNone">
                                    <input type="text" name="high_school" id="datetimepicker15"
                                        class="form-control1 form-control select-inner-text" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-12 d-flex  student-form-action add-app-submit">
                    <button class="btn " href="#tabs-1">Submit</button>
                    <button class="btn bg-secondary border-0 text-white" id="cancel-edit">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Add Accepted Modal -->
    <div class="modal fade" id="accepted_status" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Change Application Date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('application_status') }}" id="application_accepted_modal">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 error-placeholder">
                            <label class="form-label">Select Date</label>
                            <input type="date" class="form-control accepted_date" name="change_date" value="">
                            <!-- <input type="number" class="form-control" name="tuition_fee" required> -->
                            <label class="form-label mt-3">Tuition Fee</label>
                            <div class="input-group">

                                <div class="input-group-prepend">

                                    <select id="currencyList" class="form-control" style="font-size: 15px;"
                                        name="sign">
                                        <option value="$" selected>$</option>
                                        <option value="₡">₡</option>
                                        <option value="₢">₢</option>
                                        <option value="₣">₣</option>
                                        <option value="₥">₥</option>
                                        <option value="₦">₦</option>
                                        <option value="₧">₧</option>
                                        <option value="₨">₨</option>
                                        <option value="₩">₩</option>
                                        <option value="₪">₪</option>
                                        <option value="₫">₫</option>
                                        <option value="€">€</option>
                                        <option value="₭">₭</option>
                                        <option value="₮">₮</option>
                                        <option value="₯">₯</option>
                                        <option value="₰">₰</option>
                                        <option value="₱">₱</option>
                                        <option value="₲">₲</option>
                                        <option value="₳">₳</option>
                                        <option value="₴">₴</option>
                                        <option value="₵">₵</option>
                                        <option value="₶">₶</option>
                                        <option value="₷">₷</option>
                                        <option value="₸">₸</option>
                                        <option value="₹">₹</option>
                                        <option value="₺">₺</option>
                                        <option value="₻">₻</option>
                                        <option value="₼">₼</option>
                                        <option value="₽">₽</option>
                                        <option value="₾">₾</option>
                                        <option value="₿">₿</option>
                                    </select>
                                </div>
                                <input type="number" class="form-control tuition_fee" placeholder="0.00"
                                    name="tuition_fee" value="@if (!empty($tuition_fee)) $tuition_fee @endif">
                            </div>

                            <input type="hidden" class="updated_row" name="updated_row_id">
                            <input type="hidden" class="updated_val" name="updated_val">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn edit_save" value="" id="add_courses_btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Accepted Model -->
    <!-- Add Offered Modal -->
    <div class="modal fade" id="add_offered" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Change Application Date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('application_status') }}" id="add_courses_form">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 error-placeholder">
                            <label class="form-label">Select Date</label>
                            <input type="date" class="form-control" name="change_date" required>
                            <input type="hidden" class="updated_row" name="updated_row_id">
                            <input type="hidden" class="updated_val" name="updated_val">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn edit_save" value="" id="add_courses_btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add offered Model -->

<div class="modal fade" id="AcceptanceModal" class="AcceptanceModal" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Application Acceptance Reasons</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img class="pt-2" src="{{ asset('admin/images/modal-close.png') }}" alt="">
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="" id="acceptance_form" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="acceptance_reason" id="acceptance_reason" cols="30"
                                rows="5" placeholder="Write Reason here..."></textarea>
                        </div>
                        <div class="social-custom-modals-btnn text-center ">
                            <button class="btn btn-primary" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

    <!-- Rejected Status modal -->
    <div class="modal fade" id="RejecteddModal" class="RejecteddModal" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="staticBackdropLabel">Application Rejection Reasons</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <img class="pt-2" src="{{ asset('admin/images/modal-close.png') }}" alt="">
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form action="" id="rejected_form" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="rejected_reason" id="rejected_reason" cols="30" rows="5"
                                    placeholder="Write Reason here..."></textarea>
                            </div>
                            <div class="social-custom-modals-btnn text-center ">
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end Rejected modal -->
    <!-- Declined Status modal -->
    <div class="modal fade" id="DeclineddModal" class="DeclineddModal" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="staticBackdropLabel">Application Declined Reasons</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <img class="pt-2" src="{{ asset('admin/images/modal-close.png') }}" alt="">
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form action="" id="declined_form" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="declined_reason" id="rejected_reason" cols="30" rows="5"
                                    placeholder="Write Reason here..."></textarea>
                            </div>
                            <div class="social-custom-modals-btnn text-center ">
                                <button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end Declined modal -->
    <!-- Add Attachment Modal -->
    <div class="modal fade" id="add_attachment" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Attachments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('save_attachment') }}" id="add_attachment"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3 error-placeholder">
                            <label class="form-label">Add Multiple Files</label>
                            <div class="uploadOuter">
                                <input type="file" class="form-control" name="profile_photo[]"
                                    onChange="dragNdrop(event)" ondragover="drag()" ondrop="drop()" id="uploadFile"
                                    multiple />
                                <input type="hidden" name="student_id" value="{{ $user->id }}">
                            </div>
                            <div id="preview"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn edit_save" value="" id="add_courses_btn">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Attechment Model -->
    @include('admin.modals.emailModal')
    @include('admin.modals.smsModal')
    {{-- @include('admin.modals.addappModal') --}}
    {{-- @include('admin.modals.editappModal') --}}
    @include('admin.modals.whatsupModal')
    @include('admin.modals.deleteModal')
    @include('admin.modals.addTaskModal')
    @include('admin.modals.editTaskModal')

@endsection
@section('scripts')
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        "use strict";

        function dragNdrop(event) {
            var files = event.target.files;
            if (files.length == 1) {
                var fileName = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("preview");
                var previewImg = document.createElement("img");
                var as = previewImg.setAttribute("src", fileName);
                preview.innerHTML = "";
                preview.appendChild(previewImg);
            } else {
                var preview = document.getElementById("preview");
                preview.innerHTML = "";
                for (var i = 0, f; f = files[i]; i++) {
                    var fileName = URL.createObjectURL(f);
                    var preview = document.getElementById("preview");
                    var previewImg = document.createElement("img");
                    var as = previewImg.setAttribute("src", fileName);
                    preview.appendChild(previewImg);
                }
            }
        }

        function drag() {
            document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
        }

        function drop() {
            document.getElementById('uploadFile').parentNode.className = 'dragBox';
        }

        $('.edit-application').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#switch-div input[type=checkbox]').prop('checked', true);
            $('#div-display-data').addClass('d-none');
            $('#div-app').removeClass('d-none');
            $('#add_application_form').attr('action', "{{ route('update_application') }}");
            console.log(id);

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                method: 'get',
                url: '{{ route('edit_application', '+ id +') }}',
                data: {
                    id: id,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var study_destinations = data.dropdown[5].dropdown_type;
                    var institute_names = data.dropdown[6].dropdown_type;
                    var option_study_destination;
                    var option_institute_name;

                    $(study_destinations).each(function(index, study_destination) {
                        if (data.applications.study_dest == study_destination.id) {
                            option_study_destination += "<option value='" + study_destination
                                .id + "' selected>" + study_destination.name + "</option>";
                        } else {
                            option_study_destination += "<option value='" + study_destination
                                .id + "'>" + study_destination.name + "</option>";
                        }
                        $('#study-destination').html(option_study_destination);
                    });
                    $(institute_names).each(function(index, institute_name) {
                        if (data.applications.inst_name == institute_name.id) {
                            option_institute_name += "<option value='" + institute_name.id +
                                "' selected>" + institute_name.name + "</option>";
                        } else {
                            option_institute_name += "<option value='" + institute_name.id +
                                "'>" + institute_name.name + "</option>";
                        }
                        $('#institute-name').html(option_institute_name);
                    });

                    if (data.applications.id != null) {
                        $('#applications_id').val(data.applications.id)
                    } else {
                        $('#applications_id').val(' ');
                    };
                    if (data.applications.special_education.id != null) {
                        $('#special_education_id').val(data.applications.special_education.id)
                    } else {
                        $('#special_education_id').val(' ');
                    };
                    if (data.applications.education.id != null) {
                        $('#education_id').val(data.applications.education.id)
                    } else {
                        $('#education_id').val(' ');
                    };

                    // if (data.applications.education.bachelor != null) {
                    //     $('#bachelor-div input[type=checkbox]').prop('checked', true);
                    //     $('#bechelor_deg_name').val(data.applications.education.bachelor);
                    // } else {
                    //     $('#bachelor-div input[type=checkbox]').prop('checked', false);
                    //     $('#bechelor_deg_name').val(null);
                    // }

                    if (data.applications.start_date != null) {
                        console.log(data.applications.education.start_date);
                        $('#eng').prop('checked', true);
                        $('#eng-div div').removeClass('displayNone');
                        $('#eng-date div').removeClass('displayNone2');
                        $('input[name=duration]').val(data.applications.duration);
                        $('input[name=duration_start_date]').val(data.applications.start_date);
                    } else {
                        $('#eng').prop('checked', false);
                        $('#eng-div div').addClass('displayNone');
                        $('#eng-date div').addClass('displayNone2');
                        $('input[name=duration]').val(null);
                        $('input[name=duration_start_date]').val(null);
                    }
                    if (data.applications.special_education.certificate1 != null) {
                        console.log(data.applications.special_education.certificate1);
                        $('#certificate1-div input[type=checkbox]').prop('checked', true);
                        $('#certificate1-div div').removeClass('displayNone');
                        $('input[name=certificate1]').val(data.applications.special_education
                            .certificate1);
                        // $('input[name=master_deg_date]').val(data.applications.education.md_start_date);
                    } else {
                        $('#certificate1-div input[type=checkbox]').prop('checked', false);
                        $('#certificate1-div div').addClass('displayNone');
                        $('input[name=certificate1]').val(null);
                    }
                    if (data.applications.special_education.certificate2 != null) {
                        console.log(data.applications.special_education.certificate2);
                        $('#certificate2-div input[type=checkbox]').prop('checked', true);
                        $('#certificate2-div div').removeClass('displayNone');
                        $('input[name=certificate2]').val(data.applications.special_education
                            .certificate2);
                    } else {
                        $('#certificate2-div input[type=checkbox]').prop('checked', false);
                        $('#certificate2-div div').addClass('displayNone');
                        $('input[name=certificate2]').val(null);
                    }
                    if (data.applications.special_education.certificate3 != null) {
                        console.log(data.applications.special_education.certificate3);
                        $('#certificate3-div input[type=checkbox]').prop('checked', true);
                        $('#certificate3-div div').removeClass('displayNone');
                        $('input[name=certificate3]').val(data.applications.special_education
                            .certificate3);
                    } else {
                        $('#certificate3-div input[type=checkbox]').prop('checked', false);
                        $('#certificate3-div div').addClass('displayNone');
                        $('input[name=certificate3]').val(null);
                    }
                    if (data.applications.special_education.certificate4 != null) {
                        console.log(data.applications.special_education.certificate4);
                        $('#certificate4-div input[type=checkbox]').prop('checked', true);
                        $('#certificate4-div div').removeClass('displayNone');
                        $('input[name=certificate4]').val(data.applications.special_education
                            .certificate4);
                    } else {
                        $('#certificate4-div input[type=checkbox]').prop('checked', false);
                        $('#certificate4-div div').addClass('displayNone');
                        $('input[name=certificate4]').val(null);
                    }
                    if (data.applications.special_education.foundation != null) {
                        console.log(data.applications.special_education.foundation);
                        $('#foundation-div input[type=checkbox]').prop('checked', true);
                        $('#foundation-div div').removeClass('displayNone');
                        $('input[name=foundation_date]').val(data.applications.special_education
                            .foundation);
                    } else {
                        $('#foundation-div input[type=checkbox]').prop('checked', false);
                        $('#foundation-div div').addClass('displayNone');
                        $('#masters_degree-row .open-calender div').addClass('displayNone2');
                        $('input[name=foundation_date]').val(null);
                    }
                    if (data.applications.special_education.associate_degree != null) {
                        console.log(data.applications.special_education.associate_degree);
                        $('#associate_deg-div input[type=checkbox]').prop('checked', true);
                        $('#associate_deg-div div').removeClass('displayNone');
                        $('input[name=associate_deg_date]').val(data.applications.special_education
                            .associate_degree);
                    } else {
                        $('#associate_deg-div input[type=checkbox]').prop('checked', false);
                        $('#associate_deg-div div').addClass('displayNone');
                        $('input[name=associate_deg_date]').val(null);
                    }

                    // education //
                    if (data.applications.education.diploma != null) {
                        console.log(data.applications.education.diploma);
                        $('#diploma-div input[type=checkbox]').prop('checked', true);
                        $('#diploma-div div').removeClass('displayNone');
                        $('#diploma-row .open-calender div').removeClass('displayNone2');
                        $('input[name=diploma_name]').val(data.applications.education.diploma);
                        $('input[name=diploma_date]').val(data.applications.education.d_start_date);
                    } else {
                        $('#diploma-div input[type=checkbox]').prop('checked', false);
                        $('#diploma-div div').addClass('displayNone');
                        $('#diploma-row .open-calender div').addClass('displayNone2');
                        $('input[name=diploma_name]').val(null);
                    }
                    if (data.applications.education.advance_diploma != null) {
                        console.log(data.applications.education.advance_diploma);
                        $('#advance_diploma-div input[type=checkbox]').prop('checked', true);
                        $('#advance_diploma-div div').removeClass('displayNone');
                        $('#advance_diploma-row .open-calender div').removeClass('displayNone2');
                        $('input[name=advance_diploma_name]').val(data.applications.education
                            .advance_diploma);
                        $('input[name=advance_diploma_date]').val(data.applications.education
                            .ad_start_date);
                    } else {
                        $('#advance_diploma-div input[type=checkbox]').prop('checked', false);
                        $('#advance_diploma-div div').addClass('displayNone');
                        $('#advance_diploma-row .open-calender div').addClass('displayNone2');
                        $('#advance_diploma_name').val(null);
                    }
                    if (data.applications.education.bachelor != null) {
                        console.log(data.applications.education.bachelor);
                        $('#bechelor_deg-div input[type=checkbox]').prop('checked', true);
                        $('#bechelor_deg-div div').removeClass('displayNone');
                        $('#bechelor_deg-row .open-calender div').removeClass('displayNone2');
                        $('input[name=bechelor_deg_name]').val(data.applications.education.bachelor);
                        $('input[name=bechelor_deg_date]').val(data.applications.education
                            .b_start_date);
                    } else {
                        $('#bechelor_deg-div input[type=checkbox]').prop('checked', false);
                        $('#bechelor_deg-div div').addClass('displayNone');
                        $('#bechelor_deg-row .open-calender div').addClass('displayNone2');
                        $('input[name=bechelor_deg_name]').val(null);
                    }
                    if (data.applications.education.bechelor_hons != null) {
                        console.log(data.applications.education.bechelor_hons);
                        $('#bechelor_honours-div input[type=checkbox]').prop('checked', true);
                        $('#bechelor_honours-div div').removeClass('displayNone');
                        $('#bechelor_honours-row .open-calender div').removeClass('displayNone2');
                        $('input[name=bechelor_honours_name]').val(data.applications.education
                            .bechelor_hons);
                        $('input[name=bechelor_honours_date]').val(data.applications.education
                            .bh_start_date);
                    } else {
                        $('#bechelor_honours-div input[type=checkbox]').prop('checked', false);
                        $('#bechelor_honours-div div').addClass('displayNone');
                        $('#bechelor_honours-row .open-calender div').addClass('displayNone2');
                        $('input[name=bechelor_honours_name]').val(null);
                    }
                    if (data.applications.education.graduate_diploma != null) {
                        console.log(data.applications.education.graduate_diploma);
                        $('#graduate_diploma-div input[type=checkbox]').prop('checked', true);
                        $('#graduate_diploma-div div').removeClass('displayNone');
                        $('#graduate_diploma-row .open-calender div').removeClass('displayNone2');
                        $('input[name=graduate_diploma_name]').val(data.applications.education
                            .graduate_diploma);
                        $('input[name=graduate_diploma_date]').val(data.applications.education
                            .gd_start_date);
                    } else {
                        $('#graduate_diploma-div input[type=checkbox]').prop('checked', false);
                        $('#graduate_diploma-div div').addClass('displayNone');
                        $('#graduate_diploma-row .open-calender div').addClass('displayNone2');
                        $('input[name=graduate_diploma_name]').val(null);
                    }
                    if (data.applications.education.masters_degree != null) {
                        console.log(data.applications.education.masters_degree);
                        $('#masters_degree-div input[type=checkbox]').prop('checked', true);
                        $('#masters_degree-div div').removeClass('displayNone');
                        $('#masters_degree-row .open-calender div').removeClass('displayNone2');
                        $('#masters_degree_name').val(data.applications.education.masters_degree);
                        $('input[name=master_deg_date]').val(data.applications.education.md_start_date);
                    } else {
                        $('#masters_degree-div input[type=checkbox]').prop('checked', false);
                        $('#masters_degree-div div').addClass('displayNone');
                        $('#masters_degree-row .open-calender div').addClass('displayNone2');
                        $('#masters_degree_name').val(null);
                    }
                    if (data.applications.education.doctoral_degree != null) {
                        console.log(data.applications.education.doctoral_degree);
                        $('#doctoral_deg-div input[type=checkbox]').prop('checked', true);
                        $('#doctoral_deg-div div').removeClass('displayNone');
                        $('#doctoral_deg-row .open-calender div').removeClass('displayNone2');
                        $('input[name=doctoral_deg_name]').val(data.applications.education
                            .doctoral_degree);
                        $('input[name=doctoral_deg_date]').val(data.applications.education
                            .dd_start_date);
                    } else {
                        $('#doctoral_deg-div input[type=checkbox]').prop('checked', false);
                        $('#doctoral_deg-div div').addClass('displayNone');
                        $('#doctoral_deg-row .open-calender div').addClass('displayNone2');
                        $('input[name=doctoral_deg_name]').val(null);
                    }
                    if (data.applications.education.primary_school != null) {
                        console.log(data.applications.education.primary_school);
                        $('#primary_school-div input[type=checkbox]').prop('checked', true);
                        $('#primary_school-div div').removeClass('displayNone');
                        $('input[name=primary_school]').val(data.applications.education.primary_school);
                    } else {
                        $('#primary_school-div input[type=checkbox]').prop('checked', false);
                        $('#primary_school-div div').addClass('displayNone');
                        $('input[name=primary_school]').val(null);
                    }
                    if (data.applications.education.high_school != null) {
                        console.log(data.applications.education.high_school);
                        $('#high_school-div input[type=checkbox]').prop('checked', true);
                        $('#high_school-div div').removeClass('displayNone');
                        $('input[name=high_school]').val(data.applications.education.high_school);
                    } else {
                        $('#high_school-div input[type=checkbox]').prop('checked', false);
                        $('#high_school-div div').addClass('displayNone');
                        $('#high_school-row .open-calender div').addClass('displayNone2');
                        $('input[name=high_school]').val(null);
                    }
                }
            });
        });

        // $('#add_application').on('click', function(e) {
        //     e.preventDefault();
        //     $('#switch-div input[type=checkbox]').prop('checked', true);
        //     $('#div-display-data').hide();
        //     $('#div-app').show();
        //     $('#add_application_form').attr('action', "{{ route('save_application') }}");
        // });
    </script>

    <script>
        $('.sms').on('click', function(e) {
            var current = $(this);
            e.preventDefault();
            var std_id = $(this).data('id');
            var std_name = $(this).attr('href');
            $('.id_name').text(std_name + '-' + std_id);
            var first_contact_num = current.children(".first_contact_num");
            var second_contact_num = current.children(".second_contact_num");
            var contact_first = $('.first_name_btn').text(first_contact_num.val());
            var contact_second = $('.second_name_btn').text(second_contact_num.val());

        });
        $('.first_name_btn').on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('contact_bg');
            if ($(this).hasClass('contact_bg')) {
                $('#first_num').val($(this).text());
                console.log($('#first_num').val($(this).text()));
            } else {
                $('#first_num').val('');
                $(this).removeClass('contact_bg');
                console.log($('#first_num').val());
            }
        });
        $('.second_name_btn').on('click', function(e) {
            e.preventDefault();
            $(this).toggleClass('contact_bg');
            if ($(this).hasClass('contact_bg')) {
                $('#second_num').val($(this).text());
                console.log($('#second_num').val($(this).text()));
            } else {
                $('#second_num').val('');
                $(this).removeClass('contact_bg');
                console.log($('#second_num').val());
            }
        });
    </script>
    <script>
        $(document).on('click', '.status a', function(e) {
            e.preventDefault();
            var val = $(this).text();
            var row = $(this).closest('tr');
            var app_id = row.find('.app_id').val();
            var tuition_fee = parseInt($(this).attr('href'));
            var start_date = $(this).data('id');

            $('.accepted_date').val(start_date);
            $('.tuition_fee').val(tuition_fee);

            if (val == 'Offered') {
                $('body').find('.updated_val').val(val);
                $('body').find('.updated_row').val(app_id);
                $('#add_offered').modal('show');
            } else if (val == 'Accepted') {
                $('body').find('.updated_val').val(val);
                $('body').find('.updated_row').val(app_id);
                $('#accepted_status').modal('show');
            } else {
                row.find('.status_td').text(val);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                $.ajax({
                    data: {
                        val: val,
                        app_id: app_id
                    },
                    url: "{{ route('application_status') }}",
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        toastr.success("Status Updated Successfully");
                    }
                });
            }
        })
    </script>
    <script>
        $('.status_dropdown').on('click', function(e) {
            e.preventDefault();
            // var url = $(this).data('id');
            var id = $(this).val();
            console.log(id);
            var rejected_url = "/users/rejected_reason/" + id;
            $('#rejected_form').attr('action', rejected_url);
             var acceptance_url = "/users/acceptance_reason/" + id;
        $('#acceptance_form').attr('action', acceptance_url);
            var declined_url = "/users/declined_reason/" + id;
            console.log(declined_url);
            $('#declined_form').attr('action', declined_url);
        });
    </script>
    <script>
        var calendar = document.getElementById("calendar-table");
        var gridTable = document.getElementById("table-body");
        var currentDate = new Date();
        var selectedDate = currentDate;
        var selectedDayBlock = null;
        var globalEventObj = {};

        var sidebar = document.getElementById("sidebar");

        function createCalendar(date, side) {
            var currentDate = date;
            var startDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

            var monthTitle = document.getElementById("month-name");
            var monthName = currentDate.toLocaleString("en-US", {
                month: "long"
            });
            var yearNum = currentDate.toLocaleString("en-US", {
                year: "numeric"
            });
            monthTitle.innerHTML = `${monthName} ${yearNum}`;

            if (side == "left") {
                gridTable.className = "animated fadeOutRight";
            } else {
                gridTable.className = "animated fadeOutLeft";
            }

            setTimeout(() => {
                gridTable.innerHTML = "";

                var newTr = document.createElement("div");
                newTr.className = "row";
                var currentTr = gridTable.appendChild(newTr);

                for (let i = 1; i < startDate.getDay(); i++) {
                    let emptyDivCol = document.createElement("div");
                    emptyDivCol.className = "col empty-day";
                    currentTr.appendChild(emptyDivCol);
                }

                var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
                lastDay = lastDay.getDate();

                for (let i = 1; i <= lastDay; i++) {
                    if (currentTr.children.length >= 7) {
                        currentTr = gridTable.appendChild(addNewRow());
                    }
                    let currentDay = document.createElement("div");
                    currentDay.className = "col";
                    if (selectedDayBlock == null && i == currentDate.getDate() || selectedDate.toDateString() ==
                        new Date(currentDate.getFullYear(), currentDate.getMonth(), i).toDateString()) {
                        selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);

                        document.getElementById("eventDayName").innerHTML = selectedDate.toLocaleString("en-US", {
                            month: "long",
                            day: "numeric",
                            year: "numeric"
                        });

                        selectedDayBlock = currentDay;
                        setTimeout(() => {
                            currentDay.classList.add("blue");
                            currentDay.classList.add("lighten-3");
                        }, 900);
                    }
                    currentDay.innerHTML = i;

                    //show marks
                    if (globalEventObj[new Date(currentDate.getFullYear(), currentDate.getMonth(), i)
                            .toDateString()]) {
                        let eventMark = document.createElement("div");
                        eventMark.className = "day-mark";
                        currentDay.appendChild(eventMark);
                    }

                    currentTr.appendChild(currentDay);
                }

                for (let i = currentTr.getElementsByTagName("div").length; i < 7; i++) {
                    let emptyDivCol = document.createElement("div");
                    emptyDivCol.className = "col empty-day";
                    currentTr.appendChild(emptyDivCol);
                }

                if (side == "left") {
                    gridTable.className = "animated fadeInLeft";
                } else {
                    gridTable.className = "animated fadeInRight";
                }

                function addNewRow() {
                    let node = document.createElement("div");
                    node.className = "row";
                    return node;
                }

            }, !side ? 0 : 270);
        }

        createCalendar(currentDate);

        var todayDayName = document.getElementById("todayDayName");
        todayDayName.innerHTML = "Today is " + currentDate.toLocaleString("en-US", {
            weekday: "long",
            day: "numeric",
            month: "short"
        });

        var prevButton = document.getElementById("prev");
        var nextButton = document.getElementById("next");

        prevButton.onclick = function changeMonthPrev() {
            currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1);
            createCalendar(currentDate, "left");
        }
        nextButton.onclick = function changeMonthNext() {
            currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1);
            createCalendar(currentDate, "right");
        }

        function addEvent(title, desc) {
            if (!globalEventObj[selectedDate.toDateString()]) {
                globalEventObj[selectedDate.toDateString()] = {};
            }
            globalEventObj[selectedDate.toDateString()][title] = desc;
        }

        function showEvents() {
            let sidebarEvents = document.getElementById("sidebarEvents");
            let objWithDate = globalEventObj[selectedDate.toDateString()];

            sidebarEvents.innerHTML = "";

            if (objWithDate) {
                let eventsCount = 0;
                for (key in globalEventObj[selectedDate.toDateString()]) {
                    let eventContainer = document.createElement("div");
                    eventContainer.className = "eventCard";

                    let eventHeader = document.createElement("div");
                    eventHeader.className = "eventCard-header";

                    let eventDescription = document.createElement("div");
                    eventDescription.className = "eventCard-description";

                    eventHeader.appendChild(document.createTextNode(key));
                    eventContainer.appendChild(eventHeader);

                    eventDescription.appendChild(document.createTextNode(objWithDate[key]));
                    eventContainer.appendChild(eventDescription);

                    let markWrapper = document.createElement("div");
                    markWrapper.className = "eventCard-mark-wrapper";
                    let mark = document.createElement("div");
                    mark.classList = "eventCard-mark";
                    markWrapper.appendChild(mark);
                    eventContainer.appendChild(markWrapper);

                    sidebarEvents.appendChild(eventContainer);

                    eventsCount++;
                }
                let emptyFormMessage = document.getElementById("emptyFormTitle");
                emptyFormMessage.innerHTML = `${eventsCount} events now`;
            } else {
                let emptyMessage = document.createElement("div");
                emptyMessage.className = "empty-message";
                emptyMessage.innerHTML = "Sorry, no events to selected date";
                sidebarEvents.appendChild(emptyMessage);
                let emptyFormMessage = document.getElementById("emptyFormTitle");
                emptyFormMessage.innerHTML = "No events now";
            }
        }

        gridTable.onclick = function(e) {

            if (!e.target.classList.contains("col") || e.target.classList.contains("empty-day")) {
                return;
            }

            if (selectedDayBlock) {
                if (selectedDayBlock.classList.contains("blue") && selectedDayBlock.classList.contains("lighten-3")) {
                    selectedDayBlock.classList.remove("blue");
                    selectedDayBlock.classList.remove("lighten-3");
                }
            }
            selectedDayBlock = e.target;
            selectedDayBlock.classList.add("blue");
            selectedDayBlock.classList.add("lighten-3");

            selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), parseInt(e.target.innerHTML));

            showEvents();

            document.getElementById("eventDayName").innerHTML = selectedDate.toLocaleString("en-US", {
                month: "long",
                day: "numeric",
                year: "numeric"
            });

        }

        var changeFormButton = document.getElementById("changeFormButton");
        var addForm = document.getElementById("addForm");
        changeFormButton.onclick = function(e) {
            addForm.style.top = 0;
        }

        var cancelAdd = document.getElementById("cancelAdd");
        cancelAdd.onclick = function(e) {
            addForm.style.top = "100%";
            let inputs = addForm.getElementsByTagName("input");
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].value = "";
            }
            let labels = addForm.getElementsByTagName("label");
            for (let i = 0; i < labels.length; i++) {
                labels[i].className = "";
            }
        }

        var addEventButton = document.getElementById("addEventButton");
        addEventButton.onclick = function(e) {
            let title = document.getElementById("eventTitleInput").value.trim();
            let desc = document.getElementById("eventDescInput").value.trim();

            if (!title || !desc) {
                document.getElementById("eventTitleInput").value = "";
                document.getElementById("eventDescInput").value = "";
                let labels = addForm.getElementsByTagName("label");
                for (let i = 0; i < labels.length; i++) {
                    labels[i].className = "";
                }
                return;
            }

            addEvent(title, desc);
            showEvents();

            if (!selectedDayBlock.querySelector(".day-mark")) {
                selectedDayBlock.appendChild(document.createElement("div")).className = "day-mark";
            }

            let inputs = addForm.getElementsByTagName("input");
            for (let i = 0; i < inputs.length; i++) {
                inputs[i].value = "";
            }
            let labels = addForm.getElementsByTagName("label");
            for (let i = 0; i < labels.length; i++) {
                labels[i].className = "";
            }

        }
    </script>

    {{-- Script for task module --}}
    <script>
        $('.comment_close_btn').on('click', function(e) {
            e.preventDefault();
            $('#comment_modal').modal('hide');
            location.reload();
        })
        $('.complete_status').on('change', function(e) {
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
                data: {
                    val: val,
                    updated_row_id: updated_row_id
                },
                url: "{{ route('update_task_status') }}",
                type: "POST",
                dataType: "json",
                success: function(data) {
                    // alert(val);
                    if (val == 'UnComplete') {
                        $('#comment_modal').modal('show');
                    } else {
                        location.reload();
                    }

                }
            });
        })
        $('.save_comment').on('click', function(e) {
            e.preventDefault();
            // alert($(this).val());
            var student_id = $(this).val();
            var val = $('.comment_textarea').val();
            var course_rw_id = $('.rowIdForComment').val();
            if (val == '') {
                $('.comment_textarea').addClass('course_comment_error');
                $('.comment_textarea_p').text('Enter The Comment');
            } else {
                // alert('no value');
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                $.ajax({
                    data: {
                        val: val,
                        student_id: student_id,
                        course_rw_id: course_rw_id
                    },
                    url: "{{ route('save_task_comment') }}",
                    type: "POST",
                    dataType: "json",
                    success: function(data) {
                        // toastr.success("Record Added Successfully");
                        location.reload();
                        // $('#comment_modal').modal('hide');
                    }
                });
            }

        });






        // Save Task Request
        $(document).on("click", "#add_task_btn", function(e) {
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
                success: function(data) {
                    toastr.success("Record Added Successfully");
                    setInterval(function() {
                        location.reload();
                    }, 1000);

                },
                error: function(responce) {
                    $.each(responce.responseJSON.errors, function(index, el) {
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
        $(document).on("click", "#update_task_btn", function(e) {
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
                success: function(data) {
                    toastr.success("Record Updated Successfully");
                    setInterval(function() {
                        location.reload();
                    }, 1000);
                },
                error: function(responce) {
                    $.each(responce.responseJSON.errors, function(index, el) {
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
        $(document).on("click", "#edit_task_btn", function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var edit_id = row.find('.edit_id').val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                data: {
                    edit_id: edit_id
                },
                url: "{{ route('edit_task') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    $(".edit_name").val(response.task_name);
                    $(".edit_date").val(response.date);
                    $(".updated_id").val(response.id);
                    $("#edit_task").modal("show");
                }
            });
        });
        // when put value in input remove the errors
        $("input").on("change", function() {
            if ($(this).val()) {
                $(this).removeClass("error");
                var box = $(this).closest("div");
                box.find(".invalid-feedback").css("display", "none");
                box.find("p").text("");
            }
        });
    </script>
@endsection
@push('js')
    <script src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".sidebar-nav li a").click(function() {
                $(".sidebar-nav li a").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
    <!-- <script>
        jQuery('#datetimepicker').datetimepicker({
            timepicker: false,
            format: 'd-m-Y'
        });
    </script> -->
    <script>
        $('#datetimepicker1').datetimepicker({
            datepicker: false,
            format: 'H:i',
            step: 5
        });
    </script>
    <script>
        $(function() {
            $('#datetimepicker2, #datetimepicker3, #datetimepicker4, #datetimepicker5, #datetimepicker6, #datetimepicker7, #datetimepicker8, #datetimepicker9, #datetimepicker10, #datetimepicker11, #datetimepicker12, #datetimepicker13, #datetimepicker14, #datetimepicker15, #datetimepicker16, #datetimepicker17')
                .datetimepicker({
                    timepicker: false,
                    format: 'd-m-Y'
                });

            $('.date-icon').on('click', function() {
                $('#datetimepicker2').focus();
            })
        });
    </script>
    <script>
        // $('.open-calender').on('click', function(){
        //     var current = $(this);
        //     console.log(current.html("waseem asghar"));
        // });
    </script>


    <script>
        $(document).ready(function() {
            $('.mm-custom-input').change(function() {
                if (!this.checked) {
                    $(this).closest('div').find('.displayNone').hide();
                } else {
                    $(this).closest('div').find('.displayNone').show();
                }
            });
            $('.checkbox2').change(function() {
                if (!this.checked) {
                    $(this).closest('.row').find('.displayNone').hide();
                    $(this).closest('.row').find('.displayNone2').hide();
                } else {
                    $(this).closest('.row').find('.displayNone2').show();
                    $(this).closest('.row').find('.displayNone').show();
                }
            });

            // $('#div-app').hide();
            // $('#div-display-data').show();

            $('#switch-div input[type=checkbox]').on('change', function() {
                if (this.checked) {
                    $('#div-display-data').addClass('d-none');
                    $('#heading-div h2').text('Application Form');
                    $('#div-app').removeClass('d-none');
                    console.log("checked");
                } else {
                    $('#div-app').addClass('d-none');
                    $('#heading-div h2').text('Student Detail');
                    $('#div-display-data').removeClass('d-none');
                    console.log("unchecked");
                }
            });

            // cancel edit form
            $('#cancel-edit').on('click', function(e) {
                e.preventDefault();
                window.location.reload();
            });
        });
    </script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                                        <script type="text/javascript">
                                            var timestamp = '<?= time() ?>';

                                            function updateTime() {
                                                $('#time').html(Date(timestamp));
                                                timestamp++;
                                            }
                                            $(function() {
                                                setInterval(updateTime, 1000);
                                            });
                                            -- >
                                        </script>
@endpush
