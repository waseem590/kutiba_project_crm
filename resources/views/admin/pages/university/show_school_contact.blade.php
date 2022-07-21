@extends('admin.master')
@section('content')
<div class="students-List-section list-of-stds">
    <div class="mm-add-std-top-social">
        <h1 class="page-heading">School Contact</h1>
        <div class="list-std-btns">
            <a
                class="edit-bg"
                href="{{ route('edit_school_contacts',$school_contact->id)}}"
                ><i class="fas fa-pen"></i> &nbsp; Edit</a
            >
            <a
                class="del-bg"
                href="javascript:void(0)"
                data-bs-toggle="modal"
                data-bs-target="#deleteModal"
                onclick="deleteRecord({{$school_contact->id}},'/guidelines/delete_school_contacts/')"
                ><i class="fas fa-trash"></i> &nbsp; Delete</a
            >
            <a href="{{route('school_contacts')}}"
                ><i class="fas fa-step-backward"></i> &nbsp; Back</a
            >
        </div>
    </div>
    <div class="list-of-student-inner list-std1 show-school-page">
        <div class="row w-100">
            <div class="col-xl-3 col-4">
                <h3>Staff Name:</h3>
            </div>
            <div class="col-xl-3 col-8">
                <p>
                    {{$school_contact->staff_name}}
                </p>
            </div>
            <div class="col-xl-3 col-4">
                <h3>Job Title:</h3>
            </div>
            <div class="col-xl-3 col-8">
                <p>
                    {{$school_contact->job_title}}
                </p>
            </div>
            <div class="col-xl-3 col-4">
                <h3>Email:</h3>
            </div>
            <div class="col-xl-3 col-8">
                <p>{{$school_contact->email}}</p>
            </div>
            <div class="col-xl-3 col-4">
                <h3>Institution Name:</h3>
            </div>
            <div class="col-xl-3 col-8">
                <p>{{$school_contact->institution}}</p>
            </div>
            <div class="col-xl-3 col-4">
                <h3>Contact No. 1:</h3>
            </div>
            <div class="col-xl-3 col-8">
                <p>{{$school_contact->contact_no}}</p>
            </div>

            <div class="col-xl-3 col-4">
                <h3>Contact No. 2:</h3>
            </div>
            <div class="col-xl-3 col-8">
                <p>{{$school_contact->contact_no2}}</p>
            </div>
           
            <div class="col-xl-3 col-4">
                <h3>Notes:</h3>
            </div>
            <div class="col-xl-3 col-8">
                <p>{{$school_contact->notes}}</p>
            </div>
            

        </div>
    </div>
</div>
@include('admin.modals.deleteModal')
@endsection
