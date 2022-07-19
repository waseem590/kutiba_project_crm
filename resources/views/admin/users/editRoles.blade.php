@extends('admin.master')
@section('title','Edit Roles')
@section('content')
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="students-List-section mmaduser">
    <div class="d-flex justify-content-between">
            <h1 class="page-heading float-left">Edit Role</h1>
            <div>
            <a href="{{route('role.index')}}" class="btn edit_save"><i
                                    class="fas fa-arrow-left"></i> &nbsp;Back</a>
            </div>
        </div>
        <div class="mm-stdlist-main">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                   
                        <!-- form start -->
                        <form class="mm-edit-Role-form" action="{{route('role.update', $role->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label class="tab-inner-label">Role <span class="required-star">*</span></label>
                                        <input type="text" name="role" class="form-control aduser-input-inner-text @error('role') is-invalid @enderror" value="{{ $role->name }}"
                                            readonly>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-4 col-xs-12 edit-Role-inner-text">
                                        <label class="tab-inner-label">Permission <span class="required-star">*</span></label>
                                        <select class="form-control " name="permissions[]" multiple style="width: 100%" required>
                                            @foreach($permission as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ in_array($value->id, $rolePermissions) ? 'selected' : false }}>
                                                    {{ $value->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('permissions')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn edit_save mt-3">Update</button>
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
            $("select[name=\"permissions[]\"]").select2({
                placeholder: "Select Permissions...",
            }).change(function() {
                $(this).valid();
            });
        });
    </script>
    <!-- /.content -->
@endsection


