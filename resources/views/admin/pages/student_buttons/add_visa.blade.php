@extends('admin.master')
@push('css')
<style>
    .datetimepicker {
        background:url('{{asset("images/calender.png")}}');
        background-repeat: no-repeat;
        background-position: 95%;

    }

    .existing_student {
        display: none;
    }

    .new_student_input {
        display: none;
    }

    .margin_top {}

</style>
@endpush

@section('content')
<div class="add-students-section">
    <h1 class="page-heading main_heading_h1" >Add Visa</h1>
    <form class="tab-content add-visa-form" method="POST" action="{{route('store.visa')}}" id="visa_form">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1" class="tab-inner-label">Case officer</label>
                <select class="form-control select-inner-text" id="exampleFormControlSelect1" name="case_officer">
                    <option disabled="" selected="">Select</option>
                    @foreach($case_officers as $case_officer)
                    <option value="{{$case_officer->id}}">{{$case_officer->name}}</option>
                    @endforeach


                </select>
            </div>
            <div class="form-group col-md-8 d-flex mm-advisacheck">
                <div class="form-group-custom custom-checkbox-1">
                    <input type="checkbox" id="html" name="student" class="student" />
                    <label for="html">New student</label>
                </div>
                <div class="form-group-custom custom-checkbox-1 ml-3">
                    <input type="checkbox" id="old_html" name="student" class="student" />
                    <label for="old_html">Existing Student</label>
                </div>

            </div>
            <div class="col-md-4 existing_student mt-3">
                <label for="exampleFormControlSelect1" class="tab-inner-label">Student Name</label>
                <input list="student_name_list" name="student_name" class="form-control select-inner-text">
                <datalist id="student_name_list">
                    <option disabled selected value="Select Student">Select Student</option>
                    @foreach($students as $student)
                    @if($student->info)
                    <option value="{{$student->id}}">{{$student->info['name']}}-{{$student->id ?? ''}}</option>
                    @endif
                    @endforeach
                </datalist>

            </div>
            <div class="col-md-4 col-lg-4 new_student_input">
                <label class="tab-inner-label" for="">Full name</label>
                <input type="text" class="form-control select-inner-text " placeholder="" name="name" />
            </div>
            <div class="col-md-4 col-lg-4 new_student_input">
                <label class="tab-inner-label" for="">Contact Number</label>
                <!-- <input type="text" class="form-control select-inner-text" placeholder="" name="contact_number"/> -->
                <input class="form-control" type="tel" name="phone_number" id="phone_number" />
            </div>
            <div class="col-md-4 col-lg-4 new_student_input">
                <label class="tab-inner-label" for="">Email address</label>
                <input type="text" class="form-control select-inner-text" placeholder="" name="email" />
            </div>
            <div class="form-group col-md-4 mt-3 new_student_input">
                <label for="exampleFormControlSelect3" class="tab-inner-label">Nationality</label>
                <select class="form-control select-inner-text" id="exampleFormControlSelect1" name="nationality">
                    <option disabled="" selected value="">Select Country</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" @if(isset($user->info->nationality) && $user->info->nationality
                        == $country->id) ? selected @endif>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- <div class="col-md-4 col-lg-4  calender-relative mt-3">
                <label class="tab-inner-label" for="122">
                    Date of Visa Application</label>
                <input type="text" id="datetimepicker" autocomplete="off" class="form-control select-inner-text datetimepicker"
                    placeholder="11/18/2021" name="date_visa"/>
            </div> -->
            <div class="form-group col-md-4 mt-3">
                <label for="exampleFormControlSelect1" class="tab-inner-label">Visa Type</label>
                <select class="form-control select-inner-text" id="exampleFormControlSelect1" name="visa_type">
                    <option disabled="" selected="">Select</option>
                    @foreach($visa_type as $visa_ty)
                    <option value="{{$visa_ty->id}}">{{$visa_ty->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 col-md-4 mt-3">
                <label class="tab-inner-label" for="">Number of Applicants</label>
                <input type="text" class="form-control select-inner-text" placeholder="" name="num_applicants" />
            </div>
            <div class="form-group col-md-4 mt-3 status_margin">
                <label for="exampleFormControlSelect1" class="tab-inner-label">Status</label>
                <select class="form-control select-inner-text" id="exampleFormControlSelect1" name="visa_status">
                    <option disabled="" selected="">Select Student</option>
                    @foreach($status as $sta)
                    <option value="{{$sta->id}}">{{$sta->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-4 col-md-4  calender-relative margin_top">
                <label class="tab-inner-label" for="122">Visa Expiry Date</label>
                <input type="text" id="datetimepicker" autocomplete="off"
                    class="form-control select-inner-text datetimepicker" name="visa_expire_date"
                    placeholder="11/18/2021" />
            </div>
            <div class="col-md-4 col-md-4 margin_top">
                <label class="tab-inner-label" for="">Immigration Fees</label>
                <input type="text" class="form-control select-inner-text" placeholder="" name="immigration_fees" />
            </div>
            <div class="form-group col-md-4" id="immigeration_payment_method">
                <label for="exampleFormControlSelect1" class="tab-inner-label">Payment Method</label>
                <select class="form-control select-inner-text" id="exampleFormControlSelect1"
                    name="immigration_pay_method">
                    <option disabled="" selected="">Select</option>
                    @foreach($immigeration_pay_method as $immigeration)
                    <option value="{{$immigeration->id}}">{{$immigeration->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-4 col-md-4  calender-relative">
                <label class="tab-inner-label" for="122">
                    Date of Payment</label>
                <input type="text" id="datetimepicker" autocomplete="off"
                    class="form-control select-inner-text datetimepicker" name="immigration_dop"
                    placeholder="11/18/2021" />
            </div>
            <div class="col-md-4 col-md-4">
                <label class="tab-inner-label" for="">Service Fee</label>
                <input type="text" class="form-control select-inner-text" placeholder="" name="service_fee" />
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1" class="tab-inner-label">Payment Method</label>
                <select class="form-control select-inner-text" id="exampleFormControlSelect1" name="service_pay_method">
                    <option disabled="" selected="">Select</option>
                    @foreach($service_pay_method as $service)
                    <option value="{{$service->id}}">{{$service->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-4 col-md-4  calender-relative calender-relative-1">
                <label class="tab-inner-label" for="122">
                    Date of Payment</label>
                <input type="text" id="datetimepicker" autocomplete="off"
                    class="form-control select-inner-text datetimepicker" name="service_dop" placeholder="11/18/2021" />
            </div>
            <div class="form-group col-md-12 d-flex flex-row-reverse student-form-action">
                <button class="btn " type="submit" href="#tabs-1">Submit</button>
            </div>
        </div>
        <div class="form-row"></div>
    </form>

</div>
@endsection
@push('js')
<!-- js for coutry code input -->
<script src="{{ asset('admin/countryCodeInput/intlTelInput.min.js') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />

<script>
    var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
        separateDialCode: true,
        preferredCountries: ["in"],
        hiddenInput: "contact_number",
        utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
    });

    $("form").submit(function () {
        var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E_164);
        $("input[name='contact_number'").val(full_number);
    });

</script>

<script>
    $('.student').on('change', function () {
        $('.student').not(this).prop('checked', false);
    });

</script>
<script>
    $('.datetimepicker').on('click', function () {
        $(this).datetimepicker({
            timepicker: false,
            format: 'd/m/Y',
            minDate: 0,
        });
    });
    $('.image').on('click', function () {
        $(this).datetimepicker({
            timepicker: false,
            format: 'd/m/Y',
        });
    });

</script>
<script>
    $('#old_html').on('change', function () {
        if (this.checked) {
            $('.existing_student').css('display', 'block');
            $('.new_student_input').css('display', 'none');
            $('.no_of_app').removeClass('mt-3');
            $('.margin_top').addClass('mt-3');
        } else {
            $('.new_student_input').css('display', 'none');
            $('.existing_student').css('display', 'none');
            $('.no_of_app').addClass('mt-3');
            $('.margin_top').removeClass('mt-3');
        }
    });
    $('#html').on('change', function () {
        if (this.checked) {
            $('.existing_student').css('display', 'none');
            $('.new_student_input').css('display', 'inline-block');
            $('.no_of_app').addClass('mt-3');
            $('.margin_top').removeClass('mt-3');
            $('.status_margin').removeClass('mt-3');


        } else {
            $('.new_student_input').css('display', 'none');
            $('.existing_student').css('display', 'none');
            $('.no_of_app').addClass('mt-3');
            $('.status_margin').addClass('mt-3');
        }
    });

</script>

@endpush
