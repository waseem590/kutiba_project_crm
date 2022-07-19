@extends('admin.master')
@push('css')
@endpush

@section('content')
<div class="add-students-section">
    <h1 class="page-heading">Edit Accommodation</h1>
    <form class="tab-content" method="POST" action="{{route('update_accomodation')}}" id="accommodation_form">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="exampleFormControlSelect1" class="tab-inner-label">Accommodation Type</label>
                <select class="form-control select-inner-text" id="exampleFormControlSelect1" name="accommodation_type">
                    <option disabled="" selected="">Select Type</option>
                    @if(!empty($accomodation_types))
                        @foreach($accomodation_types as $val)
                            <option value="{{ $val->id }}" @if(isset($accommodation->accommodation_type) && $accommodation->accommodation_type == $val->id) ? selected  @endif>{{ $val->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-md-4 col-md-4">
                <label class="tab-inner-label" for="">Placement Fee</label>
                <input type="text" value="{{$accommodation->placement_fee ?? ''}}" class="form-control select-inner-text" placeholder="0.00" name="placement_fee" />
            </div>
            <div class="col-md-4 col-md-4">
                <label class="tab-inner-label" for="">Accommodation Fee</label>
                <input type="text" value="{{$accommodation->accommodation_fee ?? ''}}" class="form-control select-inner-text" placeholder="0.00" name="accommodation_fee"/>
            </div>
            <div class="col-md-4 col-md-4  calender-relative calender-relative-1">
                <label class="tab-inner-label" for="122">
                    Arrival Date</label>
                    <input name="arrival_date" value="{{$accommodation->arrival_date ?? ''}}" type="date" id="datetimepicker5" class="form-control select-inner-text" placeholder="11-16-2021">
                    <!-- <span class="calender_custm"><img class="" src="{{asset('images/calender.png')}}" alt="calender"></span> -->
            </div>
            <div class="col-md-4 add-acco-cbox">
                <div class="form-group-custom custom-checkbox-1" >
                    <input class="mr-5" type="checkbox" id="html" @if(isset($accommodation->airport_pickup) && $accommodation->airport_pickup == 'on') ? checked  @endif name="airport_pickup" required/>
                    <label for="html">Airport Pick Up</label>
                </div>
                        @error('airport_pickup')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
            </div>
            <div class="col-md-4 col-md-4">
                <label class="tab-inner-label" for="">Airport Pick Up Fee</label>
                <input type="text" value="{{$accommodation->airport_pickup_fee ?? ''}}" class="form-control select-inner-text" placeholder="0.00"  name="airport_pickup_fee"/>
            </div>
            <div class="form-group col-md-4 mt-3">
                <label for="exampleFormControlSelect1" class="tab-inner-label">Status</label>
                <select class="form-control select-inner-text" name="status">
                <option disabled="" selected="">Select Status</option>
                @if(!empty($accomodation_status))
                    @foreach($accomodation_status as $val)
                        <option value="{{ $val->id }}" @if(isset($accommodation->status) && $accommodation->status == $val->id) ? selected  @endif>{{ $val->name }}</option>
                    @endforeach
                @endif
                </select>
            </div>
            <div class="form-group col-md-12 d-flex flex-row-reverse student-form-action">
                <button class="btn " href="#tabs-1">Submit</button>
                <input type="hidden" value="{{$accommodation->add_students_id ?? ''}}" name="add_students_id">
                <input type="hidden" value="{{$accommodation->id ?? ''}}" name="updated_id">
            </div>
        </div>
        <div class="form-row"></div>
    </form>

</div>
@endsection

@push('js')
@endpush
