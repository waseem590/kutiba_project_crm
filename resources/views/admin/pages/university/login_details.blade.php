@extends('admin.master')
@push('css')
@endpush

@section('content')
<div class="add-students-section">
    <div class="list-std-btns d-flex justify-content-between mr-3">
        <h1 class="page-heading">Apply Login Details</h1>
        <a href="{{ url()->previous() }}"><i class="fas fa-step-backward"></i> &nbsp; Back</a>
    </div>
    <form id="login_detail_form" class="tab-content custom-tab-content" action="{{route('store.login.details')}}"
        method="POST">
        @csrf
        <div class="row">
            <div class="col-md-2"></div>
            <div class=" col-md-4 custom-two-equal-column">
                <label class="tab-inner-label" for="">Portal Name</label>
                <input type="text" class="form-control" name="portal_name">
            </div>
            <div class=" col-md-4 custom-two-equal-column">
                <label class="tab-inner-label" for="">Portal Link</label>
                <input type="text" class="form-control" name="portal_link">
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class=" col-md-4 custom-two-equal-column">
                <label class="tab-inner-label" for="">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class=" col-md-4 custom-two-equal-column">
                <label class="tab-inner-label" for="">User Name</label>
                <!-- <select class="form-control select-inner-text" id="" name="user_id">
                    <option disabled="" selected="">Select Type</option>
                    @if(!empty($users))
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                    @endif
                </select> -->
                <input type="text" class="form-control" name="user_name">
            </div>
            <div class="col-md-2"></div>
            <div class="form-group col-md-12 text-center student-form-action">
                <button class="btn mt-3 " href="#tabs-1" type=submit>Submit</button>
            </div>
        </div>
    </form>

</div>
@endsection

@push('js')
@endpush
