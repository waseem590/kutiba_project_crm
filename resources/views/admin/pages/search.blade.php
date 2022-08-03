@extends('admin.master')
@push('css')
<style>
    .icons i {
        color: #b5b3b3;
        border: 1px solid #b5b3b3;
        padding: 6px;
        margin-left: 4px;
        border-radius: 5px;
        cursor: pointer
    }

    .activity-done {
        font-weight: 600
    }

    .list-group li {
        margin-bottom: 12px
    }

    .list-group-item {}

    .list li {
        list-style: none;
        padding: 10px;
        border: 1px solid #e3dada;
        margin-top: 12px;
        border-radius: 5px;
        background: #fff;
        min-height: 64px;
    }

    .checkicon {
        color: #624f8e;
        font-size: 19px
    }

    .date-time {
        font-size: 12px
    }

    .profile-image img {
        margin-left: 3px
    }

</style>
@endpush
@section('content')

{{-- <div class="add-students-section">
    <h1 class="page-heading">Search Items</h1>
    <table>
        <thead>
            <tr>
                <th>Sr#</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php $count=0;?>
            @foreach($results as $result)
                <tr>
                    <td>{{++$count}}</td>
                    @if(class_basename($result) == "User")
                    <td>
                        <a href="">{{$result->email}}</a>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>  --}}

<div class="add-students-section1">

    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="d-flex justify-content-between align-items-center activity" style="padding-top:7rem!important">
                    <!-- <div><i class="fa fa-clock-o"></i><span class="ml-2">11h 25m</span></div>
                    <div><span class="activity-done">Done Activities(4)</span></div>
                    <div class="icons"><i class="fa fa-search"></i><i class="fa fa-ellipsis-h"></i></div> -->
                </div>
                <div class="mt-3">
                   <h1 class="page-heading">Search Items</h1>
                   <ul class="list list-inline">
                    @foreach($results as $result)
                            @if(class_basename($result) == "StudentInformation")
                                @if($result->name)
                                <li class="d-flex justify-content-between align-items-center">
                                    <a class="w-100 text-decoration-none text-black-50" href="{{route('student.show',$result->add_students_id)}}">
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="fa fa-check-circle checkicon"></i>
                                            <div class="ml-2 align-items-center w-100">
                                            <h6 class="mb-0">{{$result->name}}</h6>
                                                <div class="d-flex flex-row mt-1 text-black-50 date-time">
                                                    <div><i class="fa fa-calendar-o"></i><span >{{$result->dob ?? ''}}</span></div>
                                                    <?php $country = \App\Models\Country::find($result->nationality); ?>
                                                    <div class="ml-3"><i class="fa fa-clock-o"></i><span class="ml-2">{{$country['name'] ?? ''}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endif
                            @elseif(class_basename($result) == "DropdownType")
                                @if($result->name)
                                <li class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"><i class="fa fa-check-circle checkicon"></i>
                                        <div class="ml-2 align-items-center d-flex">
                                            <a href="{{route('resource.create')}}"><h6 class="mb-0">{{$result->name}}</h6></a>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @elseif(class_basename($result) == "StudentContactDetail")
                                @if($result->email)
                                <li class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"><i class="fa fa-check-circle checkicon"></i>
                                        <div class="ml-2 align-items-center d-flex">
                                        <a href="{{route('student.show',$result->add_students_id)}}"><h6 class="mb-0">{{$result->email}}</h6></a>
                                        </div>
                                    </div>
                                </li>
                                @elseif($result->contact_number)
                                <li class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"><i class="fa fa-check-circle checkicon"></i>
                                        <div class="ml-2 align-items-center d-flex">
                                        <a href="{{route('student.show',$result->add_students_id)}}"><h6 class="mb-0">{{$result->contact_number}}</h6></a>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @elseif(class_basename($result) == "University")
                                @if($result->en_title)
                                <li class="d-flex justify-content-between align-items-center">
                                    <a class="w-100 text-decoration-none text-black-50" href="{{route('university.detail',$result->id)}}">
                                    <div class="d-flex flex-row align-items-center"><i class="fa fa-check-circle checkicon"></i>
                                        <div class="ml-2 align-items-center d-flex">
                                            <h6 class="mb-0">{{$result->en_title}}</h6>
                                            <div class="d-flex flex-row mt-1 text-black-50 date-time">
                                                <div><i class="fa fa-calendar-o"></i><span class="ml-2">{!! $result->english_summernote !!}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @elseif(class_basename($result) == "SchoolContact")
                                @if($result->staff_name)
                                <li class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"><i class="fa fa-check-circle checkicon"></i>
                                        <div class="ml-2 align-items-center d-flex">
                                        <a href="{{route('show.school.contacts',$result->id)}}"><h6 class="mb-0">{{$result->staff_name}}</h6></a>
                                        </div>
                                    </div>
                                </li>
                                @elseif($result->job_title)
                                <li class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"><i class="fa fa-check-circle checkicon"></i>
                                        <div class="ml-2 align-items-center d-flex">
                                        <a href="{{route('show.school.contacts',$result->id)}}"><h6 class="mb-0">{{$result->job_title}}</h6></a>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @elseif(class_basename($result) == "User")
                                @if($result->name)
                                <li class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"><i class="fa fa-check-circle checkicon"></i>
                                        <div class="ml-2 align-items-center d-flex">
                                            <a href="/users"><h6 class="mb-0">{{$result->name}}</h6></a>
                                            <div class="d-flex flex-row mt-1 text-black-50 date-time">
                                                <div><i class="fa fa-calendar-o"></i><span class="ml-2">{{$result->email ?? ''}}</span></div>                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endif
                            @endif

                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
