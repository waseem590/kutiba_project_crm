@extends('admin.master')
@push('css')

@endpush

@section('content')
    <div class="add-students-section mm-school-main">
        
        <div class="list-std-btns d-flex justify-content-between mr-3">
            <h1 class="page-heading">School Contacts</h1>
            <a href="{{ url()->previous() }}"><i class="fas fa-step-backward"></i> &nbsp; Back</a>
        </div>
        <form class="tab-content" id="school_contact_form" action="{{route('save_school_contacts')}}" method="post">
            @csrf
            <div class="form-row">
                <div class="col-md-6 col-lg-6 col-xl-4 custom_padding">
                    <div class="form-group">
                        <label class="tab-inner-label" for="">Staff Name</label>
                        <input type="text" name="staf_name" class="form-control select-inner-text" placeholder="" />
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 custom_padding">
                    <div class="form-group">
                        <label class="tab-inner-label" for="">Job Title</label>
                        <input type="text" name="job_title" class="form-control select-inner-text" placeholder="" />
                    </div>

                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 custom_padding">
                    <div class="form-group">
                        <label class="tab-inner-label" for="">Institution Name</label>
                        <input type="text" name="institution" class="form-control select-inner-text" placeholder="e.g. Oxford" />
                    </div>

                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 custom_padding">
                    <div class="form-group">
                        <label class="tab-inner-label" for="">Email Address</label>
                        <input type="email" name="email" class="form-control select-inner-text" placeholder="" />
                    </div>

                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 custom_padding">
                    <div class="form-group  school-custom_padding2">
                        <label class="tab-inner-label d-block" for="">Contact Number</label>
                        <!-- <input type="text" class="form-control select-inner-text" placeholder="" /> -->
                        <input class="form-control" type="tel" name="phone_number[]" id="phone_number" />

                    </div>

                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 custom_padding">
                    <div class="form-group  school-custom_padding2">
                        <label class="tab-inner-label" for="">Alternative Contact Number</label>
                        <!-- <input type="text" class="form-control select-inner-text" placeholder="" /> -->
                        <input class="form-control" type="tel" name="phone_number2[main]" id="phone_number2" />
                    </div>

                </div>
                <div class="col-md-6 col-lg-6 col-xl-4 custom_padding">
                    <div class="form-group  school-custom_padding2">
                        <label class="tab-inner-label" for="">DOB</label>
                        <input type="date" name="dob" class="form-control select-inner-text" placeholder="" />
                    </div>

                </div>
                <div class="col-12 custom_padding">
                    <div class="form-group school-notes">
                        <label class="tab-inner-label" for="">Notes</label>
                        <textarea name="notes" class="form-control select-inner-text"></textarea>
                    </div>

                </div>
                <div class="form-group col-md-12 student-form-action">
                    <a href="{{route('school_contacts')}}" class="btn edit_save">Back</a>
                    <button class="btn float-right" type="submit">Submit</button>
                </div>
            </div>

        </form>
    </div>
    <!-- js for coutry code input -->
    <script src="{{ asset('admin/countryCodeInput/intlTelInput.min.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>

<script>

var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
  separateDialCode: true,
  preferredCountries:["in"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

var phone_number2 = window.intlTelInput(document.querySelector("#phone_number2"), {
  separateDialCode: true,
  preferredCountries:["in"],
  hiddenInput: "full",
  utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
});

$("form").submit(function() {
    var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
    $("input[name='phone_number[full]'").val(full_number);
    var full_number = phone_number2.getNumber(intlTelInputUtils.numberFormat.E164);
    $("input[name='phone_number2[full]'").val(full_number);
});


</script>
@endsection
