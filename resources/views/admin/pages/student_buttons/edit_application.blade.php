@extends('admin.master')
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/jquery.datetimepicker.css')}}" />
@endpush
@section('content')
<div class="add-students-section">
    <h1 class="page-heading">Edit Application Form</h1>
    <form class="add-app-form" action="{{route('update_application')}}" method="post" id="add_application_form">
        @csrf
        <div class="row">
            <div class="form-group col-sm-6">
                <div class="custom-padd-right">
                    <label for="exampleFormControlSelect1" class="tab-inner-label">Study
                        Destination</label>
                    <select name="destination" class="form-control select-inner-text" id="exampleFormControlSelect1">
                        <option disabled selected value>
                            Select Study Destination
                        </option>
                        @if(!empty($dropdown[5]->dropdownType))
                            @foreach($dropdown[5]->dropdownType as $val)
                                <option value="{{ $val->id }}" @if(isset($applications->study_dest) && $applications->study_dest == $val->id) ? selected  @endif>{{ $val->name }}</option>
                            @endforeach
                        @endif

                    </select>
                    <input type="hidden" name="applications_id" value="{{$applications->id ?? ''}}">
                    <input type="hidden" name="special_education_id" value="{{$applications->special_education->id ?? ''}}">
                    <input type="hidden" name="education_id" value="{{$applications->education->id ?? ''}}">
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd">
                <div class="custom-padd-left">
                    <label for="exampleFormControlSelect1" class="tab-inner-label">Institution
                        Name</label>
                    <select name="institute_name" class="form-control select-inner-text" id="exampleFormControlSelect1">
                        <option disabled selected value>
                            Select Institute Name
                        </option>
                        @if(!empty($dropdown[6]->dropdownType))
                            @foreach($dropdown[6]->dropdownType as $val)
                                <option value="{{ $val->id }}" @if(isset($applications->inst_name) && $applications->inst_name == $val->id) ? selected  @endif>{{ $val->name }}</option>
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

                <div class="form-group-custom custom-checkbox-1 ml-3">
                    <input class="checkbox2" name="eng" type="checkbox" id="eng" checked />
                    <label for="eng">English</label>
                </div>

            </div>
            <div class="form-group col-sm-6">
                <div class="custom-padd-right editDisplayNone">
                    <label class="tab-inner-label" for="">Duration</label>
                    <input name="duration" value="{{$applications->duration ?? ''}}" type="text" id="datetimepicker1" class="form-control select-inner-text"
                        placeholder="00:00" />
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd">
                <div class="custom-padd-left editDisplayNone2">
                    <label class="tab-inner-label" for="122">
                        Start Date</label>
                    <div class="date-container">
                        <input name="duration_start_date" value="{{$applications->start_date ?? ''}}" type="text" id="datetimepicker5" class="form-control select-inner-text "
                            autocomplete="off" />
                    </div>

                </div>

            </div>
        </div>
            <div class="row">
            <div class="form-group col-sm-6 custom-padd ">
                <div class="custom-padd-right open-calender">
                    <div class="">
                        <input class="mm-custom-input allcheckbox" type="checkbox" id="c1" checked/>
                        <label class="form-group-custom2 custom-checkbox-1 " for="c1">Certificate 1</label>
                        <div class="date-container editDisplayNone">
                        <input name="certificate1" value="{{$applications->special_education->certificate_1 ?? ''}}" type="text" id="datetimepicker6" class="form-control select-inner-text"
                            autocomplete="off" />
                    </div>
                    </div>


                </div>

            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left">
                        <input class="mm-custom-input" type="checkbox" id="c2" checked/>
                        <label class="form-group-custom2 custom-checkbox-1" for="c2">Certificate 2</label>
                        <div class="date-container editDisplayNone">
                        <input name="certificate2" value="{{$applications->special_education->certificate_2 ?? ''}}" type="text" id="datetimepicker2" class="form-control select-inner-text"
                            autocomplete="off" />

                    </div>
                    </div>


                </div>

            </div>
        </div>
            <div class="row">
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class="custom-padd-right open-calender">
                    <div class="">
                        <input class="mm-custom-input" type="checkbox" id="c3" checked/>
                        <label class="form-group-custom2 custom-checkbox-1" for="c3">Certificate 3</label>
                        <div class="date-container editDisplayNone">
                        <input name="certificate3" value="{{$applications->special_education->certificate_3 ?? ''}}" type="text" id="datetimepicker3" class="form-control select-inner-text"
                            autocomplete="off" />
                    </div>
                    </div>


                </div>

            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left">
                        <input class="mm-custom-input" type="checkbox" id="c4" checked/>
                        <label class="form-group-custom2 custom-checkbox-1" for="c4">Certificate 4</label>
                        <div class="date-container editDisplayNone">
                        <input name="certificate4" value="{{$applications->special_education->certificate_4 ?? ''}}" type="text" id="datetimepicker4" class="form-control select-inner-text"
                            autocomplete="off" />
                    </div>
                    </div>


                </div>

            </div>
        </div>
            <div class="row">
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class="custom-padd-right open-calender">
                    <div class="">
                        <input class="mm-custom-input" type="checkbox" id="c5" checked/>
                        <label class="form-group-custom2 custom-checkbox-1" for="c5">Foundation</label>
                        <div class="date-container editDisplayNone">
                        <input type="text" value="{{$applications->special_education->foundation ?? ''}}" name="foundation_date" id="datetimepicker5" class="form-control select-inner-text"
                            autocomplete="off" />
                    </div>
                    </div>


                </div>

            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                    <div class="custom-padd-left">
                        <input class="mm-custom-input" type="checkbox" id="c6" checked/>
                        <label class="form-group-custom2 custom-checkbox-1" for="c6">Associate Degree</label>
                        <div class="date-container editDisplayNone">
                        <input type="text" value="{{$applications->special_education->associate_degree ?? ''}}" name="associate_deg_date" id="datetimepicker6" class="form-control select-inner-text"
                            autocomplete="off" />
                        </div>
                    </div>


            </div>
            </div>
            <div class="row">
            <div class="form-group col-sm-6 ">
                <div class="custom-padd-right">
                    <input class="mm-custom-input checkbox2" type="checkbox" id="c61" checked>
                    <label class="form-group-custom2 custom-checkbox-1" for="c61">Diploma</label>
                    <div class=" editDisplayNone">
                    <input type="text" value="{{$applications->education->diploma ?? ''}}" name="diploma_name" class="form-control select-inner-text" placeholder="Course Name">
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left editDisplayNone2">
                        <label class="custom-checkbox-1 tab-inner-label" for="c7">Start Date</label>
                        <div class="date-container">
                        <input type="text" value="{{$applications->education->d_start_date ?? ''}}" name="diploma_start_date" id="datetimepicker7" class="form-control select-inner-text"
                            autocomplete="off" />
                    </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="form-group col-sm-6 ">
                <div class="custom-padd-right">
                    <input class="mm-custom-input checkbox2" type="checkbox" id="c66" checked>
                    <label class="form-group-custom2 custom-checkbox-1" for="c66">Advance Diploma</label>
                    <div class="editDisplayNone">
                    <input type="text" value="{{$applications->education->advance_diploma ?? ''}}" name="advance_diploma_name" class="form-control select-inner-text" placeholder="Course Name">
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left editDisplayNone2">
                        <input class="mm-custom-input" type="checkbox" id="c8" checked>
                        <label class="custom-checkbox-1 tab-inner-label" for="c8">Start Date</label>
                        <div class="date-container">
                        <input type="text" value="{{$applications->education->ad_start_date ?? ''}}" name="advance_diploma_date" id="datetimepicker8" class="form-control select-inner-text" autocomplete="off">
                    </div>
                    </div>


                </div>

            </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6 ">
                    <div class="custom-padd-right">
                        <input class="mm-custom-input checkbox2" type="checkbox" id="c10" checked>
                        <label class="form-group-custom2 custom-checkbox-1" for="c10">Bechelor</label>
                        <div class="editDisplayNone">
                        <input type="text" value="{{$applications->education->bachelor ?? ''}}" name="bechelor_deg_name" class="form-control select-inner-text" placeholder="Course Name">
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-6 custom-padd  calender-relative">
                    <div class=" open-calender">
                        <div class="custom-padd-left editDisplayNone2">
                            <label class="custom-checkbox-1 tab-inner-label" for="c8">Start Date</label>
                            <div class="date-container">
                            <input type="text" value="{{$applications->education->b_start_date ?? ''}}" name="bechelor_deg_date" id="datetimepicker9" class="form-control select-inner-text" autocomplete="off">
                        </div>
                        </div>


                    </div>

                </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6 ">
                        <div class="custom-padd-right">
                            <input class="mm-custom-input checkbox2" type="checkbox" id="c11" checked>
                            <label class="form-group-custom2 custom-checkbox-1" for="c11">Bechelor Honours</label>
                            <div class="editDisplayNone">
                            <input type="text" value="{{$applications->education->bachelor_hons ?? ''}}" name="bechelor_honours_name" class="form-control select-inner-text" placeholder="Course Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 custom-padd  calender-relative">
                        <div class=" open-calender">
                            <div class="custom-padd-left editDisplayNone2">
                                <label class="custom-checkbox-1 tab-inner-label" for="c8">Start Date</label>
                                <div class="date-container">
                                <input type="text" value="{{$applications->education->bh_start_date ?? ''}}" name="bechelor_honours_date" id="datetimepicker10" class="form-control select-inner-text" autocomplete="off">
                            </div>
                            </div>


                        </div>

                    </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6 ">
                            <div class="custom-padd-right">
                                <input class="mm-custom-input checkbox2" type="checkbox" id="c12" checked>
                                <label class="form-group-custom2 custom-checkbox-1" for="c12">Graduate Diploma</label>
                                <div class="editDisplayNone">
                                <input type="text" value="{{$applications->education->graduate_diploma ?? ''}}" name="graduate_diploma_name" class="form-control select-inner-text" placeholder="Course Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6 custom-padd  calender-relative">
                            <div class=" open-calender">
                                <div class="custom-padd-left editDisplayNone2">
                                    <label class="custom-checkbox-1 tab-inner-label" for="c8">Start Date</label>
                                    <div class="date-container">
                                    <input type="text" value="{{$applications->education->gd_start_date ?? ''}}" name="graduate_diploma_date" id="datetimepicker11" class="form-control select-inner-text" autocomplete="off">
                                </div>
                                </div>


                            </div>

                        </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6 ">
                                <div class="custom-padd-right">
                                    <input class="mm-custom-input checkbox2" type="checkbox" id="c13" checked>
                                    <label class="form-group-custom2 custom-checkbox-1" for="c13">Master's Degree</label>
                                    <div class="editDisplayNone">
                                    <input type="text" value="{{$applications->education->masters_degree ?? ''}}" name="master_deg_name" class="form-control select-inner-text" placeholder="Course Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 custom-padd  calender-relative">
                                <div class=" open-calender">
                                    <div class="custom-padd-left editDisplayNone2">
                                        <label class="custom-checkbox-1  tab-inner-label" for="c8">Start Date</label>
                                        <div class="date-container">
                                        <input type="text" value="{{$applications->education->md_start_date ?? ''}}" name="master_deg_date" id="datetimepicker12" class="form-control select-inner-text" autocomplete="off">
                                    </div>
                                    </div>


                                </div>

                            </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-6 ">
                                    <div class="custom-padd-right">
                                        <input class="mm-custom-input checkbox2" type="checkbox" id="c14" checked>
                                        <label class="form-group-custom2 custom-checkbox-1" for="c14">Doctoral Degree</label>
                                        <div class="editDisplayNone">
                                        <input type="text" value="{{$applications->education->doctoral_degree ?? ''}}" name="doctoral_deg_name" class="form-control select-inner-text" placeholder="Course Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 custom-padd  calender-relative">
                                    <div class=" open-calender">
                                        <div class="custom-padd-left editDisplayNone2">
                                            <label class="custom-checkbox-1  tab-inner-label" for="c8">Start Date</label>
                                            <div class="date-container">
                                            <input type="text" value="{{$applications->education->dd_start_date ?? ''}}" name="doctoral_deg_date" id="datetimepicker13" class="form-control select-inner-text" autocomplete="off">
                                        </div>
                                        </div>


                                    </div>

                                </div>
                                </div>





            <div class="row">
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-right">
                        <input class="mm-custom-input" type="checkbox" id="c109" checked>
                        <label class="form-group-custom2 custom-checkbox-1" for="c109">Primary School</label>
                        <div class="date-container editDisplayNone">
                        <input type="text" value="{{$applications->education->primary_school ?? ''}}" name="primary_school" id="datetimepicker14" class="form-control select-inner-text" autocomplete="off">
                    </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left">
                        <input class="mm-custom-input" type="checkbox" id="c17" checked>
                        <label class="form-group-custom2 custom-checkbox-1" for="c17">High School</label>
                        <div class="date-container editDisplayNone">
                        <input type="text" value="{{$applications->education->high_school ?? ''}}" name="high_school" id="datetimepicker15" class="form-control select-inner-text" autocomplete="off">
                    </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="form-group col-md-12 d-flex  student-form-action add-app-submit">
                <button class="btn " href="#tabs-1">Submit</button>
            </div>
        </div>
        <div class="form-row"></div>
    </form>
    <p id="time"></p>
</div>


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
    <script>
        $('#datetimepicker1').datetimepicker({
            datepicker: false,
            format: 'H:i',
            step: 5
        });
    </script>
    <script>
        $(function () {
            $('#datetimepicker2, #datetimepicker3, #datetimepicker4, #datetimepicker5, #datetimepicker6, #datetimepicker7, #datetimepicker8, #datetimepicker9, #datetimepicker10, #datetimepicker11, #datetimepicker12, #datetimepicker13, #datetimepicker14, #datetimepicker15, #datetimepicker16, #datetimepicker17').datetimepicker({
                timepicker: false,
                format: 'd-m-Y'
            });

            $('.date-icon').on('click', function () {
                $('#datetimepicker2').focus();
            })
        });
    </script>


<script>
    $(document).ready(function () {
        $('.mm-custom-input').change(function () {
            if (!this.checked) {
                var editDisplayNone = $(this).closest('div').find('.editDisplayNone');
                editDisplayNone.hide();
                editDisplayNone.find('.select-inner-text').val('');
            } else {
                $(this).closest('div').find('.editDisplayNone').show();
            }
        });
        $('.checkbox2').change(function () {
            if (!this.checked) {
                var editDisplayNone = $(this).closest('.row').find('.editDisplayNone');
                editDisplayNone.hide();
                editDisplayNone.find('.select-inner-text').val('');
                var editDisplayNone2 = $(this).closest('.row').find('.editDisplayNone2');
                editDisplayNone2.hide();
                editDisplayNone2.find('.select-inner-text').val('');
            } else {
                $(this).closest('.row').find('.editDisplayNone2').show();
                $(this).closest('.row').find('.editDisplayNone').show();
            }
        });
    });
</script>
@endpush
