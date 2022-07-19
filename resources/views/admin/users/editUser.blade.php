@extends('admin.master')
@section('page_title')
    Edit User
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="students-List-section mmaduser">
    <div class="d-flex justify-content-between">
            <h1 class="page-heading float-left">Edit User</h1>
            <div>
            <a href="{{ route('user.index') }}" class="btn edit_save">Back</a>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                   
                       
                        <!-- form start -->
                        <form method="POST" class="edit-user-form" action="{{ route('user.update', $user->id) }}">
                            @csrf
                           
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label class="tab-inner-label">Name <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50" class="form-control aduser-input-inner-text" id="firstName" name="name" value="{{ $user->name }}" placeholder="Enter User Name" readonly>
                                        <div id="first-name-err" class="alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label class="tab-inner-label">Email <span class="required-star">*</span></label>
                                        <input type="email" maxlength="50" class="form-control aduser-input-inner-text" id="emailAddress" name="email" value="{{ $user->email }}" placeholder="Enter Email " readonly>
                                        <div id="email-err" class="alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label class="tab-inner-label">Role's <span class="required-star">*</span></label>
                                        
                                        <select name="role" class="form-control aduser-input-inner-text" id="role_id" @cannot('edit_roles') disabled @endcan>
                                            @foreach ($roles as $role)
                                                <option @if ($role->id == $user->type) selected @endif
                                                    value="{{$role->id}}">{{$role->name }}</option>
                                                    @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label class="tab-inner-label required-star" for="">DOB</label>
                                        <input type="date" name="dob" class="form-control aduser-input-inner-text" value="{{ $user->dob}}" placeholder="" />
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 hidden" id="assign_warehouse">

                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 hidden"  id="driver">
                                        <label class="tab-inner-label">Driver Code<span class="required-star">*</span></label>
                                        <input type="text"  class="form-control driver aduser-input-inner-text"  name="driver_code" minlength="4" maxlength="4" placeholder="Enter 4-Digit Code Driver" value="{{$user->driver_code}}">
                                        <div id="digit-err" class="alert alert-danger"></div>
                                    </div>
                                    <!-- <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Password <span class="required-star">*</span></label>
                                        <input type="password" maxlength="50"
                                            class="form-control" name="password"  id="password"
                                            placeholder="Update Password " >
                                            <div id="password-err" class="alert alert-danger"></div>
                                    </div> -->
                                    <input type="hidden" id="user_id" value="{{$user->id}}">
                                </div>
                          
                          
                                <button type="submit" class="btn edit_save mt-3">Save</button>
                            
                        </form>
                   
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script>



        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Select2 select box
            $("select[name=\"validation-select2\"]").select2({
                allowClear: true,
                placeholder: "Select gear...",
            }).change(function() {
                $(this).valid();
            });
            // Initialize Select2 multiselect box
            $("select[name=\"validation-select2-multi\"]").select2({
                placeholder: "Select gear...",
            }).change(function() {
                $(this).valid();
            });
        });
    </script>
@endsection
