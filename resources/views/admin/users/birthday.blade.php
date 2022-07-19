@extends('admin.master')

@section('content')
<div class="container mb-5">
        <div class="col-sm-12 mb-5">
            <h3 class="text-center p-4 heading-color">Admin Profile</h3>
        </div>
        <form action="{{ route('store_staff_birthday') }}" method="POST" id="birthday_form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-10 mx-auto border p-0 birthday_res">
                    <p class="text-light text-uppercase setting_head text-center p-0 m-0 py-2">
                    <strong>Add Or Edit Birthday Card Information </strong>
                    </p>

                    <div class="col-sm-12 mt-2 p-4">
                        <div class="row mb-2">

                                <div class="col-sm-12">
                                    <label class="label__wrapper required">Title</label>
                                    <input type="text" name="birthday_title" class="form-control input__box--wrapper" value="{{$birthday_info->birthday_title ?? ''}}" >
                                    @if($errors->has('birthday_title'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('birthday_title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-12">
                                    <label class="label__wrapper required">Quotation</label>
                                    <textarea class="form-control" name="quotation" id="quotation" cols="30" rows="3">{{$birthday_info->quotation ?? ''}}</textarea>
                                    @if($errors->has('quotation'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('quotation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-12">
                                    <label class="label__wrapper required">Footer Note</label>
                                    <textarea class="form-control" name="footer_note" id="footer_note" cols="30" rows="1">{{$birthday_info->footer_note ?? ''}}</textarea>
                                    @if($errors->has('footer_note'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('footer_note') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <!-- khanbhai drag and drop  -->
                                    <label class="label__wrapper required">Watermark</label>
                                    <div class="uploadOuter">
                                            <!-- Darg and Drop image here -->
                                        <input type="file" class="form-control" name="watermark" id="uploadFile"  value="" />
                                    </div>
                                    <div id="preview">
                                            <!-- <a href=""><img id="delete_img_pic" src="{{ asset('admin/images/list-delet-std.png')}}" alt=""></a> -->
                                            <img id="edit_profile_pic" src="{{$birthday_info->watermark ?? ''}}" alt="" height="100px" width="100px">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 mx-auto p-0 mt-3 text-center">
                    <button class="btn btn-success" type="submit">Save </button>
                </div>
        </form>
    </div>

@endsection
@push('js')

<script>
"use strict";
function dragNdrop(event) {
    var fileName = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("preview");
    var previewImg = document.createElement("img");
    previewImg.setAttribute("src", fileName);
    preview.innerHTML = "";
    preview.appendChild(previewImg);    
}
function drag() {
    document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
}
function drop() {
    document.getElementById('uploadFile').parentNode.className = 'dragBox';
}

</script>
@endpush
