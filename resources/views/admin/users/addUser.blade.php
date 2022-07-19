@extends('admin.master')
@section('page_title')
    Add User
@endsection
@section('content')
    <section class="students-List-section mmaduser">
    <div class="d-flex justify-content-between">
            <h1 class="page-heading float-left">Add User</h1>
            <div>
            <a href="{{ route('user.index') }}" class="btn edit_save"><i
                                    class="fas fa-fw fa-plus"></i>Back</a>
            </div>
        </div>
        <div class="mm-stdlist-main">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->

                        <!-- form start -->
                        <form id="registrationForm">
                            {{ csrf_field() }}
                            <div class="">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label class="tab-inner-label">Name <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50" class="form-control aduser-input-inner-text" id="firstName" name="name"
                                            value="{{ old('name') }}" placeholder="Enter User Name">
                                        <div id="first-name-err" class="alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label class="tab-inner-label">Email <span class="required-star">*</span></label>
                                        <input type="email" maxlength="50" class="form-control aduser-input-inner-text" id="emailAddress"
                                            name="email" value="{{ old('email') }}" placeholder="Enter Email ">
                                        <div id="email-err" class="alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label class="tab-inner-label required-star" for="">DOB</label>
                                        <input type="date" name="dob" class="form-control aduser-input-inner-text" placeholder="" />
                                    </div>
                                    
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12" id>
                                        <label class="tab-inner-label">Role's <span class="required-star">*</span></label>
                                        <select name="role" class="form-control aduser-input-inner-text" id="role_id">
                                            <option selected disabled>Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label class="tab-inner-label">Password <span class="required-star">*</span></label>
                                        <input type="password" maxlength="50" class="form-control aduser-input-inner-text" id="password"
                                            name="password" placeholder="Enter Password">
                                        <div id="password-err" class="alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label class="tab-inner-label">Confirm Password <span class="required-star">*</span></label>
                                        <input type="password" maxlength="50" class="form-control aduser-input-inner-text"
                                            name="password_confirmation" id="confirmPassword"
                                            placeholder="Enter Again Password... ">
                                        <div id="confirm-password-err" class=" alert-danger"></div>
                                    </div>

                                </div>
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
         $(document).ready(function() {
        // Initialize Select2 select box
        $("select[name=\"validation-select2\"]").select2({
            allowClear: true,
            placeholder: "Select gear...",
        }).change(function() {
            $(this).valid();
        });
        // Initialize Select2 multiselect box
        $("select[name=\"Courses[]\"]").select2({
            placeholder: "Select Courses...",
        }).change(function() {
            $(this).valid();
        });
    });
    </script>
    <script>
        document.getElementById("registrationForm").onsubmit = function(e) {
            firstNameValidation();
            // lastNameValidation();
            emailAddressValidation();
            // mobileNumberValidation();
            passwordValidation();
            confirmPasswordValidation();

            if (firstNameValidation() == true &&
                emailAddressValidation() == true &&
                passwordValidation() == true &&
                confirmPasswordValidation() == true) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: '{{route('user.store')}}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        if (response.status == "success") {
                            $('#submit').hide();
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                icon: 'success',
                                title: response.message,
                            });
                            setTimeout(function() {
                                $(".alert-success").fadeOut("slow");
                                window.location.href = "{{ route('user.index') }}";
                            }, 2000);
                        }

                    },
                });
            } else {
                return false;
            }
        }
        //  Name Validation
        var firstName = document.getElementById("firstName");
        var firstNameValidation = function() {
            firstNameValue = firstName.value.trim();
            // validFirstName = /^[A-Za-z]+$/;
            validFirstName = /^\w+$/;
            firstNameErr = document.getElementById('first-name-err');

            if (firstNameValue == "") {
                firstNameErr.innerHTML = "name is required";
            } else if (!validFirstName.test(firstNameValue)) {
                firstNameErr.innerHTML = " Username must contain only letters, numbers and underscores!";
            } else {
                firstNameErr.innerHTML = "";
                return true;
            }
        }
        firstName.oninput = function() {
            firstNameValidation();
        }
        // Email Address Validation
        var emailAddress = document.getElementById("emailAddress");
        var emailAddressValidation = function() {
            emailAddressValue = emailAddress.value.trim();
            validEmailAddress = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            emailAddressErr = document.getElementById('email-err');

            if (emailAddressValue == "") {
                emailAddressErr.innerHTML = "Email Address is required";
            } else if (!validEmailAddress.test(emailAddressValue)) {
                emailAddressErr.innerHTML = "Email Address must be in valid formate with @ symbol";
            } else {
                emailAddressErr.innerHTML = "";
                return true;
            }
        }
        emailAddress.oninput = function() {
            var startTimer;
            let email = $(this).val();
            startTimer = setTimeout(checkEmail, 500, email);
            emailAddressValidation();
        }
        function checkEmail(email) {
            emailAddressErr = document.getElementById('email-err');
            $('#email-error').remove();
            if (email.length > 1) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('user.checkEmail') }}",
                    data: {
                        email: email,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.success == false) {
                            emailAddressErr.innerHTML = data.message[0];
                            // $('#email').after('<div id="email-err" class="text-danger" <strong>'+data.message[0]+'<strong></div>');
                        } else {
                            emailAddressErr.innerHTML = data.message;
                            // $('#email').after('<div id="email-err" class="text-success" <strong>'+data.message+'<strong></div>');
                        }

                    }
                });
            } else {
                $('#email').after('<div id="email-error" class="text-danger" <strong>Email address can not be empty.<strong></div>');
            }
        }
        // Password Validation
        var password = document.getElementById("password");
        var passwordValidation = function() {
            passwordValue = password.value.trim();
            re = /[0-9]/;  re1 = /[a-z]/;      re2 = /[A-Z]/;
            passwordErr = document.getElementById('password-err');

            if (passwordValue == "") {
                passwordErr.innerHTML = "Password is required";
            }
            else if(!re.test(passwordValue)) {
            passwordErr.innerHTML="Error: password must contain at least one number (0-9)!";
            }
            else  if(!re1.test(passwordValue)) {
                passwordErr.innerHTML="Error: password must contain at least one lowercase letter (a-z)!";
                return false;
            }
            else  if(!re2.test(passwordValue)) {
                passwordErr.innerHTML="Error: password must contain at least one uppercase letter (A-Z)!";
                return false;
            }
            else {
                passwordErr.innerHTML = "";
                return true;
            }
        }
        password.oninput = function() {
            passwordValidation();
            confirmPasswordValidation();
        }
        // Confirm Password Validation
        var confirmPassword = document.getElementById("confirmPassword");
        var confirmPasswordValidation = function() {
            confirmPasswordValue = confirmPassword.value.trim();
            confirmPasswordErr = document.getElementById('confirm-password-err');

            if (confirmPasswordValue == "") {
                confirmPasswordErr.innerHTML = "Confirm Password is required";
            } else if (confirmPasswordValue != password.value) {
                confirmPasswordErr.innerHTML = "Confirm Password does not match";
            } else {
                confirmPasswordErr.innerHTML = "";
                return true;
            }
        }
        confirmPassword.oninput = function() {
            confirmPasswordValidation();
        }
    </script>
    
@endsection
