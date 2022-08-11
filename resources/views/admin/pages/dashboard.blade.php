@extends('admin.master')
@push('css')
    <link href="{{ asset('admin/css/clock.css') }}" rel="stylesheet" />
    <!-- <link href="{{ asset('admin/css/calendar.css') }}" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://zulns.github.io/w3css/w3.css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <style>
        .custom-cards.mm-caleder-outer {

            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-left: 5px solid #624f8e;
            text-align: center;
            height: min-content !important;
            position: relative;
        }

        .custom-cards.mm-caleder-outer .custom-card-body {
            position: absolute;
            top: 50%;
            transform: translate(0, -50%);
            width: 100%;
            color: #624f8e;
        }

        div#calendar {
            font-size: 25px;
            font-family: "Segoe UI", Arial, sans-serif;
            font-weight: 400;
        }

        div#calendarr {
            font-size: 25px;
            font-weight: 400;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .w3-bar-item input[type=radio],
        .w3-bar-item label {
            cursor: pointer
        }

        .w3-bar-item:focus-within {
            border-color: #2196F3 !important
        }

        .w3-small {
            display: none
        }

        .w3-xlarge {
            font-size: 13px !important;
        }

        .w3-cell {
            font-size: 13px !important;
        }

        .w3-display-container {
            height: 55px !important;
        }

        .w3-xxlarge {
            font-size: 18px !important;
        }

        .w3-ripple>svg {}

        .mm-caleder .w3-btn,
        .mm-caleder .w3-button {
            padding: 0px 16px;
        }




        .w3-display-container {
            background: #614f8e !important;
        }

        .w3-button:hover {
            color: #fff !important;
            background-color: #f5981f !important;
        }

        .w3-margin-top {
            margin-top: unset !important;
        }


        .w3 {
            color: #fff !important;
        }


        .clock {
            position: absolute;
            white-space: nowrap;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            color: #2c2c2c;
            font-size: 25px;
            font-weight: 300;
            font-family: Orbitron;
            letter-spacing: 7px;
        }

        .birthday .card {
            position: relative;
            width: 300px;
            height: 425px;
            border: 10px solid #9612eb;
            margin: 2px auto 0 auto;
            box-shadow: inset 10px 0px 15px 0px rgba(0, 0, 0, 0.1);
            background-image: linear-gradient(to bottom, rgba(255, 255, 255), rgba(255, 255, 255, 0.5)), url("{{ $birthday->watermark ?? '' }}");

            background-position: center;
            /* Center the image */
            background-repeat: no-repeat;
            /* Do not repeat the image */
            background-size: cover;
            background-color: #e6f0e6;
        }

        .birthday .card .text-container {
            width: 80%;
            height: 80%;
            margin: auto;
        }

        .strikethrough {
            text-decoration: line-through;
        }

        .birthday .card .text-container #head {
            font-family: 'Nobile', sans-serif;
            font-size: 1.5em;
            margin: 16px auto -25px auto
        }

        .birthday .card p {
            font-size: 1.1em;
            line-height: 1.4;
            font-family: 'Nobile';
            color: #331717;
            font-style: italic;
            text-align: center;
            margin: 30px auto 0px auto;
        }

        .birthday .card .front {
            position: absolute;
            width: 107%;
            height: 105%;
            margin: -10px 0px 0px -10px;
            border: 10px solid #9612eb;
            backface-visibility: hidden;
            background-color: #9612eb;
            /* background-image: url($cover-image);
                             */
            background-size: contain;
            transform-style: preserve-3d;
            transform-origin: 0% 50%;
            transform: perspective(800px) rotateY(0deg);
            transition: all 0.8s ease-in-out;
        }

        .birthday .card:hover .front {
            transform: perspective(800px) rotateY(-170deg);
            background-color: #41718d;
        }

        .birthday .card:hover .back {
            transform: perspective(800px) rotateY(-170deg);
            box-shadow: 7px 0px 5px 0px rgba(0, 0, 0, 0.3), inset 2px 0px 15px 0px rgba(0, 0, 0, 0.1);
            background-color: #d2dcd2;
        }

        .birthday .card .back {
            position: absolute;
            width: 107%;
            height: 105%;
            border: 10px solid #9612eb;
            margin: -10px 0px 0px -10px;
            backface-visibility: visible;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, .5));
            transform-style: preserve-3d;
            transform-origin: 0% 50%;
            transform: perspective(800px) rotateY(0deg);
            transition: all 0.8s ease-in-out;
            background-color: #e6f0e6;
            box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.1);
        }

        .imgset {
            position: relative;
            z-index: 1;
            margin-bottom: -215px;
        }

        .imgset img {
            box-shadow: 0px 6px 11px 7px rgba(0, 0, 0, 0.22);
            border-radius: 5px;
        }

        .birthday_modal .modal-body {
            background-color: rebeccapurple;
        }

        .close {
            vertical-align: middle;
            border: none;
            color: inherit;
            border-radius: 50%;
            /* background: transparent; */
            position: relative;
            width: 32px;
            height: 32px;
            opacity: 0.6;
        }

        .close:focus,
        .close:hover {
            /* opacity: 1; */
            background: rgba(128, 128, 128, 0.5);
            color: white !important;
        }

        .close:active {
            background: rgba(128, 128, 128, 0.9);
        }

        /* tines of the X */
        .close::before,
        .close::after {
            content: " ";
            position: absolute;
            top: 50%;
            left: 50%;
            height: 20px;
            width: 4px;
            background-color: currentColor;
        }

        .close::before {
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .close::after {
            transform: translate(-50%, -50%) rotate(-45deg);
        }

        .cross_btn {
            padding: 0px;
            background: rebeccapurple;
            color: white;
        }

        .main-cal {
            max-width: 50%;
            margin: auto;
        }

        .eng-cal {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .eng-cal:not(:last-child) {
            padding-bottom: 10px;
        }

        .eng-cal i {
            padding-right: 15px;
            font-size: 30px;
            text-align: center;
        }

        @media(max-width:2560px) and (min-width:1920px) {

            .w3-xlarge {
                font-size: 25px !important;
            }

            .w3-cell {
                font-size: 25px !important;
            }

        }


        @media (max-width:1300px) and (min-width:991px) {

            /* .birthday_modal .modal-body {
                                background-color: rebeccapurple;
                                max-width: 1200px;
                                margin: auto;
                            } */

            .birthday_modal .modal-content {
                position: relative;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                width: 100%;
                pointer-events: auto;
                background-color: transparent !important;
                background-clip: padding-box;
                border: 1px solid rgba(0, 0, 0, .2);
                border-radius: 0.3rem;
                outline: 0;
                justify-content: center;
            }

            .birthday .card .back {
                position: absolute;
                width: 86%;
                height: 105%;
                border: 10px solid #9612eb;
                margin: -10px 0px 0px -10px;
                backface-visibility: visible;
                filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, .5));
                transform-style: preserve-3d;
                transform-origin: 0% 50%;
                transform: perspective(800px) rotateY(0deg);
                transition: all 0.8s ease-in-out;
                background-color: #e6f0e6;
                box-shadow: 0px 0px 0px 0px rgb(0 0 0 / 10%);
            }
        }

        @media (max-width:990px) and (min-width:768px) {


            .birthday .card .back {
                position: absolute;
                width: 82%;
                height: 105%;
                border: 10px solid #9612eb;
                margin: -10px 0px 0px -10px;
                backface-visibility: visible;
                filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, .5));
                transform-style: preserve-3d;
                transform-origin: 0% 50%;
                transform: perspective(800px) rotateY(0deg);
                transition: all 0.8s ease-in-out;
                background-color: #e6f0e6;
                box-shadow: 0px 0px 0px 0px rgb(0 0 0 / 10%);
            }

            .main-cal {
                max-width: 70% !important;
            }

        }

        @media (max-width:767px) {
            .main-cal {
                max-width: 70% !important;
                margin-top: 110px;
            }
        }

        @media screen and (max-width:575px) {
            .birthday_modal .modal-body {
                max-width: 420px !important;
                margin: 0 auto;
            }

            .birthday_modal .modal-content {
                background-color: transparent;
                border: 0;
            }

            .birthday .card {
                width: 100%;
            }

            .close {
                vertical-align: middle;
                border: none;
                color: inherit;
                border-radius: 50%;
                /* background: transparent; */
                position: relative;
                width: 32px;
                height: 32px;
                opacity: 0.6;
            }

            .close:focus,
            .close:hover {
                /* opacity: 1; */
                background: rgba(128, 128, 128, 0.5);
                color: white !important;
            }

            .close:active {
                background: rgba(128, 128, 128, 0.9);
            }

            /* tines of the X */
            .close::before,
            .close::after {
                content: " ";
                position: absolute;
                top: 50%;
                left: 50%;
                height: 20px;
                width: 4px;
                background-color: currentColor;
            }

            .close::before {
                transform: translate(-50%, -50%) rotate(45deg);
            }

            .close::after {
                transform: translate(-50%, -50%) rotate(-45deg);
            }

            .cross_btn {
                padding: 0px;
                background: rebeccapurple;
                color: white;
            }

            .main-cal {
                max-width: 100% !important;
                margin-top: 0px;
            }

            div#calendar {
                font-size: 20px;
            }

            div#calendarr {
                font-size: 20px;
            }

            .eng-cal i {
                padding-right: 3px;
                font-size: 20px;
                text-align: center;
            }

        }

        @media (max-width:360px) {
            div#calendar {
                font-size: 16px;
            }

            div#calendarr {
                font-size: 16px;
            }

            .eng-cal i {
                padding-right: 3px;
                font-size: 18px;
                text-align: center;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
@endpush
@section('content')
    <section class="container-fluid">

        <div class="row">
            <div class=" main-cal">
                <div class="custom-cards mm-caleder-outer">
                    <div class="custom-card-body">
                        <div class="eng-cal"><i class="fas fa-solid fa-calendar-alt"></i>
                            <div id="calendar" class="w3-container w3-margin-top mm-caleder"></div>
                        </div>
                        <div class="eng-cal"> <i class="fas fa-solid fa-kaaba"></i>
                            <div id="calendarr" class="w3-container w3-margin-top mm-caleder"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="clock" class=" row flex-wrap flex-row">
                @foreach ($clock_user->user_clock as $key => $clock)
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                        <div class="card custom-cards custom-card-3 text-white clock_card text-center">
                            <div class="card-body text-center">
                                <div class="container_clock">
                                    <div class="box-clock">
                                        <?php $time = $clock->timezone->timezone;
                                        $session = 'AM';
                                        $current_time = \Carbon\Carbon::now();

                                        $covert_to_time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:i', $current_time);

                                        $set_time = $covert_to_time->setTimezone($time);
                                        $h = $set_time->format('h');
                                        $m = $set_time->format('i');

                                        $date = $set_time->format('d m Y');

                                        if ($h == 0) {
                                            $h = 12;
                                        }

                                        if ($h > 12) {
                                            $h = $h - 12;
                                            $session = 'PM';
                                            dd($h);
                                        }

                                        $h = $h < 10 ? $h : $h;
                                        $m = $m < 10 ? $m : $m;

                                        $time = $h . ':' . $m . $session;
                                        ?>
                                        <div id="MyClockDisplay" class="clock" onload="showTime()">{{ $time }}
                                        </div>
                                    </div>
                                </div>
                                <div class="clock-country">{{ $clock->name }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- <div class="col-md-6 col-lg-4 col-xl-4">
                                            <div class="card custom-cards custom-card-3 text-white clock_card text-center">
                                                <div class="card-body text-center">
                                                    <div class="container_clock">
                                                        <div class="box-clock">
                                                            <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
            </div>
        </div>
        <div class="row">
            <div class="@if (auth()->user()->type == 6) col-md-6 col-lg-3 @else col-md-6 col-lg-4 @endif">
                <div class="card card_margin custom-cards custom-card-1 text-white">
                    <div class="card-body d-flex justify-content-between">
                        <div class="card-image mt-3">
                            <img src="{{ asset('admin/images/card-0.png') }}" alt="" />
                        </div>
                        <span class="vertical-line"></span>

                        <div class="card-content mt-3 mr-4">
                            <span>Courses</span>
                            <p class="mb-0">{{ $total_courses }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="@if (auth()->user()->type == 6)col-md-6 col-lg-3 @else col-md-6 col-lg-4 @endif ">
                <div class="card card_margin custom-cards custom-card-2 text-white">
                    <div class="card-body d-flex justify-content-between">
                        <div class="card-image mt-2">
                            <img src="{{ asset('admin/images/card-1.png') }}" alt="" />
                        </div>
                        <span class="vertical-line"></span>
                        <div class="card-content mt-3 mr-4">
                            <span>Students</span>
                            <p class="mb-0">{{ $total_students }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="@if (auth()->user()->type == 6) col-md-6 col-lg-3 @else col-md-6 col-lg-4 @endif">
                <div class="card card_margin custom-cards custom-card-4 text-white">
                    <div class="card-body d-flex justify-content-between">
                        <div class="card-image mt-3">
                            <img src="{{ asset('admin/images/card-3.png') }}" alt="" />
                        </div>
                        <span class="vertical-line"></span>
                        <div class="card-content mt-3 mr-1">
                            <span>Universities</span>
                            <p class="mb-0">{{ count($universities) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @role('Master User')
                <div class="col-md-6 col-lg-3">
                    <div class="card card_margin custom-cards custom-card-3 text-white">
                        <div class="card-body d-flex justify-content-between">
                            <div class="card-image mt-2">
                                <img src="{{ asset('admin/images/card-2.png') }}" alt="" />
                            </div>
                            <span class="vertical-line"></span>
                            <div class="card-content mt-3" style="margin-right: 47px;">
                                <span>Users</span>
                                <p class="mb-0">{{ $total_users }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>
    </section>
    <section class="content-area mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mt-3">
                    <div class="student-card bg-white mm-dsahboard-set">
                        <h4>Students List</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered mm-email-list" id="student_list_dash">
                                <thead>
                                    <tr>
                                        <th class=" tab-heading">Full Name</th>
                                        <th class=" tab-heading">Email</th>
                                        <th class="col-sm-4 tab-heading">Status</th>
                                        <th class="col-sm-4 tab-heading">Nationality</th>
                                        <th class="col-sm-4 tab-heading">Student Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dash_student_list">
                                    @if ($latest_students)
                                        @foreach ($latest_students as $student)
                                            @if ($student->mark == 'Incomplete')
                                                @if ($student->contact)
                                                    @php
                                                        if (!empty($student->info->name)) {
                                                            $name = explode(' ', $student->info->name);
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td class="text-nowrap"><a
                                                                href="{{ route('student.show', $student->id) }}">{{ $name[1] ?? '' }}
                                                                {{ $name[0] ?? '' }}</a></td>
                                                        <td> {{ $student->contact['email'] ?? '' }}</td>
                                                        <!-- <td>{{ $student->visa->first()->select_status ?? '' }}</td> -->
                                                        <td>
                                                            @if ($student->mark == 'Complete')
                                                                <input type="checkbox" checked data-toggle="toggle"
                                                                    id="complete_stu" data-on="Complete"
                                                                    data-off="Incomplete"
                                                                    class="complete_status custom-switch-lg complete1"
                                                                    data-id="{{ $student->id }}" data-onstyle="success"
                                                                    data-offstyle="danger">
                                                            @else
                                                                <input type="checkbox" checked data-toggle="toggle"
                                                                    id="complete_stu" data-on="Complete"
                                                                    data-off="Incomplete"
                                                                    class="complete_status custom-switch-lg complete"
                                                                    data-id="{{ $student->id }}" data-onstyle="success"
                                                                    data-offstyle="danger">
                                                            @endif
                                                            <input type="hidden" value="{{ $student->id }}"
                                                                class="edit_id">
                                                            <input type="hidden" value="{{ $student->id }}"
                                                                class="visa_row_id">
                                                        </td>
                                                        <td> <?php $country = \App\Models\Country::find($student->info['nationality'] ?? ''); ?>
                                                            {{ $country['name'] ?? '' }}
                                                        </td>
                                                        @if ($student->visa->first() && $student->visa_stu == 1)
                                                            <td>{{ $student->visa->first()->select_status }}</td>
                                                        @elseif($student->student_applications->first())
                                                            <td>{{ $student->student_applications->first()->status }}
                                                            </td>
                                                        @else
                                                            <td>Not Available</td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>
                        </div>

                        <!-- <div class="mm-std-list-scroll student-list mb-3 student_card_list">
                                                    <div class=" tab-heading">Full Name</div>
                                                    <div class=" tab-heading">Email</div>
                                                    <div class="col-sm-4 tab-heading">Nationality</div>
                                                </div>
                                                <div style="height: 160px;overflow-y: scroll;overflow-x: hidden;">
                                                    @foreach ($latest_students as $student)
    @if ($student->contact)
    <div class="mm-std-list-scroll student-list mb-3 student_card_list">
                                                        <div class="">
                                                            <a href="{{ route('student.show', $student->id) }}">{{ $student->info['name'] ?? '' }}</a>
                                                        </div>
                                                        <div class="">
                                                            {{ $student->contact['email'] ?? '' }}
                                                        </div>
                                                        <div class="" style="padding-left: 17px;">
                                                            <?php $country = \App\Models\Country::find($student->info['nationality'] ?? ''); ?>
                                                            {{ $country['name'] ?? '' }}
                                                        </div>
                                                    </div>
    @endif
    @endforeach

                                                </div> -->
                        <div class="row" style="padding-top: 8px;">
                            <div class="col-sm-12 text-right">
                                <a class="btn edit_save float-right px-3 py-1" style="padding-top: 7px !important;"
                                    href="{{ route('studentlists') }}">View All
                                    Students</a>
                            </div>
                        </div>

                    </div>
                    <div class="student-card-users bg-white mm_db_align pt-4 pb-3">
                        <h4>Upcoming Birthday</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered mm-email-list">
                                <thead>
                                    <tr>
                                        <th class=" tab-heading">Full Name</th>
                                        <th class=" tab-heading">Birthday</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td> {{ date('D, M', strtotime($user->dob)) }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>

                        <!-- end table  -->

                        <!-- <div class="mm-std-list-scroll student-list mb-3 student_card_list">
                                                    <div class="col-sm-4 tab-heading">Full Name</div>
                                                    <div class="col-sm-4 tab-heading">Email</div>
                                                </div>
                                                <div style="height: 200px;overflow-y: scroll;overflow-x: hidden;">
                                                    @foreach ($users as $user)
    <div class="mm-std-list-scroll student-list mb-3 student_card_list">
                                                        <div class="col-sm-4">
                                                            {{ $user->name }}
                                                        </div>
                                                        <div class="col-sm-8">
                                                            {{ $user->email }}
                                                        </div>
                                                    </div>
    @endforeach
                                                </div> -->
                        <!-- <div class="row" style="padding-top: 8px;">
                                                    <div class="col-sm-12 text-right">
                                                        <a class="btn edit_save float-right px-3 py-1" href="{{ route('studentlists') }}">View All Students</a>
                                                    </div>
                                                </div> -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row-no-gutters student-performance pb-0">
                        <div class="col-md-12 col-lg-12 p-0 col-xl-10">
                            <div class="">
                                <h4 class="font-weight-bold" style="color:#2c2c2c">Visa Graph</h4>
                                {!! $visa_chart->container() !!}
                                <script src="{{ $visa_chart->cdn() }}"></script>
                                {{ $visa_chart->script() }}
                            </div>
                        </div>
                    </div>
                    <!-- <div class="student-performance pb-0">
                                                {!! $visa_chart->container() !!}
                                                    <script src="{{ $visa_chart->cdn() }}"></script>
                                                {{ $visa_chart->script() }}
                                            </div> -->
                    <div class="row-no-gutters top-results">
                        <div class="col-md-12 col-lg-12 p-0 col-xl-10">
                            <div>
                                <h4 class="font-weight-bold" style="color:#2c2c2c">Students Graph</h4>
                                {!! $chart->container() !!}
                                <script src="{{ $chart->cdn() }}"></script>
                                {{ $chart->script() }}
                            </div>
                        </div>
                    </div>
                    <!-- <div class="top-results">
                                                {!! $chart->container() !!}
                                                    <script src="{{ $chart->cdn() }}"></script>
                                                {{ $chart->script() }}
                                            </div> -->
                </div>
            </div>
        </div>


        @if (count($today_birthday_staff) > 0)
            <div class="modal fade" id="birthday_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog birthday_modal" role="document">
                    <div class="modal-content">
                        <div class="cross_btn">
                            <button class="close" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @foreach ($today_birthday_staff as $staff)
                                <div class="col-12 birthday">
                                    <div class="card">
                                        <div class="back"></div>
                                        <div class="front">
                                            <div class="imgset">
                                                <img width="100%"
                                                    src="https://1.bp.blogspot.com/-Mgj9-rbs65E/XfMoPSD5gtI/AAAAAAAAURk/NBokE2gSS2cTSJ2em5lZ5hJDuTtRN7UVwCLcBGAsYHQ/s1600/2713997.png">
                                            </div>
                                        </div>
                                        <div class="text-container text-center">
                                            <img src="{{ asset('admin/images/' . $staff->profile_photo) }}"
                                                alt="staff_image" height="100px" width="100px"
                                                style="border-radius:50%">
                                            <h4 style="color:black; text-transform: capitalize;">
                                                {{ $staff->name ?? '' }}
                                            </h4>
                                            <h6 style="color:black; text-transform: capitalize;">
                                                {{ $staff->role ?? '' }}
                                            </h6>
                                            <p id="head">{{ $birthday->birthday_title ?? '' }}</p>
                                            <p>{{ $birthday->quotation ?? '' }}
                                            </p>
                                            <p>{{ $birthday->footer_note ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- end modal -->
    </section>

    <script>
        // js for clock
        $(document).ready(function() {
            function clock() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                $.ajax({
                    url: "{{ route('reload_clock') }}",
                    type: "GET",
                    success: function(data) {
                        $('#clock').html(data);
                    }
                });
            }
            setInterval(clock, 1000);
        });
    </script>
    <script type="text/javascript" src="https://zulns.github.io/HijriDate.js/hijri-date.js"></script>
    <script type="text/javascript" src="https://zulns.github.io/Calendar.js/calendar.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).on('ready', function() {


            var englishDate = new Intl.DateTimeFormat('en-GB', {
                day: 'numeric',
                month: 'long',
                weekday: 'long'
            }).format(Date.now('dd-mm-yy'));
            var arabicDate = new Intl.DateTimeFormat('en-GB-u-ca-islamic', {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            }).format(Date.now());

            var calendarr = document.getElementById('calendarr');
            var calendar = document.getElementById('calendar');
            $(calendar).html(englishDate);
            $(calendarr).html(arabicDate);
        });
    </script>

    <!-- <script>
        function showTime() {
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59
            var session = "AM";

            if (h == 0) {
                h = 12;
            }

            if (h > 12) {
                h = h - 12;
                session = "PM";
            }

            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;

            var time = h + ":" + m + ":" + s + session;
            document.getElementById("MyClockDisplay").innerText = time;
            document.getElementById("MyClockDisplay").textContent = time;

            setTimeout(showTime, 1000);

        }
        showTime();
    </script> -->
    <!-- <script src="{{ asset('admin/js/calendar.js') }}"></script> -->
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script>
        $(window).load(function() {
            $('#birthday_modal').modal('show');
        });
        $('.cross_btn').on('click', function() {
            $('#birthday_modal').modal('hide');
        });
    </script>
    <script>
        $('.complete').bootstrapToggle('off');
        $('.complete1').bootstrapToggle('on');

        function status_complete(flag, id) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                data: {
                    flag: flag,
                    id: id
                },
                url: "{{ route('complete') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    location.reload(true);
                    toastr.success(data);
                }
            });
        }
        $(document).on('change', '#complete_stu', function() {
            var flag = 'incomplete';
            var id = $(this).data('id');
            if ($(this).prop('checked') == true) {
                flag = 'Complete';
                status_complete(flag, id);
            } else {
                flag = 'Incomplete';
                status_complete(flag, id);
            }
        });
    </script>
@endsection
