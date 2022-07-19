@extends('admin.master') 

@section('content')
<div class="students-List-section list-of-stds">
    <div class="mm-add-std-top-social">
        <h1 class="page-heading">Visa View</h1>
        <div class="list-std-btns">
            @can('add_user_role_permission')
            <a class="edit-bg" href="{{ route('edit_visa',$visa->id)}}"><i class="fas fa-pen"></i> &nbsp;
                Edit</a>
            <a class="del-bg" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
            onclick="deleteRecord({{$visa->id}},'/delete_visa/')"><i class="fas fa-trash"></i>
                &nbsp; Delete</a>
            @endcan
        </div>
    </div>
    <div class="list-of-student-inner list-std1">
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <h3>Case Officer:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
            <?php $case_officer = \App\Models\DropdownType::find($visa->case_officer)?>    
                <p>{{$case_officer['name']}}</p>
            </div>
            <div class="col-xl-3 col-sm-6">
                <h3>Student Name:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$visa->student->info['name']}}</p>
            </div>
            <div class="col-xl-3 col-sm-6">
                <h3>Date of Visa Application:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$visa->date_visa}}</p>
            </div>
            <div class="col-xl-3 col-sm-6">
                <h3>Visa Type:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <?php $visa_type = \App\Models\DropdownType::find($visa->visa_type)?>    
                <p>{{$visa_type['name']}}</p>
            </div>
            <div class="col-xl-3 col-sm-6">
                <h3>Number of Applicants:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <?php $status = \App\Models\DropdownType::find($visa->visa_status)?>    
                <p>{{$status['name']}}</p>
            </div>
            
            <div class="col-xl-3 col-sm-6">
                <h3>Status:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$visa->visa_status}}</p>
            </div>
           
            <div class="col-xl-3 col-sm-6">
                <h3>Immigration Fees:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$visa->immigration_fees}}</p>
            </div>

            <div class="col-xl-3 col-sm-6">
                <h3>Payment Method:</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
            <?php $immigeration_pay_method = \App\Models\DropdownType::find($visa->immigration_pay_method)?>    
                <p>{{$immigeration_pay_method['name']}}</p>
            </div>
           
            <div class="col-xl-3 col-sm-6">
                <h3> Date of Payment: </h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$visa->immigration_dop}}</p>
            </div>
         
            <div class="col-xl-3 col-sm-6">
                <h3> Service Fee :</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$visa->service_fee}}</p>
            </div>
 
            <div class="col-xl-3 col-sm-6">
                <h3> Payment Method :</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <?php $service_pay_method = \App\Models\DropdownType::find($visa->service_pay_method)?>    
                <p>{{$service_pay_method['name']}}</p>
            </div>
            <div class="col-xl-3 col-sm-6">
                <h3> Date of Payment :</h3>
            </div>
            <div class="col-xl-3 col-sm-6">
                <p>{{$visa->service_dop}}</p>
            </div>
        </div>
    </div>

</div>
@include('admin.modals.deleteModal')
@endsection
