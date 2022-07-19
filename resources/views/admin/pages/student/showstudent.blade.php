@extends('admin.master')
@push('css')
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
        <h1 class="page-heading">Add Student</h1>
            <div class="list-std-btns">
                <a class="edit-bg" href="{{ route('student.edit',$user->id)}}"><i class="fas fa-pen"></i> &nbsp; Edit</a>
                <a class="del-bg" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteRecord({{$user->id}},'/student/')"><i class="fas fa-trash"></i> &nbsp; Delete</a>
                <a href="{{route('studentlists')}}"><i class="fas fa-step-backward"></i> &nbsp; Back</a>
            </div>
        <div class="std-detail_list float-right">

            <a class="std-detail_btns white-bg" href="https://api.whatsapp.com/send?phone={{$user->contact->contact_number ?? ''}}" target="_blank" title="Whatsapp"> <i class="fab fa-whatsapp"></i>
                &nbsp;<span>Whatsapp</span> </a>
                <a class="std-detail_btns white-bg sms" href="{{$user->info->name ?? ''}}" title="SMS" data-bs-toggle="modal" data-bs-target="#sms-modal" data-id="{{$user->id}}"><i class="fas fa-comment"></i>
                    &nbsp;<span>SMS</span>
                    <input type="hidden" class="first_contact_num" value="{{$user->contact->contact_number ?? ''}}">
                    <input type="hidden" class="second_contact_num" value="{{$user->contact->secondary_contact_number ?? ''}}">
                </a>

            <a class="std-detail_btns white-bg" href="mailto:{{$user->contact->email ?? ''}}?subject={{$user->id}}-{{$user->info->surname ?? ''}} {{$user->info->name ?? ''}}" title="Student"> <i class="fas fa-envelope"></i> &nbsp;<span>Student</span></a>

            <a class="std-detail_btns white-bg" href="@if($user->role_counsellor)mailto:{{$user->role_counsellor['email']}}?subject={{$user->id}}-{{$user->info->surname}} {{$user->info->name}}@else # @endif" tiltle="Counselor"><i class="fas fa-envelope"></i> &nbsp;<span>Counsellor</span></a>


            <a class="std-detail_btns white-bg" href="@if($user->role_admission)mailto:{{$user->role_admission['email']}}?subject={{$user->id}}-{{$user->info->surname}} {{$user->info->name}} @else # @endif" tiltle="admission officer"><i class="fas fa-envelope"></i> &nbsp;<span>Admission</span></a>

            @can('add application')
            <a class="std-detail_btns white-bg" href="{{route('application',$user->id)}}" title="Add Application"> <i class="fas fa-plus-circle"></i> &nbsp;<span>Application</span> </a>
            @endcan
            <!-- <a class="std-detail_btns gray-bg" href="#" title="Status Application"><i class="fas fa-list-alt"></i> &nbsp;<span>Status</span></a> -->
            <!-- <a class="std-detail_btns blue-bg" href="{{route('visa.list',$user->id)}}" title="Add Visa"><i class="fas fa-plus-circle"></i>  &nbsp;Visa</a> -->
            <a class="std-detail_btns white-bg" href="{{ route('accomodation',$user->id)}}" title="Accommodation">Accommodation</a>
            <a class="std-detail_btns white-bg" href="{{ route('task',$user->id)}}"> &nbsp;New Task</a>
            <!-- <a class="std-detail_btns yellow-bg" href="{{ route('student.edit',$user->id)}}">
            <img src="{{asset('admin/images/edit-std.png')}}" alt="edit-std" class="img-fluid">
            </a> -->
            <a class="std-detail_btns white-bg" href="{{route('course',$user->id)}}" title="Add Courses"> <i class="fas fa-plus-circle"></i> &nbsp;<span>Courses</span> </a>
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
    <h1 class="page-heading page-hed-pt">Student Information</h1>
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
    <h1 class="page-heading page-hed-pt">Contact Details</h1>

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
    <h1 class="page-heading page-hed-pt">Other Information</h1>
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
</div>

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
@endsection
