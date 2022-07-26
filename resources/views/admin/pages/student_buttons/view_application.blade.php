@extends('admin.master') @section('content')
<div class="students-List-section list-of-stds">
    <div class="mm-add-std-top-social">
        <h1 class="page-heading">Application View</h1>
        <div class="list-std-btns">
            <a class="edit-bg" href="{{ route('edit_application',$applications->id)}}"><i class="fas fa-pen"></i> &nbsp;
                Edit</a>
            <a class="del-bg" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                onclick="deleteRecord({{$applications->id}},'/users/delete_application/')"><i class="fas fa-trash"></i>
                &nbsp; Delete</a>
            <a href="{{route('application',$applications->add_students_id)}}"><i class="fas fa-step-backward"></i>
                &nbsp; Back</a>
        </div>
    </div>
    <div class="list-of-student-inner list-std1">
        <div class="row ">
            <div class="col-md-12 border-bottom">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6  col-xl-4">
                                <h3>Study Destination:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>
                                    @if(!empty($dropdown[5]->dropdownType))
                                    @foreach($dropdown[5]->dropdownType as $val)
                                    @if($val->id == $applications->study_dest)
                                    {{$val->name}}
                                    @endif
                                    @endforeach
                                    @endif
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6 col-lg-6">
                                <h3>Institution Name:</h3>
                            </div>
                            <div class="col-6 col-lg-6">
                                <p>
                                    @if(!empty($dropdown[6]->dropdownType))
                                    @foreach($dropdown[6]->dropdownType as $val)
                                    @if($val->id == $applications->inst_name)
                                    {{$val->name}}
                                    @endif
                                    @endforeach
                                    @endif
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12 border-bottom">
                <div class="row">
                    @if($applications->duration)
                    <div class="col-6 col-lg-3 col-xl-2">
                        <h3>Duration:</h3>
                    </div>
                    <div class="col-6  col-lg-3 col-xl-4">
                        <p>{{$applications->duration ?? ''}}</p>
                    </div>
                    <div class="col-6 col-lg-3 col-xl-3">
                        <h3>Start Date:</h3>
                    </div>
                    <div class="col-6 col-lg-3 col-xl-3">
                        <p>{{date('M d, Y', strtotime($applications->start_date ?? ''))}}</p>
                    </div>
                    @endif

                </div>

            </div>

            <div class="col-12 border-bottom">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            @if(!empty($applications->special_education->certificate_1))
                            <div class="col-6  col-xl-4">
                                <h3>Certificate 1:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>{{date('M d, Y', strtotime($applications->special_education->certificate_1 ?? ''))}}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            @if(!empty($applications->special_education->certificate_2))
                            <div class="col-6 col-lg-6">
                                <h3>Certificate 2:</h3>
                            </div>
                            <div class="col-6 col-lg-6">
                                <p>{{date('M d, Y', strtotime($applications->special_education->certificate_2 ?? ''))}}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 border-bottom">
                <div class="row">

                    <div class=" col-md-12 col-lg-6">
                        <div class="row">
                            @if(!empty($applications->special_education->certificate_3))
                            <div class="col-6  col-xl-4">
                                <h3>Certificate 3:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>{{date('M d, Y', strtotime($applications->special_education->certificate_3 ?? ''))}}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            @if(!empty($applications->special_education->certificate_4))
                            <div class="col-6 col-lg-6">
                                <h3>Certificate 4:</h3>
                            </div>
                            <div class="col-6 col-lg-6">
                                <p>{{date('M d, Y', strtotime($applications->special_education->certificate_4 ?? ''))}}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 border-bottom">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            @if(!empty($applications->special_education->foundation))
                            <div class="col-6  col-xl-4">
                                <h3>Foundation:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>{{date('M d, Y', strtotime($applications->special_education->foundation ?? ''))}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            @if(!empty($applications->special_education->associate_degree))
                            <div class="col-6 col-lg-6">
                                <h3>Associate Degree:</h3>
                            </div>
                            <div class="col-6 col-lg-6">
                                <p>{{date('M d, Y', strtotime($applications->special_education->associate_degree ?? ''))}}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 border-bottom">
                <div class="row">
                    @if(!empty($applications->education->diploma))
                    <div class="col-md-12 col-lg-6">
                        <div class="row">

                            <div class="col-6  col-xl-4">
                                <h3>Diploma:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>{{$applications->education->diploma ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-6 col-lg-6">
                                <h3>Start Date:</h3>
                            </div>
                            <div class="col-6 col-lg-6 col-lg-6">
                                <p>{{date('M d, Y', strtotime($applications->education->d_start_date ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12 border-bottom">
                <div class="row">
                    @if(!empty($applications->education->advance_diploma))
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-6  col-xl-4">
                                <h3>Advance Diploma:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>{{$applications->education->advance_diploma ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-6 col-lg-6 col-lg-6">
                                <h3>Start Date:</h3>
                            </div>
                            <div class="col-6 col-lg-6 col-lg-6">
                                <p>{{date('M d, Y', strtotime($applications->education->ad_start_date ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12 border-bottom">
                <div class="row">
                    @if(!empty($applications->education->bachelor))
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-6  col-xl-4">
                                <h3>Bechelor:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>{{$applications->education->bachelor ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-6 col-lg-6">
                                <h3>Start Date:</h3>
                            </div>
                            <div class="col-6 col-lg-6">
                                <p>{{date('M d, Y', strtotime($applications->education->b_start_date ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12 border-bottom">
                <div class="row">
                    @if(!empty($applications->education->bachelor_hons))
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-6  col-xl-4">
                                <h3>Bechelor Honours:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>{{$applications->education->bachelor_hons ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-6 col-lg-6 col-lg-6">
                                <h3>Start Date:</h3>
                            </div>
                            <div class="col-6 col-lg-6">
                                <p>{{date('M d, Y', strtotime($applications->education->bh_start_date ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12 border-bottom">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            @if(!empty($applications->education->graduate_diploma))
                            <div class="col-6  col-xl-4">
                                <h3>Graduate Diploma:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>{{$applications->education->graduate_diploma ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-6 col-lg-6">
                                <h3>Start Date:</h3>
                            </div>
                            <div class="col-6 col-lg-6">
                                <p>{{date('M d, Y', strtotime($applications->education->gd_start_date ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12 border-bottom">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            @if(!empty($applications->education->masters_degree))
                            <div class="col-6  col-xl-4">
                                <h3>Master's Degree:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>{{$applications->education->masters_degree ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-6 col-lg-6 ">
                                <h3>Start Date:</h3>
                            </div>
                            <div class="col-6 col-lg-6">
                                <p>{{date('M d, Y', strtotime($applications->education->md_start_date ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12 border-bottom">
                <div class="row">
                    @if(!empty($applications->education->doctoral_degree))
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-6  col-xl-4">
                                <h3>Doctoral Degree:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>{{$applications->education->doctoral_degree ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            <div class="col-6 col-lg-6">
                                <h3>Start Date:</h3>
                            </div>
                            <div class="col-6 col-lg-6">
                                <p>{{date('M d, Y', strtotime($applications->education->dd_start_date ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <div class="row">

                    <div class="col-md-12 col-lg-6">
                        <div class="row">
                            @if(!empty($applications->education->primary_school))
                            <div class="col-6  col-xl-4">
                                <h3>Primary School:</h3>
                            </div>
                            <div class="col-6  col-xl-8">
                                <p>{{date('M d, Y', strtotime($applications->education->primary_school ?? ''))}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12  col-lg-6">
                        <div class="row">
                            @if(!empty($applications->education->high_school))
                            <div class="col-6 col-lg-6">
                                <h3>High School:</h3>
                            </div>
                            <div class="col-6 col-lg-6">
                                <p>{{date('M d, Y', strtotime($applications->education->high_school ?? ''))}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            @if(!empty($applications->tuition_fee))
                            <div class="col-12  col-xl-2">
                                <h3>Tuition Fee:</h3>
                            </div>
                            <div class="col-12  col-xl-10">
                                <p>{{$applications->tuition_fee}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            @if(!empty($applications->rejected_reason))
                            <div class="col-12  col-xl-2">
                                <h3>Rejected Reasons:</h3>
                            </div>
                            <div class="col-12  col-xl-10">
                                <p>{{$applications->rejected_reason}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            @if(!empty($applications->declined_reason))
                            <div class="col-12  col-xl-2">
                                <h3>Declined Reasons:</h3>
                            </div>
                            <div class="col-12  col-xl-10">
                                <p>{{$applications->declined_reason}}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>

    <!-- <div class="d-flex justify-content-end">
        <div class="list-std-btns mt-4">
            <a
                class="edit-bg"
                href="{{ route('edit_application',$applications->id)}}"
                ><i class="fas fa-pen"></i> &nbsp; Edit</a
            >
            <a
                class="del-bg"
                href="javascript:void(0)"
                data-bs-toggle="modal"
                data-bs-target="#deleteModal"
                onclick="deleteRecord({{$applications->id}},'/users/delete_application/')"
                ><i class="fas fa-trash"></i> &nbsp; Delete</a
            >
            <a href="{{route('application',$applications->add_students_id)}}"
                ><i class="fas fa-step-backward"></i> &nbsp; Back</a
            >
        </div>
    </div> -->
</div>
@include('admin.modals.deleteModal')
@endsection
