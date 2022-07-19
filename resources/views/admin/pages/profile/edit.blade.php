@extends('admin.master')

@section('content')
<div class="container mb-5">
        <div class="col-sm-12 mb-5">
            <h3 class="text-center p-4 heading-color">Admin Profile</h3>
        </div>
        <form action="{{ route('updateprofile') }}" method="post" id="profileform" enctype="multipart/form-data">

            @csrf

            <div class="row">
                <div class="col-sm-10 mx-auto border p-0">
                    <p class="text-light text-uppercase setting_head text-center p-0 m-0 py-2">
                    <strong>Manage  Profile Information </strong>
                    </p>

                    <div class="col-sm-12 mt-2 p-4">
                        <div class="row mb-2">

                                <div class="col-sm-6">
                                    <label class="label__wrapper required">Name</label>
                                    <input type="text" name="name" class="form-control input__box--wrapper" value="{{Auth::user()->name ?? ''}}" >
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="col-sm-6">
                                    <label class="label__wrapper required">Email</label>
                                    <input type="text" name="email" class="form-control input__box--wrapper" value="{{Auth::user()->email ?? ''}}" >
                                    @if($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <input type="hidden" name="updateId" value="{{Auth::user()->id ?? ''}}" >

                                </div>
                                <div class="col-sm-6">
                                    <!-- <label class="label__wrapper required">Profile</label>
                                    <input type="file" name="profile_photo" class="form-control input__box--wrapper" id="imgInp">
                                    @if(Auth::user()->profile_photo)
                                        <img id="edit_profile_pic" src="{{ asset('admin/images/'.Auth::user()->profile_photo )}}" alt="" height="100px" width="100px">
                                        <a href="{{route('delete.profile_photo')}}"><img id="delete_img_pic" src="{{ asset('admin/images/list-delet-std.png')}}" alt=""></a>
                                    @endif -->

                                    <!-- khanbhai drag and drop  -->
                                    <label class="label__wrapper required">Upload image</label>
                                    <div class="uploadOuter">
                                            <input type="file" class="form-control" name="profile_photo"  id="uploadFile"  />
                                    </div>
                                    <div id="preview">
                                        @if(Auth::user()->profile_photo)
                                            <a href="{{route('delete.profile_photo')}}"><img id="delete_img_pic" src="{{ asset('admin/images/list-delet-std.png')}}" alt=""></a>
                                            <img id="edit_profile_pic" src="{{ asset('admin/images/'.Auth::user()->profile_photo )}}" alt="" height="100px" width="100px">

                                        @endif
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <label class="label__wrapper required">Current Password</label>
                                    <input type="password" name="current_password" class="form-control input__box--wrapper">
                                    @if($errors->has('current_password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('current_password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-sm-6">
                                    <label class="label__wrapper required">New Password</label>
                                    <input type="password" name="password" class="form-control input__box--wrapper" value="" >
                                    @error('password')
                                    <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="label__wrapper required">Confirm Password</label>
                                    <input type="password" name="confirmpassword" class="form-control input__box--wrapper" value="" >
                                    @error('confirmpassword')
                                    <div class="error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 mx-auto p-0 mt-3 text-center">
                    <button class="std-detail_btns darkblue-bg" type="submit">Update Profile </button>
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
