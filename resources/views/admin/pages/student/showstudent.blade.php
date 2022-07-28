@extends('admin.master')
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/jquery.datetimepicker.css')}}" />
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
    .btn-primary-outline:hover {
        background-color: #f5981f !important;
        border-color: #ffffff !important;
        padding-left:20px !important;
        padding-right:20px !important;
        color:white;

    }
    .contact_bg {
        background-color: #f5981f !important;
        border-color: #ffffff !important;
        padding-left:20px !important;
        padding-right:20px !important;
        color:white;
    }
    #preview img{
        width: 100px !important;
        height: 100px !important;
        margin: 2px !important;
    }
</style>
@endpush
@section('content')
<div class=" students-List-section list-of-stds">
    <div class="mm-add-std-top-social">
        <!-- <h1 class="page-heading">Add Student</h1> -->
            <div class="list-std-btns">
                <a class="edit-bg" href="{{ route('student.edit',$user->id)}}"><i class="fas fa-pen"></i> &nbsp; Edit</a>
                <a class="del-bg" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteRecord({{$user->id}},'/student/')"><i class="fas fa-trash"></i> &nbsp; Delete</a>
                <a href="{{route('studentlists')}}"><i class="fas fa-step-backward"></i> &nbsp; Back</a>
            </div>
        <div class="std-detail_list float-right">

            <!-- <a class="std-detail_btns white-bg" href="https://api.whatsapp.com/send?phone={{$user->contact->contact_number ?? ''}}" target="_blank" title="Whatsapp"> <i class="fab fa-whatsapp"></i>
                &nbsp;<span>Whatsapp</span> </a> -->
                <a class="std-detail_btns white-bg sms" href="{{$user->info->name ?? ''}}" title="SMS" data-bs-toggle="modal" data-bs-target="#sms-modal" data-id="{{$user->id}}"><i class="fas fa-comment"></i>
                    &nbsp;<span>SMS</span>
                    <input type="hidden" class="first_contact_num" value="{{$user->contact->contact_number ?? ''}}">
                    <input type="hidden" class="second_contact_num" value="{{$user->contact->secondary_contact_number ?? ''}}">
                </a>

            <a class="std-detail_btns white-bg" href="mailto:{{$user->contact->email ?? ''}}?subject={{$user->id}}-{{$user->info->surname ?? ''}} {{$user->info->name ?? ''}}" title="Student"> <i class="fas fa-envelope"></i> &nbsp;<span>Student</span></a>

            <a class="std-detail_btns white-bg" href="@if($user->role_counsellor)mailto:{{$user->role_counsellor['email']}}?subject={{$user->id}}-{{$user->info->surname}} {{$user->info->name}}@else # @endif" tiltle="Counselor"><i class="fas fa-envelope"></i> &nbsp;<span>Counsellor</span></a>


            <a class="std-detail_btns white-bg" href="@if($user->role_admission)mailto:{{$user->role_admission['email']}}?subject={{$user->id}}-{{$user->info->surname}} {{$user->info->name}} @else # @endif" tiltle="admission officer"><i class="fas fa-envelope"></i> &nbsp;<span>Admission</span></a>

            @can('add application')
            <a class="std-detail_btns white-bg" href="{{route('application',$user->id)}}" title="Add Application" data-bs-toggle="modal" data-bs-target="#application-modal" data-id="{{$user->id}}"> <i class="fas fa-plus-circle"></i> &nbsp;<span>Application</span> </a>
            @endcan
            <!-- <a class="std-detail_btns gray-bg" href="#" title="Status Application"><i class="fas fa-list-alt"></i> &nbsp;<span>Status</span></a> -->
            <!-- <a class="std-detail_btns blue-bg" href="{{route('visa.list',$user->id)}}" title="Add Visa"><i class="fas fa-plus-circle"></i>  &nbsp;Visa</a> -->
            <a class="std-detail_btns white-bg" href="{{ route('accomodation',$user->id)}}" title="Accommodation">Accommodation</a>
            <a class="std-detail_btns white-bg" href="{{ route('task',$user->id)}}"> &nbsp;New Task</a>
            <!-- <a class="std-detail_btns yellow-bg" href="{{ route('student.edit',$user->id)}}">
            <img src="{{asset('admin/images/edit-std.png')}}" alt="edit-std" class="img-fluid">
            </a> -->
            <!-- <a class="std-detail_btns white-bg" href="{{route('course',$user->id)}}" title="Add Courses"> <i class="fas fa-plus-circle"></i> &nbsp;<span>Courses</span> </a> -->
            <!-- <a class="std-detail_btns darkblue-bg" href="#"> &nbsp;Attachment</a> -->
            <a class="std-detail_btns white-bg" data-bs-toggle="modal" data-bs-target="#add_task"> &nbsp;Attachment</a>
            
            @can('delete student')
            <!-- <a class="std-detail_btns pink-bg" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteRecord({{$user->id}},'/student/')">Delete</a> -->
            @endcan

        </div>
    </div>
    <div class="list-of-student-inner list-std1">
        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <h3>Office: </h3>
                <p>
                    @if(!empty($dropdown[0]->dropdownType))
                        @foreach($dropdown[0]->dropdownType as $val)
                            @if($val->id == $user->office)
                                {{$val->name}}
                            @endif
                        @endforeach
                    @endif
                </p>
            </div>
            <div class="col-xl-4 col-lg-6">
                <h3>Counsellor: </h3>
                <p>
                    @foreach($counsellor as $val)
                        @if($val->id == $user->counsellor)
                            {{$val->name}}
                        @endif
                    @endforeach
                </p>
            </div>
            <div class="col-xl-4 col-lg-6">
                <h3>Admission Officer: </h3>
               <p> @foreach($admission_officer as $val)
                @if($val->id == $user->admission_officer)
                    {{$val->name}}
                @endif
            @endforeach</p>
            </div>
        </div>
    </div>
    <h6 class="page-hed-pt">Student Information</h6>
    <div class="list-of-student-inner list-std2">

        <div class="row">
            <!-- <div class="col-xl-4 col-lg-6">
                <h3>Surname: </h3>
                <p>{{$user->info->surname ?? ''}}</p>
            </div> -->
            <div class="col-xl-4 col-lg-6">
                <h3 style="white-space:nowrap">Name: </h3>
                <p>{{$user->info->name ?? ''}}</p>
            </div>

            <div class="col-xl-4 col-lg-6">
                <h3>Date of Birth: </h3>
                <p>{{date('M d, Y', strtotime($user->info->dob ?? ''))}}</p>
            </div>
            <div class="col-xl-4 col-lg-6">
                <h3>Gender: </h3>
                <p>{{$user->info->gender ?? ''}}</p>
            </div>
            <div class="col-xl-4 col-lg-6">
                <h3>Nationality: </h3>
               <p>
                @if(!empty($user->info->nationality))
                @foreach($countries as $country)
                    @if($country->id == $user->info->nationality)
                        {{$country->name}}
                    @endif
                @endforeach
                @endif
               </p>
            </div>
            <div class="col-xl-4 col-lg-6 col-12">
                <h3>Student visa: </h3>
                <p>{{$user->info->visa ?? ''}} </p>
            </div>
            <div class="col-xl-4 col-lg-12 col-12">
                <div class="mm-notes w-100">
                    <h3>Note: </h3>
                    <p class="mm-newpad">{{$user->info->note ?? ''}}</p>
                </div>

            </div>

        </div>
    </div>
    <h6 class="page-hed-pt">Contact Details</h6>

    <div class="list-of-student-inner list-std3">
        @if(!empty($user->contact))
        <div class="custom_row">
            <div class=" custom-column">
                <h3>Email address: </h3>
                <span data-toggle="modal" data-target="#myModal" class="mm-mail-list">{{$user->contact->email ?? ''}}</span>
            </div>
            <div class=" custom-column">
                <h3>Secondary Email address: </h3>
                <span data-toggle="modal" data-target="#myModal" class="mm-mail-list" >{{$user->contact->secondary_email ?? ''}}</span>
            </div>
            <div class=" custom-column">
                <h3>Contact number1: </h3>
                <span class="mm-mail-list">{{$user->contact->contact_number ?? ''}}</span>
            </div>
            <div class=" custom-column">
                <h3>Contact number2: </h3>
                <span class="mm-mail-list">{{$user->contact->secondary_contact_number ?? ''}}  </span><br>
            </div>
        </div>
        @endif

        <div class="w-100">
            <h3 class="cust-h3-mb List_hed">Address Details 1: </h3>
            <p> </p>
        </div>
        @if(!empty($user->contact))
            <div class="custom_row">
                <div class=" custom-column">
                    <h3>Street address: </h3>
                    <p>{{$user->contact->street_address ?? ''}}</p>
                </div>
                <div class=" custom-column">
                    <h3>Suburb: </h3>
                    <p>{{$user->contact->suburb ?? ''}}</p>
                </div>
                <div class=" custom-column">
                    <h3>State: </h3>
                    <p>{{$user->contact->state ?? ''}} </p>
                </div>
                <div class=" custom-column">
                    <h3>Post code: </h3>
                    <p>{{$user->contact->post_code ?? ''}}</p>
                </div>
                <div class=" custom-column">
                    <h3>Country: </h3>
                    <p>
                        @foreach($countries as $country)
                            @if($country->id == $user->contact->country)
                                {{$country->name}}
                            @endif
                        @endforeach
                    </p>
                </div>

            </div>
        @endif

    </div>
    <h6 class="page-hed-pt">Other Information</h6>
    <div class="list-of-student-inner list-std4">
        <div class="row">
        @if(!empty($user->otherInfo))
            <div class="col-xl-4 col-lg-6">
                <h3>Type of Funding: </h3>
                <p>@if(!empty($dropdown[1]->dropdownType))
                    @foreach($dropdown[1]->dropdownType as $val)

                        @if($val->id == $user->otherInfo->funding_type ?? '')
                            {{$val->name}}
                        @endif

                    @endforeach
                @endif</p>
            </div>
            <div class="col-xl-4 col-lg-6">
                <h3>Name of sponsor: </h3>
                <p>
                    @if(!empty($dropdown[2]->dropdownType))
                        @foreach($dropdown[2]->dropdownType as $val)
                            @if($val->id == $user->otherInfo->sponsor_name)
                                {{$val->name}}
                            @endif
                        @endforeach
                    @endif
                </p>
            </div>
            <div class="col-xl-4 col-lg-6">
                <h3>Student source: </h3>
                <p>
                    @if(!empty($dropdown[3]->dropdownType))
                        @foreach($dropdown[3]->dropdownType as $val)
                            @if($val->id == $user->otherInfo->student_source)
                                {{$val->name}}
                            @endif
                        @endforeach
                    @endif
                </p>
            </div>
            <div class="col-xl-4 col-lg-6">
                <h3>Cohort: </h3>
                <p>{{isset($user->otherInfo->cohort_name) ? 'Yes' : 'No'}}</p>
            </div>
            <div class="col-xl-4 col-lg-6">
                <h3>Name of Cohort: </h3>
                <p>
                    @if(!empty($dropdown[4]->dropdownType))
                        @foreach($dropdown[4]->dropdownType as $val)
                            @if($val->id == $user->otherInfo->cohort_name)
                                {{$val->name}}
                            @endif
                        @endforeach
                    @endif
                </p>
            </div>
            <div class="col-xl-4 col-lg-6">
                <h3>Name of Partner: </h3>
                <p>
                    @if(!empty($dropdown[17]->dropdownType))
                        @foreach($dropdown[17]->dropdownType as $val)
                            @if($val->id == $user->otherInfo->partner)
                                {{$val->name}}
                            @endif
                        @endforeach
                    @endif
                </p>
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
                @if(!empty($comments))
                @foreach($comments as $val)
                <div>
                    <p>
                        <img class="main-logo img-fluid" src="{{ asset('admin/images/'.$val->user->profile_photo )}}" alt="" />
                        {{$val->user->name ?? ''}}
                        @if($val->user_id == auth()->user()->id)
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$val->id}},'/delete_comment/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        @endif
                    </p>
                    <p>{{$val->comment_text ?? ''}}</p>
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
            <a class="edit-bg" href="{{ route('student.edit',$user->id)}}"><i class="fas fa-pen"></i> &nbsp; Edit</a>
            <a class="del-bg" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteRecord({{$user->id}},'/student/')"><i class="fas fa-trash"></i> &nbsp; Delete</a>
            <a href="{{route('studentlists')}}"><i class="fas fa-step-backward"></i> &nbsp; Back</a>
        </div>
    </div>
    <!-- applications -->
<div class="mm-visible table-responsive">
<h4 class="">Application List</h4>

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
                    <td>
                        @if(!empty($dropdown[5]->dropdownType))
                        @foreach($dropdown[5]->dropdownType as $val)
                        @if($val->id == $item->study_dest)
                        {{$val->name}}
                        @endif
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(!empty($dropdown[6]->dropdownType))
                        @foreach($dropdown[6]->dropdownType as $val)
                        @if($val->id == $item->inst_name)
                        {{$val->name}}
                        @endif
                        @endforeach
                        @endif
                    </td>
                    <td class="status_td">{{$item->status ?? ''}}</td>
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

    </div>
<!-- applications end -->
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
            <form method="POST" action="{{route('application_status')}}" id="application_accepted_modal">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Select Date</label>
                        <input type="date" class="form-control accepted_date" name="change_date" value="">
                        <!-- <input type="number" class="form-control" name="tuition_fee" required> -->
                        <label class="form-label mt-3">Tuition Fee</label>
                        <div class="input-group">

                            <div class="input-group-prepend">

                                <select id="currencyList" class="form-control" style="font-size: 15px;" name="sign">
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
                            <input type="number" class="form-control tuition_fee" placeholder="0.00" name="tuition_fee"
                                value="@if(!empty($tuition_fee))$tuition_fee @endif">
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
<div class="modal fade" id="add_task" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Change Application Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('application_status')}}" id="add_courses_form">
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


<!-- Rejected Status modal -->
<div class="modal fade" id="RejecteddModal" class="RejecteddModal" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <textarea class="form-control" name="rejected_reason" id="rejected_reason" cols="30"
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
<!-- end Rejected modal -->
<!-- Declined Status modal -->



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



<div class="modal fade" id="DeclineddModal" class="DeclineddModal" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <textarea class="form-control" name="declined_reason" id="rejected_reason" cols="30"
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
<!-- end Declined modal -->
<!-- Add Attachment Modal -->
<div class="modal fade" id="add_task" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Attachments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('save_attachment')}}" id="add_attachment" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Add Multiple Files</label>
                        <div class="uploadOuter">
                                <input type="file" class="form-control" name="profile_photo[]" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"  multiple/>
                                <input type="hidden" name="student_id" value="{{$user->id}}">
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
@include('admin.modals.addappModal')
@include('admin.modals.whatsupModal')
@include('admin.modals.deleteModal')

@endsection
@section('scripts')
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script>
    "use strict";
    function dragNdrop(event) {
        var files = event.target.files;
        if(files.length == 1){
            var fileName = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("preview");
            var previewImg = document.createElement("img");
            var as = previewImg.setAttribute("src", fileName);
            preview.innerHTML = "";
            preview.appendChild(previewImg);
        }else{
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

    </script>

<script>
    $('.sms').on('click',function(e){
        var current = $(this);
        e.preventDefault();
        var std_id = $(this).data('id');
        var std_name = $(this).attr('href');
        $('.id_name').text(std_name+'-'+std_id);
        var first_contact_num = current.children(".first_contact_num");
        var second_contact_num = current.children(".second_contact_num");
        var contact_first = $('.first_name_btn').text(first_contact_num.val());
        var contact_second = $('.second_name_btn').text(second_contact_num.val());

    });
    $('.first_name_btn').on('click',function(e){
        e.preventDefault();
        $(this).toggleClass('contact_bg');
        if($(this).hasClass('contact_bg')){
            $('#first_num').val($(this).text());
            console.log($('#first_num').val($(this).text()));
        }
        else{
            $('#first_num').val('');
            $(this).removeClass('contact_bg');
            console.log($('#first_num').val());
        }
    });
    $('.second_name_btn').on('click',function(e){
        e.preventDefault();
        $(this).toggleClass('contact_bg');
        if($(this).hasClass('contact_bg')){
            $('#second_num').val($(this).text());
            console.log($('#second_num').val($(this).text()));
        }
        else{
            $('#second_num').val('');
            $(this).removeClass('contact_bg');
            console.log($('#second_num').val());
        }
    });
</script>
<script>
    $(document).on('click', '.status a', function (e) {
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
            $('#add_task').modal('show');
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
                success: function (data) {
                    toastr.success("Status Updated Successfully");
                }
            });
        }
    })

</script>
<script>
    $('.status_dropdown').on('click', function (e) {
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

    gridTable.onclick = function (e) {

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
    changeFormButton.onclick = function (e) {
        addForm.style.top = 0;
    }

    var cancelAdd = document.getElementById("cancelAdd");
    cancelAdd.onclick = function (e) {
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
    addEventButton.onclick = function (e) {
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
@endsection
@push('js')
<script src="{{asset('js/jquery.datetimepicker.full.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".sidebar-nav li a").click(function () {
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
    $(function () {
        $('#datetimepicker2, #datetimepicker3, #datetimepicker4, #datetimepicker5, #datetimepicker6, #datetimepicker7, #datetimepicker8, #datetimepicker9, #datetimepicker10, #datetimepicker11, #datetimepicker12, #datetimepicker13, #datetimepicker14, #datetimepicker15, #datetimepicker16, #datetimepicker17')
            .datetimepicker({
                timepicker: false,
                format: 'd-m-Y'
            });

        $('.date-icon').on('click', function () {
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
    $(document).ready(function () {
        $('.mm-custom-input').change(function () {
            if (!this.checked) {
                $(this).closest('div').find('.displayNone').hide();
            } else {
                $(this).closest('div').find('.displayNone').show();
            }
        });
        $('.checkbox2').change(function () {
            if (!this.checked) {
                $(this).closest('.row').find('.displayNone').hide();
                $(this).closest('.row').find('.displayNone2').hide();
            } else {
                $(this).closest('.row').find('.displayNone2').show();
                $(this).closest('.row').find('.displayNone').show();
            }
        });
    });

</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
    var timestamp = '<?=time();?>';
    function updateTime(){
      $('#time').html(Date(timestamp));
      timestamp++;
    }
    $(function(){
      setInterval(updateTime, 1000);
    }); -->

</script>
@endpush
