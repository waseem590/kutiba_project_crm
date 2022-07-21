@extends('admin.master') @section('content')

<div class="add-students-section">
    <h1 class="page-heading">
        @if(!empty($forEdit))
            Edit Student
        @else
            Add Student
        @endif
    </h1>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a
                class="nav-link active"
                data-toggle="tab"
                href="#tabs-1"
                role="tab"
            >
                <span>
                    <img
                        src="{{ asset('admin/images/add-student-logo.png') }}"
                        alt="add-student-logo"
                        class="img-fluid"
                    />
                </span>
                Add Student
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab2" href="#tabs-2" role="tab">
                <span
                    ><img
                        src="{{ asset('admin/images/student-info.png') }}"
                        alt="student-info"
                        class="img-fluid"
                /></span>
                Student Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab3" href="#tabs-3" role="tab">
                <span
                    ><img
                        src="{{ asset('admin/images/contact-detail.png') }}"
                        alt="contact-detail"
                        class="img-fluid"
                /></span>
                Contact Detail</a
            >
        </li>
        <li class="nav-item">
            <a class="nav-link tab4" href="#tabs-4" role="tab">
                <span
                    ><img
                        src="{{ asset('admin/images/other-info.png') }}"
                        alt="other-detail"
                        class="img-fluid"
                /></span>
                Other Information</a
            >
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <form
                id="add_student_form"
                method="post"
                action="{{ route('student.store') }}"
            >
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label
                            for="exampleFormControlSelect1"
                            class="tab-inner-label">Office<span style="color:red">*</span></label>
                        <select
                            class="form-control select-inner-text office"
                            id="exampleFormControlSelect1"
                            name="office"
                        >

                            <option disabled selected value>
                                Select Office
                            </option>
                            @if(!empty($dropdown[0]->dropdownType))
                                @foreach($dropdown[0]->dropdownType as $val)
                                    <option value="{{ $val->id }}" @if(isset($user->office) && $user->office == $val->id) ? selected  @endif>{{ $val->name }}</option>
                                @endforeach
                            @endif
                        </select>

                        <input type="hidden" class="forEdit" value="{{ $forEdit ?? ''}}" />
                        <input type="hidden" class="addStudent_id" name="addStudent_id" value="{{ $user->id ?? ''}}" />
                        <input type="hidden" class="studentConTab" value="{{ $contactTab ?? ''}}" />
                        <input type="hidden" class="studentInfoTab" value="{{ $infoTab ?? ''}}" />
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlSelect2" class="tab-inner-label">Counsellor<span style="color:red">*</span></label>
                        <select class="form-control select-inner-text counsellor"
                            id="exampleFormControlSelect1"
                            name="counsellor"
                        >
                            <option disabled selected value>
                                Select Counsellor
                            </option>
                            @foreach($counsellor as $val)
                                <option value="{{ $val->id }}" @if(isset($user->counsellor) && $user->counsellor == $val->id) ? selected  @endif>{{ $val->name }}</option>
                            @endforeach

                        </select>
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                    <div class="form-group col-md-4 mb-0">
                        <label
                            for="exampleFormControlSelect3"
                            class="tab-inner-label"
                            >Admission Officer<span style="color:red">*</span></label
                        >
                        <select
                            class="
                                form-control
                                select-inner-text
                                admission_officer
                            "
                            id="exampleFormControlSelect1"
                            name="admission_officer"
                            value="{{ old('event_name') }}"
                        >
                            <option disabled selected value>
                                Select Admission Officer
                            </option>
                            @foreach($admission_officer as $val)
                                <option value="{{ $val->id }}" @if(isset($user->admission_officer) && $user->admission_officer == $val->id) ? selected  @endif>{{ $val->name }}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                    <div
                        class="
                            form-group
                            col-md-12
                            d-flex
                            flex-row-reverse
                            student-form-action
                        "
                    >
                        <button id="add_student_btn" class="btn">Next</button>
                    </div>
                </div>
                <div class="form-row"></div>
            </form>
        </div>
        <div class="tab-pane" id="tabs-2" role="tabpanel">
            <form id="student_information_form">
                <div class="form-row">
                    @php
                    if(!empty($user->info->name)){
                        $name = explode(" ",$user->info->name);
                    }
                    @endphp
                    <div class="col-md-4 col-md-4">
                        <label class="tab-inner-label" for="">Surname <span style="color:red">*</span></label>
                        <input
                            type="text"
                            class="form-control select-inner-text"
                            placeholder=""
                            name="surname"
                            value="{{$name[0] ?? ''}}"
                        />
                        <input type="hidden" name="StudentInfo_id" value="{{ $user->info->id ?? ''}}" />
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>

                    <!-- <div class="col-md-4 col-md-4">
                        <label class="tab-inner-label" for="">First Name</label>
                        <input
                            type="text"
                            class="form-control select-inner-text"
                            placeholder=""
                            name="f_name"
                            value="{{$name[0] ?? ''}}"
                        />
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div> -->
                    <div class="col-md-4 col-md-4">
                        <label class="tab-inner-label" for="">First & Second Name<span style="color:red">*</span></label>
                        <input
                            type="text"
                            class="form-control select-inner-text"
                            placeholder=""
                            name="l_name"
                            value="{{$name[1] ?? ''}}"
                        />
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                    <div class="col-md-4 col-md-4">
                        <label class="tab-inner-label" for="122">
                            Date Of Birth<span style="color:red">*</span></label>
                        <input
                            type="date"
                            class="form-control select-inner-text"
                            name="dob"
                            value="{{ $user->info->dob ?? ''}}"
                        />
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                    <div class="form-group col-md-4 mt-3">
                        <label
                            for="exampleFormControlSelect3"
                            class="tab-inner-label"
                            >Gender<span style="color:red">*</span></label
                        >
                        <select
                            class="form-control select-inner-text"
                            id="exampleFormControlSelect1"
                            name="gender"
                        >
                            <option disabled selected value>Select</option>
                            <option value="Male"  @if(isset($user->info->gender) && $user->info->gender === 'Male') ? selected : 'Male'  @endif>Male</option>
                            <option value="Female"  @if(isset($user->info->gender) && $user->info->gender === 'Female') ? selected : 'Female'  @endif>Female</option>
                            <option value="Other"  @if(isset($user->info->gender) && $user->info->gender === 'Other') ? selected : 'Saudi Arabia'  @endif>Other</option>
                        </select>
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                    <div class="form-group col-md-4 mt-3">
                        <label
                            for="exampleFormControlSelect3"
                            class="tab-inner-label"
                            >Nationality<span style="color:red">*</span></label
                        >
                        <select
                            class="form-control select-inner-text"
                            id="exampleFormControlSelect1"
                            name="nationality"
                        >
                        <option  disabled="" selected value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" @if(isset($user->info->nationality) && $user->info->nationality == $country->id) ? selected  @endif>{{ $country->name }}</option>
                        @endforeach

                        </select>
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                    <div class="col-md-4 col-md-4"></div>

                    <div class="form-group col-md-4">
                        <div class="position-relative1 form-check-inline">
                            <p class="tab-inner-label w-100">
                                Does student have visa
                            </p>

                            <div class="student-radio">
                                <span>
                                    <input
                                        type="radio"
                                        id="test1"
                                        name="visa"
                                        value="yes"
                                        @if(isset($user->info->visa) && $user->info->visa === 'yes') ? checked : 'yes'  @endif
                                    />
                                    <label for="test1">Yes</label>


                                </span>
                                <span>
                                    <input
                                        type="radio"
                                        id="test2"
                                        name="visa"
                                        value="no"
                                        @if(isset($user->info->visa) && $user->info->visa === 'no') ? checked : 'no'  @endif
                                    />
                                    <label for="test2">No</label>
                                </span>
                                <button type="button" class="btn-close" aria-label="Close"></button>
                            </div>
                            
                        </div>
                    </div>

                    <div class="form-group col-md-12 student-note">
                        <p class="tab-inner-label w-100">Note</p>
                        <textarea
                            placeholder=""
                            class="form-control"
                            name="note"
                        >{{$user->info->note ?? ''}}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-between student-form-action">
                    <button type="submit" class="btn student_information_prev_btn">Previous</button>

                    <button
                        type="submit"
                        id="student_information_btn"
                        class="btn"
                    >
                        Next
                    </button>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="tabs-3" role="tabpanel">
            <form id="contact_detail_form">
                <div class="form-row">
                    <div class="col-md-4 col-md-4">
                        <label class="tab-inner-label" for=""
                            >Email address<span style="color:red">*</span></label
                        >
                        <input
                            type="email"
                            class="form-control select-inner-text"
                            placeholder=""
                            name="email"
                            value="{{ $user->contact->email ?? ''}}"
                        />
                        <input type="hidden" name="contactDetail_id" value="{{ $user->contact->id ?? ''}}" />
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>
                    <div class="col-md-4 col-md-4">
                        <label class="tab-inner-label" for=""
                            >Secondary email address</label
                        >
                        <input
                            type="email"
                            class="form-control select-inner-text"
                            placeholder=""
                            name="secondary_email"
                            value="{{ $user->contact->secondary_email ?? ''}}"
                        />
                    </div>
                    <div class="col-md-4 col-md-4 mm_country">
                        <label class="tab-inner-label" for="">
                            Contact number<span style="color:red">*</span></label
                        >
                        <!-- <input
                            type="text"
                            class="form-control select-inner-text"
                            placeholder=""
                            name="number"
                            value="{{ $user->contact->contact_number ?? ''}}"
                        /> -->
                        <input class="form-control" value="{{ $user->contact->contact_number ?? ''}}" type="tel" name="phone_number[main]" id="phone_number" />
                        <span class="text-danger phone"></span>
                    </div>
                    <div class="col-md-4 col-md-4 mt-3  mm_contact2">
                        <label class="tab-inner-label" for="">
                            Contact number 2</label
                        >
                        <!-- <input
                            type="number"
                            class="form-control select-inner-text"
                            placeholder=""
                            name="number2"
                            value="{{ $user->contact->secondary_contact_number ?? ''}}"
                        /> -->
                        <input class="form-control" value="{{ $user->contact->secondary_contact_number ?? ''}}" type="tel" name="phone_number2[main]" id="phone_number2" />
                    </div>

                    <div class="form-group col-md-12 mt-3">
                        <div class="position-relative1 form-check-inline">
                            <p
                                for="exampleFormControlSelect3"
                                class="tab-inner-label w-100"
                            >
                                Address details
                            </p>

                            <div class="student-radio">
                                <span>
                                    <input
                                        type="radio"
                                        id="test3"
                                        name="address_details"
                                        value="offshore"
                                        @if(isset($user->contact->address_details) && $user->contact->address_details === 'offshore') ? checked : 'offshore'  @endif
                                    />
                                    <label for="test3">Offshore</label>
                                </span>
                                <span>
                                    <input
                                        type="radio"
                                        id="test4"
                                        name="address_details"
                                        value="onshore"
                                        @if(isset($user->contact->address_details) && $user->contact->address_details === 'onshore') ? checked : 'onshore'  @endif
                                    />
                                    <label for="test4">Onshore</label>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-4 mt-3">
                        <label class="tab-inner-label" for="ss">
                            Street address<span style="color:red">*</span></label
                        >
                        <input
                            type="text"
                            class="form-control select-inner-text"
                            placeholder=""
                            name="street_address"
                            value="{{ $user->contact->street_address ?? ''}}"
                        />
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>

                    <div class="col-md-4 col-md-4 mt-3">
                        <label class="tab-inner-label" for="ss"> Suburb<span style="color:red">*</span></label>
                        <input
                            type="text"
                            class="form-control select-inner-text"
                            placeholder=""
                            name="suburb"
                            value="{{ $user->contact->suburb ?? ''}}"
                        />
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>

                    <div class="col-md-4 col-md-4 mt-3">
                        <label class="tab-inner-label" for="dd"> State<span style="color:red">*</span></label>
                        <input
                            type="text"
                            class="form-control select-inner-text"
                            placeholder=""
                            name="state"
                            value="{{ $user->contact->state ?? ''}}"
                        />
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>

                    <div class="form-group col-md-4 mt-3">
                        <label
                            for="exampleFormControlSelect3"
                            class="tab-inner-label"
                            >Country<span style="color:red">*</span></label
                        >
                        <select
                            class="form-control select-inner-text"
                            id="personlist"
                            name="country"
                        >
                        <option  disabled="" selected value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" @if(isset($user->contact->country) && $user->contact->country == $country->id) ? selected  @endif>{{ $country->name }}</option>
                        @endforeach

                        </select>
                        <span class="invalid-feedback">
                            <p></p>
                        </span>
                    </div>

                    <div class="col-md-4 col-md-4 mt-3">
                        <label class="tab-inner-label" for=""> Post code</label>
                        <input
                            type="number"
                            class="form-control select-inner-text"
                            placeholder=""
                            name="post_code"
                            value="{{ $user->contact->post_code ?? ''}}"
                        />
                    </div>
                </div>
                <div class="d-flex justify-content-between student-form-action">
                    <button type="submit" class="btn contact_detail_prev_btn">Previous</button>

                    <button type="submit" id="contact_detail_btn" class="btn">
                        Next
                    </button>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="tabs-4" role="tabpanel">
            <form id="other_information_form">
                <div class="form-row">
                    <div class="form-group col-md-4 mt-3">
                        <label
                            for="exampleFormControlSelect3"
                            class="tab-inner-label"
                            >{{$dropdown[1]->name}}</label
                        >
                        <select
                            class="form-control select-inner-text"
                            id="exampleFormControlSelect1"
                            name="funding_type"
                        >
                            <option disabled selected value>Select Funding Type</option>
                            @if(!empty($dropdown[1]->dropdownType))
                                @foreach($dropdown[1]->dropdownType as $val)
                                    <option value="{{ $val->id }}" @if(isset($user->otherInfo->funding_type) && $user->otherInfo->funding_type == $val->id) ? selected  @endif>{{ $val->name }}</option>
                                @endforeach
                            @endif

                        </select>
                        <input type="hidden" name="otherInfo_id" value="{{ $user->otherInfo->id ?? ''}}" />
                    </div>

                    <div class="form-group col-md-4 mt-3">
                        <label
                            for="exampleFormControlSelect3"
                            class="tab-inner-label"
                            >{{$dropdown[2]->name}}</label
                        >
                        <select
                            class="form-control select-inner-text"
                            id="exampleFormControlSelect1"
                            name="sponsor_name"
                        >
                            <option disabled selected value>Select Sponsor Name</option>
                            @if(!empty($dropdown[2]->dropdownType))
                                @foreach($dropdown[2]->dropdownType as $val)
                                    <option value="{{ $val->id }}" @if(isset($user->otherInfo->sponsor_name) && $user->otherInfo->sponsor_name == $val->id) ? selected  @endif>{{ $val->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-4 mt-3">
                        <label
                            for="exampleFormControlSelect3"
                            class="tab-inner-label"
                            >{{$dropdown[3]->name}}</label
                        >
                        <select
                            class="form-control select-inner-text"
                            id="exampleFormControlSelect1"
                            name="student_source"
                        >
                            <option disabled selected value>Select Student Source</option>
                            @if(!empty($dropdown[3]->dropdownType))
                                @foreach($dropdown[3]->dropdownType as $val)
                                    <option value="{{ $val->id }}" @if(isset($user->otherInfo->student_source) && $user->otherInfo->student_source == $val->id) ? selected  @endif>{{ $val->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-12 mt-3" style="margin-bottom:-21px">
                        <label
                            for="exampleFormControlSelect3"
                            class="tab-inner-label"
                            >Cohort?</label
                        >

                        <div class="form-group-custom">
                            <input type="checkbox" class="cohort_checkbox" id="html" name="cohort" @if(isset($user->otherInfo->cohort_name) && $user->otherInfo->cohort_name != 'Null') ? checked : ''  @endif />
                            <label for="html">Yes</label>
                        </div>
                    </div>

                    <div class="form-group col-md-4 mt-3 cohort_input no_display">
                        <label
                            for="exampleFormControlSelect3"
                            class="tab-inner-label"
                            >Name of cohort</label
                        >
                        <select
                            class="form-control select-inner-text"
                            id="exampleFormControlSelect1"
                            name="cohort_name"
                        >
                            <option disabled selected value>Select Cohort Name</option>
                            @if(!empty($dropdown[4]->dropdownType))
                            @foreach($dropdown[4]->dropdownType as $val)
                                <option value="{{ $val->id }}" @if(isset($user->otherInfo->cohort_name) && $user->otherInfo->cohort_name == $val->id) ? selected  @endif>{{ $val->name }}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>

                    <div class="form-group col-md-12 mt-3" style="margin-bottom:-21px">
                        <label
                            for="exampleFormControlSelect3"
                            class="tab-inner-label"
                            >Partner</label
                        >

                        <div class="form-group-custom">
                            <input type="checkbox" class="partner_checkbox" id="partner" />
                            <label for="partner">Yes</label>
                        </div>
                    </div>

                    <div class="form-group col-md-4 mt-3 partner_input no_display">
                        <select
                            class="form-control select-inner-text"
                            id="exampleFormControlSelect1"
                            name="partner"
                        >
                            <option disabled selected value>Select Partner</option>
                            @if(!empty($dropdown[17]->dropdownType))
                            @foreach($dropdown[17]->dropdownType as $val)
                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between student-form-action">
                    <button type="submit" class="btn other_information_prev_btn">Previous</button>

                    <button
                        type="submit"
                        id="other_information_btn"
                        class="btn"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
<!-- Add Matched Modal -->
<div class="modal fade" id="match" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Student Already Exist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 
            </div>
            <div class="modal-body">
            <table id="mm-std-List" class="table table-bordered  student_list_table">
            <thead class="s-list-thead">
                <tr>
                    <th scope="col">Surname</th>
                    <th scope="col">DOB</th>
                </tr>
            </thead>
            <tbody id="matched_student"></tbody>
        </table>
            </div>
        </div>
    </div>
</div>
<!-- End Add Attechment Model -->
</div>
<script>
    var val = "<?php echo $user->otherInfo->cohort_name ?? ''; ?>";
    if(val != ''){
        $('body').find('.cohort_input').removeClass('no_display');
    }
    $('.cohort_checkbox').change(function () {
        if (this.checked) {
            $('body').find('.cohort_input').removeClass('no_display');
        }else{
            $('body').find('.cohort_input').addClass('no_display');
        }
    });
    $('.partner_checkbox').change(function () {
        if (this.checked) {
            $('body').find('.partner_input').removeClass('no_display');
        }else{
            $('body').find('.partner_input').addClass('no_display');
        }
    });
    $('#test4').change(function () {
        if (this.checked) {
            document.getElementById('personlist').getElementsByTagName('option')[15].selected = 'selected';
        }
    });
    $('#test3').change(function () {
        if (this.checked) {
            document.getElementById('personlist').getElementsByTagName('option')[1].selected = 'selected';
        }
    });
</script>
<!-- js for coutry code input -->
<script src="{{ asset('admin/countryCodeInput/intlTelInput.min.js') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/js/intlTelInput.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script> -->
<script>

var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
  separateDialCode: true,
  preferredCountries:["sa"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});
var phone_number2 = window.intlTelInput(document.querySelector("#phone_number2"), {
  separateDialCode: true,
  preferredCountries:["au"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

console.log(phone_number2);

// $("form").submit(function() {
// var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
// $("input[name='phone_number[full]'").val(full_number);
//   alert(full_number)
// });
</script>
<!-- end js for coutry code input -->


<script>

    var forEdit = $('body').find('.forEdit').val();
    $(document).on("click", ".tab2", function (e) {
        e.preventDefault();
        var studentInfoTab = $('body').find('.studentInfoTab').val();
        if(forEdit === 'true' || studentInfoTab === 'true'){
            $("body").find("[href='#tabs-1']").removeClass("active");
            $("body").find("#tabs-1").removeClass("active");
            $("body").find("[href='#tabs-3']").removeClass("active");
            $("body").find("#tabs-3").removeClass("active");
            $("body").find("[href='#tabs-4']").removeClass("active");
            $("body").find("#tabs-4").removeClass("active");
            $("body").find("[href='#tabs-2']").addClass("active");
            $("body").find("#tabs-2").addClass("active");
        }
    });
    $(document).on("click", ".tab3", function (e) {
        e.preventDefault();
        var studentConTab = $('body').find('.studentConTab').val();
        if(forEdit === 'true' || studentConTab === 'true'){
            $("body").find("[href='#tabs-3']").addClass("active");
            $("body").find("#tabs-3").addClass("active");
            $("body").find("[href='#tabs-1']").removeClass("active");
            $("body").find("#tabs-1").removeClass("active");
            $("body").find("[href='#tabs-2']").removeClass("active");
            $("body").find("#tabs-2").removeClass("active");
            $("body").find("[href='#tabs-4']").removeClass("active");
            $("body").find("#tabs-4").removeClass("active");
        }
    });
    $(document).on("click", ".tab4", function (e) {
        e.preventDefault();
        if(forEdit === 'true'){
            $("body").find("[href='#tabs-4']").addClass("active");
            $("body").find("#tabs-4").addClass("active");
            $("body").find("[href='#tabs-1']").removeClass("active");
            $("body").find("#tabs-1").removeClass("active");
            $("body").find("[href='#tabs-3']").removeClass("active");
            $("body").find("#tabs-3").removeClass("active");
            $("body").find("[href='#tabs-2']").removeClass("active");
            $("body").find("#tabs-2").removeClass("active");
        }
    });
    // for student information previous button
    $(document).on("click", ".student_information_prev_btn", function (e) {
        e.preventDefault();
        $("body").find("[href='#tabs-2']").removeClass("active");
        $("body").find("#tabs-2").removeClass("active");
        $("body").find("[href='#tabs-1']").addClass("active");
        $("body").find("#tabs-1").addClass("active");
    });
    // for student contact detail previous button
    $(document).on("click", ".contact_detail_prev_btn", function (e) {
        e.preventDefault();
        $("body").find("[href='#tabs-3']").removeClass("active");
        $("body").find("#tabs-3").removeClass("active");
        $("body").find("[href='#tabs-2']").addClass("active");
        $("body").find("#tabs-2").addClass("active");
    });
    // for student other information previous button
    $(document).on("click", ".other_information_prev_btn", function (e) {
        e.preventDefault();
        $("body").find("[href='#tabs-4']").removeClass("active");
        $("body").find("#tabs-4").removeClass("active");
        $("body").find("[href='#tabs-3']").addClass("active");
        $("body").find("#tabs-3").addClass("active");
    });
    // when put value in select remove the errors
    $("select").on("change", function () {
        if ($(this).val()) {
            $(this).removeClass("error");
            var box = $(this).closest("div");
            box.find(".invalid-feedback").css("display", "none");
            box.find("p").text("");
        }
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
    // Add student tab js
    $(document).on("click", "#add_student_btn", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            data: $("#add_student_form").serialize() +
                "&forEdit=" +
                $(".forEdit").val(),
            url: "{{ route('student.store') }}",
            type: "POST",
            dataType: "json",
            beforeSend: function(){
                $('.loader-wrapper').css("display","flex");
            },
            success: function (data) {
                $('body').find('.addStudent_id').val(data);
                // toastr.success("Add Student Successfully");
                $("body").find("[href='#tabs-1']").removeClass("active");
                $("body").find("#tabs-1").removeClass("active");
                $("body").find("[href='#tabs-2']").addClass("active");
                $("body").find("#tabs-2").addClass("active");
            },
            error: function (responce) {
                $.each(responce.responseJSON.errors, function (index, el) {
                    var field = $("body").find("[name='" + index + "']");
                    field.addClass("error");
                    var box = field.closest("div");
                    box.find(".invalid-feedback").css("display", "block");
                    box.find("p").text(el[0]);
                });
            },
            complete: function(){
                $('.loader-wrapper').css("display","none");
            }
        });
    });

    // add student information tab js
    $(document).on("click", "#student_information_btn", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
     var jqXHR= $.ajax({
            url: "{{ route('studentinformation') }}",
            type: "POST",
            data:
                $("#student_information_form").serialize() +
                "&forEdit=" +
                $(".forEdit").val(),
            beforeSend: function(){
                $('.loader-wrapper').css("display","flex");
            },
            success: function (response, status) {
                if(jqXHR.getResponseHeader('content-type').indexOf('text/html') >= 0 ) {
                    $('#matched_student').html(response);
                    $('#match').modal('show');
                }
                else{
                    $('body').find('.studentInfoTab').val('true');
                    $("body").find("[href='#tabs-2']").removeClass("active");
                    $("body").find("#tabs-2").removeClass("active");
                    $("body").find("[href='#tabs-3']").addClass("active");
                    $("body").find("#tabs-3").addClass("active");
                }
                },
                
            // },
            // error: function (responce) {
            //     $.each(responce.responseJSON.errors, function (index, el) {
            //         var field = $("body").find("[name='" + index + "']");
            //         field.addClass("error");
            //         var box = field.closest("div");
            //         box.find(".invalid-feedback").css("display", "block");
            //         box.find("p").text(el[0]);
            //     });
            // },
            complete: function(){
                $('.loader-wrapper').css("display","none");
            }
        });
    });

    // student contact detail tab js
    $(document).on("click", "#contact_detail_btn", function (e) {
        e.preventDefault();
        // below two line for country code input
        var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='phone_number[full]'").val(full_number);

        var full_number = phone_number2.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='phone_number2[full]'").val(full_number);
        // alert(full_number)

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            data:
                $("#contact_detail_form").serialize() +
                "&forEdit=" +
                $(".forEdit").val(),
            url: "{{ route('studentcontactdetail') }}",
            type: "POST",
            dataType: "json",
            // beforeSend: function(){
            //     $('.loader-wrapper').css("display","flex");
            // },
            success: function (data) {
                if(data.error){
                    $('.phone').text(data.error);
                }
                else{

                $('body').find('.studentConTab').val('true');
                // if(data === 'no'){
                //     toastr.error("Kindly Start From Step One");
                // }else{
                    // toastr.success("Add Student Contact Detail Successfully");
                    $("body").find("[href='#tabs-3']").removeClass("active");
                    $("body").find("#tabs-3").removeClass("active");
                    $("body").find("[href='#tabs-4']").addClass("active");
                    $("body").find("#tabs-4").addClass("active");
                }
                // }
            },
            error: function (responce) {
                $.each(responce.responseJSON.errors, function (index, el) {
                    var field = $("body").find("[name='" + index + "']");
                    field.addClass("error");
                    var box = field.closest("div");
                    box.find(".invalid-feedback").css("display", "block");
                    box.find("p").text(el[0]);
                });
            },
            complete: function(){
                $('.loader-wrapper').css("display","none");
            }
        });
    });

    // student other information tab js
    $(document).on("click", "#other_information_btn", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            data:
                $("#other_information_form").serialize() +
                "&forEdit=" +
                $(".forEdit").val(),
            url: "{{ route('studentotherinformation') }}",
            type: "POST",
            dataType: "json",
            beforeSend: function(){
                $('.loader-wrapper').css("display","flex");
            },
            success: function (data) {
                // if(data === 'no'){
                //     toastr.error("Kindly Start From Step One");
                // }else{
                    toastr.success("Student Record Save Successfully");
                    // location.reload();
                    var stuId = $('body').find('.addStudent_id').val();
                    window.location.href = `/student/`+stuId+``;
                // }
            },
            complete: function(){
                $('.loader-wrapper').css("display","none");
            }
        });
    });
    $('.btn-close').on('click',function(){
        $('input:radio').prop('checked',false);        
    })
</script>

@endsection
