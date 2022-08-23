@extends('admin.master')
@push('css')
    <style>
        .datetimepicker {
            background: url('{{ asset('images/calender.png') }}');
            background-repeat: no-repeat;
            background-position: 95%;

        }

        /* .existing_student{
                    display:none;
                } */
        /* .new_student_input{
                    display: none;
                } */
    </style>
@endpush

@section('content')
    <div class="add-students-section">
        <h1 class="page-heading">Edit Visa</h1>
        <form class="tab-content" method="POST" action="{{ route('update.visa', $visa->id) }}" id="visa_form">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1" class="tab-inner-label">Case officer</label>
                    <select class="form-control select-inner-text @error('case_officer') is-invalid @enderror"
                        id="exampleFormControlSelect1" name="case_officer">
                        <option disabled="" selected="">Select</option>
                        @foreach ($case_officers as $case_officer)
                            <option value="{{ $case_officer->id }}" @if ($case_officer->id == $visa->case_officer) selected @endif>
                                {{ $case_officer->name }}</option>
                        @endforeach


                    </select>
                    @error('case_officer')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-8 d-flex" style="position: relative; top: 40px;">
                    <div class="form-group-custom custom-checkbox-1">
                        <!-- <input type="checkbox" id="html" name="student" class="student"/>
                                <label for="html">New student</label> -->
                    </div>
                    <div class="form-group-custom custom-checkbox-1 ml-3">
                        <!-- <input type="checkbox" id="old_html" name="student" class="student" />
                                <label for="old_html">Existing Student</label> -->
                    </div>

                </div>
                <div class="col-md-4 col-lg-4 new_student_input">
                    <label class="tab-inner-label" for="">Full name</label>
                    <input type="hidden" class="form-control select-inner-text @error('student_id') is-invalid @enderror"
                        placeholder="" name="student_id" value="{{ $visa->student['id'] }}" />
                    <input type="text" class="form-control select-inner-text @error('name') is-invalid @enderror"
                        placeholder="" name="name" value="{{ $visa->student->info['name'] }}" />
                    @error('student_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 col-lg-4 new_student_input">
                    <label class="tab-inner-label" for="">Contact Number</label>
                    <!-- <input type="text" class="form-control select-inner-text" placeholder="" name="contact_number"/> -->
                    <input class="form-control @error('phone_number') is-invalid @enderror" type="tel"
                        name="phone_number" id="phone_number" value="{{ $visa->student->contact['contact_number'] }}" />
                    @error('phone_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 col-lg-4 new_student_input">
                    <label class="tab-inner-label" for="">Email address</label>
                    <input type="text" class="form-control select-inner-text @error('email') is-invalid @enderror"
                        placeholder="" name="email" value="{{ $visa->student->contact['email'] }}" />
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- <div class="col-md-4 col-lg-4  calender-relative mt-3">
                            <label class="tab-inner-label" for="122">
                                Date of Visa Application</label>
                            <input type="text" id="datetimepicker" autocomplete="off"
                                class="form-control select-inner-text datetimepicker" placeholder="11/18/2021" name="date_visa"
                                value="{{ $visa->date_visa }}" />
                        </div> -->
                <div class="form-group col-md-4 mt-3">
                    <label for="exampleFormControlSelect1" class="tab-inner-label">Visa Type</label>
                    <select class="form-control select-inner-text @error('visa_type') is-invalid @enderror"
                        id="exampleFormControlSelect1" name="visa_type">
                        <option disabled="" selected="">Select</option>
                        @foreach ($visa_type as $visa_ty)
                            <option value="{{ $visa_ty->id }}" @if ($visa_ty->id == $visa->visa_type) selected @endif>
                                {{ $visa_ty->name }}</option>
                        @endforeach
                    </select>
                    @error('visa_type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 col-md-4 mt-3 no_of_app">
                    <label class="tab-inner-label" for="">Number of Applicants</label>
                    <input type="text"
                        class="form-control select-inner-text @error('num_applicants') is-invalid @enderror" placeholder=""
                        name="num_applicants" value="{{ $visa->num_applicants }}" />
                    @error('num_applicants')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4 mt-3">
                    <label for="exampleFormControlSelect1" class="tab-inner-label">Status</label>
                    <select class="form-control select-inner-text @error('visa_status') is-invalid @enderror"
                        id="exampleFormControlSelect1" name="visa_status">
                        <option disabled="" selected="">Select Student</option>
                        @foreach ($status as $sta)
                            <option value="{{ $sta->id }}" @if ($sta->id == $visa->visa_status) selected @endif>
                                {{ $sta->name }}
                            </option>
                        @endforeach

                    </select>
                    @error('visa_status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 col-md-4  calender-relative margin_top">
                    <label class="tab-inner-label" for="visa_expire_date">Visa Expiry Dates</label>
                    <input type="" autocomplete="off" id="visa_expire_date"
                        class="form-control select-inner-text datetimepicker @error('visa_expire_date') is-invalid @enderror"
                        name="visa_expire_date" value="{{ $visa->visa_expire_date }}" />
                    @error('visa_expire_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 col-md-4">
                    <label class="tab-inner-label" for="">Immigration Fees</label>
                    <input type="text"
                        class="form-control select-inner-text datetimepicker @error('immigration_fees') is-invalid @enderror"
                        name="immigration_fees" value="{{ $visa->immigration_fees }}" />
                    @error('immigration_fees')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4 ">
                    <label for="exampleFormControlSelect1" class="tab-inner-label">Payment Method</label>
                    <select class="form-control select-inner-text @error('immigration_pay_method') is-invalid @enderror"
                        id="exampleFormControlSelect1" name="immigration_pay_method">
                        <option disabled="" selected="">Select</option>
                        @foreach ($immigeration_pay_method as $immigeration)
                            <option value="{{ $immigeration->id }}" @if ($immigeration->id == $visa->immigration_pay_method) selected @endif>
                                {{ $immigeration->name }}</option>
                        @endforeach

                    </select>
                    @error('immigration_pay_method')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 col-md-4  calender-relative">
                    <label class="tab-inner-label" for="122">
                        Date of Payment</label>
                    <input type="text" id="datetimepicker" autocomplete="off"
                        class="form-control select-inner-text datetimepicker @error('immigration_dop') is-invalid @enderror"
                        name="immigration_dop" placeholder="11/18/2021" value="{{ $visa->immigration_dop }}" />
                    @error('immigration_dop')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 col-md-4">
                    <label class="tab-inner-label" for="">Service Fee</label>
                    <input type="text"
                        class="form-control select-inner-text @error('service_fee') is-invalid @enderror" placeholder=""
                        name="service_fee" value="{{ $visa->service_fee }}" />
                    @error('service_fee')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlSelect1" class="tab-inner-label">Payment Method</label>
                    <select class="form-control select-inner-text @error('service_pay_method') is-invalid @enderror"
                        id="exampleFormControlSelect1" name="service_pay_method">
                        <option disabled="" selected="">Select</option>
                        @foreach ($service_pay_method as $service)
                            <option value="{{ $service->id }}" @if ($service->id == $visa->service_pay_method) selected @endif>
                                {{ $service->name }}</option>
                        @endforeach
                    </select>
                    @error('service_pay_method')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 col-md-4  calender-relative calender-relative-1">
                    <label class="tab-inner-label" for="122">
                        Date of Payment</label>
                    <input type="text" id="datetimepicker" autocomplete="off"
                        class="form-control select-inner-text datetimepicker @error('service_dop') is-invalid @enderror"
                        name="service_dop" placeholder="11/18/2021" value="{{ $visa->service_dop }}" />
                    @error('service_dop')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
    <script src="{{ asset('admin/countryCodeInput/intlTelInput.min.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />

    <script>
        var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
            separateDialCode: true,
            preferredCountries: ["in"],
            hiddenInput: "contact_number",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });

        $("form").submit(function() {
            var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E_164);
            $("input[name='contact_number'").val(full_number);
        });
    </script>
    <script>
        $('.student').on('change', function() {
            $('.student').not(this).prop('checked', false);
        });
    </script>
    <script>
        console.log($('.datetimepicker').attr('id'));

        $('.datetimepicker').on('click', function() {
            $(this).datetimepicker({
                timepicker: false,
                format: 'd/m/Y',
            });
        });
        $('.image').on('click', function() {
            $(this).datetimepicker({
                timepicker: false,
                format: 'd/m/Y',
            });
        });
    </script>
    <script>
        $('#old_html').on('change', function() {
            $('.existing_student').css('display', 'block');
            $('.new_student_input').css('display', 'none');
            $('.no_of_app').removeClass('mt-3');
        });
        $('#html').on('change', function() {
            $('.existing_student').css('display', 'none');
            $('.new_student_input').css('display', 'inline-block');
            $('.no_of_app').addClass('mt-3');
        });
    </script>
@endpush
