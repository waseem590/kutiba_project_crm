@extends('admin.master')
@push('css')
@endpush

@section('content')
<div class="add-students-section">
    <h1 class="page-heading">Apply Login Details</h1>
    <form id="login_detail_form" class="tab-content custom-tab-content" action="{{route('update.login.details',$login_detail->id)}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-2"></div>
            <div class=" col-md-4 custom-two-equal-column">
                <label class="tab-inner-label" for="">Portal Name</label>
                <input type="text" class="form-control" name="portal_name" value="{{$login_detail->portal_name}}">
            </div>
            <div class=" col-md-4 custom-two-equal-column">
                <label class="tab-inner-label" for="">Portal Link</label>
                <input type="text" class="form-control" name="portal_link" value="{{$login_detail->portal_link}}">
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class=" col-md-4 custom-two-equal-column">
                <label class="tab-inner-label" for="">Password</label>
                <input type="text" class="form-control" name="password" value="{{$login_detail->show_password}}">
            </div>
            <div class=" col-md-4 custom-two-equal-column">
                <label class="tab-inner-label" for="">User Name</label>
                <select class="form-control select-inner-text" id="" name="user_id">
                    <option disabled="" selected="">Select Type</option>
                    @if(!empty($users))
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @if($user->id == $login_detail->user_id) selected @endif>{{ $user->name }}</option>
                        @endforeach
                    @endif
                </select>
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
