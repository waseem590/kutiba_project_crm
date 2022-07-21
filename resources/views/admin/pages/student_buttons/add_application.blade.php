@extends('admin.master')
@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/jquery.datetimepicker.css')}}" />
@endpush
@section('content')
<div class="add-students-section">
    <div class="d-flex justify-content-between mr-4">
        <h1 class="page-heading">Add Application</h1>
        <div class="list-std-btns">
            <a class="edit-bg" href="{{route('application',$student_id)}}">Back</a>
        </div>
    </div>
    <form class="add-app-form" action="{{route('save_application')}}" method="post" id="add_application_form">
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
                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach
                        @endif

                    </select>
                    <input type="hidden" name="user_id" value="{{$id ?? ''}}">
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
            <div class="form-group col-sm-6">
                <div class="custom-padd-right displayNone">
                    <label class="tab-inner-label" for="">Duration</label>
                    <input name="duration" type="number" class="form-control select-inner-text" />
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd">
                <div class="custom-padd-left displayNone2">
                    <label class="tab-inner-label" for="122">
                        Start Date</label>
                    <div class="date-container">
                        <input name="duration_start_date" type="text" id="datetimepicker5"
                            class="form-control select-inner-text " autocomplete="off" />
                    </div>

                </div>

            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 custom-padd ">
                <div class="custom-padd-right open-calender">
                    <div class="">
                        <input class="mm-custom-input allcheckbox" type="checkbox" id="c1" />
                        <label class="form-group-custom2 custom-checkbox-1 " for="c1">Certificate 1</label>
                        <div class="date-container displayNone">
                            <input name="certificate1" type="text" id="datetimepicker6"
                                class="form-control select-inner-text" autocomplete="off" />
                        </div>
                    </div>


                </div>

            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left">
                        <input class="mm-custom-input" type="checkbox" id="c2" />
                        <label class="form-group-custom2 custom-checkbox-1" for="c2">Certificate 2</label>
                        <div class="date-container displayNone">
                            <input name="certificate2" type="text" id="datetimepicker2"
                                class="form-control select-inner-text" autocomplete="off" />

                        </div>
                    </div>


                </div>

            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class="custom-padd-right open-calender">
                    <div class="">
                        <input class="mm-custom-input" type="checkbox" id="c3" />
                        <label class="form-group-custom2 custom-checkbox-1" for="c3">Certificate 3</label>
                        <div class="date-container displayNone">
                            <input name="certificate3" type="text" id="datetimepicker3"
                                class="form-control select-inner-text" autocomplete="off" />
                        </div>
                    </div>


                </div>

            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left">
                        <input class="mm-custom-input" type="checkbox" id="c4" />
                        <label class="form-group-custom2 custom-checkbox-1" for="c4">Certificate 4</label>
                        <div class="date-container displayNone">
                            <input name="certificate4" type="text" id="datetimepicker4"
                                class="form-control select-inner-text" autocomplete="off" />
                        </div>
                    </div>


                </div>

            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class="custom-padd-right open-calender">
                    <div class="">
                        <input class="mm-custom-input" type="checkbox" id="c5" />
                        <label class="form-group-custom2 custom-checkbox-1" for="c5">Foundation</label>
                        <div class="date-container displayNone">
                            <input type="text" name="foundation_date" id="datetimepicker5"
                                class="form-control select-inner-text" autocomplete="off" />
                        </div>
                    </div>


                </div>

            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class="custom-padd-left">
                    <input class="mm-custom-input" type="checkbox" id="c6" />
                    <label class="form-group-custom2 custom-checkbox-1" for="c6">Associate Degree</label>
                    <div class="date-container displayNone">
                        <input type="text" name="associate_deg_date" id="datetimepicker6"
                            class="form-control select-inner-text" autocomplete="off" />
                    </div>
                </div>


            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 ">
                <div class="custom-padd-right">
                    <input class="mm-custom-input checkbox2" type="checkbox" id="c61">
                    <label class="form-group-custom2 custom-checkbox-1" for="c61">Diploma</label>
                    <div class=" displayNone">
                        <input type="text" name="diploma_name" class="form-control select-inner-text"
                            placeholder="Course Name">
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left displayNone2">
                        <label class="custom-checkbox-1 tab-inner-label" for="c7">Start Date</label>
                        <div class="date-container">
                            <input type="text" name="diploma_start_date" id="datetimepicker7"
                                class="form-control select-inner-text" autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 ">
                <div class="custom-padd-right">
                    <input class="mm-custom-input checkbox2" type="checkbox" id="c66">
                    <label class="form-group-custom2 custom-checkbox-1" for="c66">Advance Diploma</label>
                    <div class="displayNone">
                        <input type="text" name="advance_diploma_name" class="form-control select-inner-text"
                            placeholder="Course Name">
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left displayNone2">
                        <input class="mm-custom-input" type="checkbox" id="c8">
                        <label class="custom-checkbox-1 tab-inner-label" for="c8">Start Date</label>
                        <div class="date-container">
                            <input type="text" name="advance_diploma_date" id="datetimepicker8"
                                class="form-control select-inner-text" autocomplete="off">
                        </div>
                    </div>


                </div>

            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 ">
                <div class="custom-padd-right">
                    <input class="mm-custom-input checkbox2" type="checkbox" id="c10">
                    <label class="form-group-custom2 custom-checkbox-1" for="c10">Bechelor</label>
                    <div class="displayNone">
                        <input type="text" name="bechelor_deg_name" class="form-control select-inner-text"
                            placeholder="Course Name">
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left displayNone2">
                        <label class="custom-checkbox-1 tab-inner-label" for="c8">Start Date</label>
                        <div class="date-container">
                            <input type="text" name="bechelor_deg_date" id="datetimepicker9"
                                class="form-control select-inner-text" autocomplete="off">
                        </div>
                    </div>


                </div>

            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6 ">
                <div class="custom-padd-right">
                    <input class="mm-custom-input checkbox2" type="checkbox" id="c11">
                    <label class="form-group-custom2 custom-checkbox-1" for="c11">Bechelor Honours</label>
                    <div class="displayNone">
                        <input type="text" name="bechelor_honours_name" class="form-control select-inner-text"
                            placeholder="Course Name">
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left displayNone2">
                        <label class="custom-checkbox-1 tab-inner-label" for="c8">Start Date</label>
                        <div class="date-container">
                            <input type="text" name="bechelor_honours_date" id="datetimepicker10"
                                class="form-control select-inner-text" autocomplete="off">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6 ">
                <div class="custom-padd-right">
                    <input class="mm-custom-input checkbox2" type="checkbox" id="c12">
                    <label class="form-group-custom2 custom-checkbox-1" for="c12">Graduate Diploma</label>
                    <div class="displayNone">
                        <input type="text" name="graduate_diploma_name" class="form-control select-inner-text"
                            placeholder="Course Name">
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left displayNone2">
                        <label class="custom-checkbox-1 tab-inner-label" for="c8">Start Date</label>
                        <div class="date-container">
                            <input type="text" name="graduate_diploma_date" id="datetimepicker11"
                                class="form-control select-inner-text" autocomplete="off">
                        </div>
                    </div>


                </div>

            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6 ">
                <div class="custom-padd-right">
                    <input class="mm-custom-input checkbox2" type="checkbox" id="c13">
                    <label class="form-group-custom2 custom-checkbox-1" for="c13">Master's Degree</label>
                    <div class="displayNone">
                        <input type="text" name="master_deg_name" class="form-control select-inner-text"
                            placeholder="Course Name">
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left displayNone2">
                        <label class="custom-checkbox-1  tab-inner-label" for="c8">Start Date</label>
                        <div class="date-container">
                            <input type="text" name="master_deg_date" id="datetimepicker12"
                                class="form-control select-inner-text" autocomplete="off">
                        </div>
                    </div>


                </div>

            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6 ">
                <div class="custom-padd-right">
                    <input class="mm-custom-input checkbox2" type="checkbox" id="c14">
                    <label class="form-group-custom2 custom-checkbox-1" for="c14">Doctoral Degree</label>
                    <div class="displayNone">
                        <input type="text" name="doctoral_deg_name" class="form-control select-inner-text"
                            placeholder="Course Name">
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left displayNone2">
                        <label class="custom-checkbox-1  tab-inner-label" for="c8">Start Date</label>
                        <div class="date-container">
                            <input type="text" name="doctoral_deg_date" id="datetimepicker13"
                                class="form-control select-inner-text" autocomplete="off">
                        </div>
                    </div>


                </div>

            </div>
        </div>





        <div class="row">
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-right">
                        <input class="mm-custom-input" type="checkbox" id="c109">
                        <label class="form-group-custom2 custom-checkbox-1" for="c109">Primary School</label>
                        <div class="date-container displayNone">
                            <input type="text" name="primary_school" id="datetimepicker14"
                                class="form-control select-inner-text" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-6 custom-padd  calender-relative">
                <div class=" open-calender">
                    <div class="custom-padd-left">
                        <input class="mm-custom-input" type="checkbox" id="c17">
                        <label class="form-group-custom2 custom-checkbox-1" for="c17">High School</label>
                        <div class="date-container displayNone">
                            <input type="text" name="high_school" id="datetimepicker15"
                                class="form-control select-inner-text" autocomplete="off">
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
