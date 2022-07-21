@extends('admin.master')
@push('css')
<style>
    /* add resource model css  */
    .add-resource .modal-header {
        padding: 8px 15px;
    }

    .add-resource .modal-header .close {
        width: 20px;
        height: 21px;
        background: #fff;
        opacity: 1;
        border-radius: 50%;
        text-align: center;
        color: #f7a600;
        padding: 0px;
        position: relative;
        top: 18px;
        right: 16px;
    }

    #add-resource .modal-body {
        padding: 29px 138px;
        background-color: #f0f1f3;
    }

    .edit_top_input2 {
        display: flex;
        justify-content: space-around;
        height: 40px;
        align-items: center;
        margin-bottom: 15px
    }

    .resource-inner-label {
        font-size: 14px;
        color: #393543;
        font-family: "robotoregular";
        font-weight: 500;
    }

    .resource_save {
        min-width: 129px;
        height: 39px;
        border-radius: 20px;
        background-color: #5f4f8d;
        font-size: 14px;
        color: #ffffff;
        font-weight: 400;
        border: 2px solid #5f4f8d;
        opacity: 1 !important;
    }

    .resource_save:hover {
        color: #5f4f8d;
        background-color: #fff;
    }

    .input_break {
        width: 50%;
    }

    @media screen and (max-width:991px) {
        #add-resource .modal-body {
            padding: 30px;
            background-color: #f0f1f3;
        }
    }

    @media screen and (max-width:575px) {
        .resource_save {
            min-width: 80px;
        }

        #add-resource .modal-body {
            padding: 15px;
            background-color: #f0f1f3;
        }

        .edit_top_input2 {
            flex-wrap: wrap;
            margin-bottom: 120px;
        }

        .edit_top_input2 input {
            margin-bottom: 15px;
        }

        .edit_top_input2 span {
            position: relative;
            top: -10px;
        }

        #example_filter {
            float: unset;
        }

        .input_break {
            width: 80%
        }
    }

</style>
@endpush
@section('content')
<div class="students-List-section">
    <div class="d-flex justify-content-between mb-3 mb-md-3">
        <div>
            <h1 class="students-list-hed">Resource List</h1>
        </div>
        <div>
            <button class="btn edit_save" class="img-fluid edit-icon" data-bs-toggle="modal"
                data-bs-target="#add_resource">Add Resource</button>
        </div>
    </div>

    <div class="">
        <table id="example" class="table table-bordered">
            <thead class="s-list-thead">
                <tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col" class="custem-text-center">Action</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                @foreach($dropdowns as $dropdown)
                <tr>
                    <td>{{$dropdown->id}}</td>
                    <td class="resource_name" id="{{$dropdown->id}}" title="Edit name on double click" style="cursor: pointer;">
                        {{$dropdown->name}}</td>
                    <td class="custem-text-cente">
                        <a href="{{route('updateDropdown',$dropdown->id)}}" data-id="{{$dropdown->id}}"
                            class="edit-list-icons update resource_detail" title="Detail">
                            <h4><i class="fa fa-eye" style="color:#5f4f8d !important " aria-hidden="true" alt="edit-std"
                                    class="img-fluid edit-icon" data-bs-toggle="modal"
                                    data-bs-target="#resource_type"></i></h4>
                        </a>

                        <!-- <a href="javascript:void(0)" class="edit-list-icons" onclick="deleteRecord({{$dropdown->id}},'/dropdown/')"><img
                                src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std"
                                class="img-fluid" data-bs-toggle="modal"
                                data-bs-target="#alert_modal"></a> -->
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<!-- Add Resource Modal -->
<div class="modal fade" id="add_resource" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Resource</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('resource.store')}}" id="add_resource_form">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="">
                        <span class="invalid-feedback">
                            <p class="validation_para"></p>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn edit_save">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Resource Model -->
<div class="modal fade" id="resource_type">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Resource Detail</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="#" id="add_resource_type">
                    <div class="edit_top_input2">
                        <label class="resource-inner-label" for="">Add Resource Type</label>
                        <div class="input_break">
                            <input type="text" class="form-control select-inner-text resource_input w-100" name="name">
                            <span id="resource_type_name" style="color:red;"></span>
                        </div>

                        <input type="hidden" name="dropdowns_id" class="form-control select-inner-text resource_id"
                            value="">
                        <button class="btn edit_save store_resource_type" type="button">Add</button>
                    </div>
                </form>
                <div class="edit_datatable">
                    <!-- <table id="resource_type_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody id="resource_type_body">

                        </tbody>

                    </table> -->
                    <table id="resource_type_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody id="resource_type_body">


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.modals.deleteModal')
@endsection
@section('scripts')
<script>
    $(document).on('click', '.update', function (e) {

        e.preventDefault();

        var update_url = $(this).attr('href');
        var name = $(this).data('id');

        $('#updatedropdown').attr('action', update_url);
        $('#update_name').val(name);
    });

</script>

<script>
    // $(document).ready(function () {
    //     $('#resource_type_table').DataTable();
    // });

</script>
<script>
    $(function () {
        $(".resource_name").dblclick(function (e) {
            if ($(e.target).attr('class') != "thVal") {
                e.stopPropagation();
                var currentEle = $(this);
                console.log("above",currentEle);
                var value = $(this).html().trim();
                console.log(value);
                var id = currentEle.attr('id');
                updateVal(currentEle, value, id);
            }
        });
        
    });

    function updateVal(currentEle, value, id) {
        $(document).off('click');
        // $(currentEle).html('<input class="thVal form-control" type="text" value="' + value + '" />');
        $(currentEle).html(`
        <input class="thVal form-control" type="text" value="` + value + `" />
        <span class="invalid-feedback">
            <p></p>
        </span>
        `);

        $(".thVal").focus();
        $(".thVal").keyup(function (event) {
            if (event.keyCode == 13) {
                $(currentEle).html($(".thVal").val().trim());
            }
        });
        $(document).click(function () {
            if ($(event.target).attr('class') != "thVal") {
                var name = $(".thVal").val();
                $(currentEle).html($(".thVal").val().trim());
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: `/update_dropdown/` + id + ``,
                    method: 'POST',
                    data: {
                        name: name,
                        id: id
                    },
                    succecss: function (res) {
                        toastr.success("Update Resource Successfully");
                    },
                });
                $(document).off('click');

            }

        });

        $(".thVal").keypress(function (e) {
            if (e.which == 13) // the enter key code
            {
                if ($(event.target).attr('class') != "thVal") {
                    var name = $(".thVal").val();
                    $(currentEle).html($(".thVal").val().trim());
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: `/update_dropdown/` + id + ``,
                        method: 'POST',
                        data: {
                            name: name,
                            id: id
                        },
                        success: function (res) {
                            toastr.success("Update Resource Successfully");
                        },
                    });
                    $(document).off('click');

                }
            }
        });
    }

</script>
<!-- show resource type script start-->
<script>
    $(document).on('click', '.resource_detail', function (e) {

        e.preventDefault();
        var id = $(this).data('id');
        $('.resource_id').val(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('showResourceType')}}",
            method: 'GET',
            data: {
                id: id
            },
            success: function (res) {

                $('#resource_type_body').html(res);
            },
            error: function (response) {
                console.log(response.errors);
            },
        });
    });

</script>
<!-- add resource type start script -->
<script>
    // $('.resource_input').keypress(function(event){
    //     var name = $(this).val();
    //     if(name == null){}
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: "{{route('customJsValidation')}}",
    //         method: 'GET',
    //         data: {name:name},
    //         success: function (res) {
    //             console.log(res.message);
    //             if(res.message){
    //                 $('.resource_input').addClass('border border-danger');
    //                 $("#resource_type_name").text(res.errors);

    //             }
    //            $('#resource_type_body').html(res);
    //         },
    //     });
    // });
    $(document).on('click', '.store_resource_type', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('adddropdownType')}}",
            method: 'POST',
            data: $('#add_resource_type').serialize(),
            success: function (res) {
                if (res.errors) {
                    $('.resource_input').addClass('border border-danger');
                    $("#resource_type_name").text("ResourceType already exist before");
                }
                $('#resource_type_body').html(res);
            },
        });
    });

</script>
<!-- add resource type end script -->

<!-- show resource type script end -->

<!-- resource type update start script-->
<script>
    $(function () {
        $(document).on('dblclick', '.resource_type_td', function (e) {
            if ($(e.target).attr('class') != "thVal") {
                e.stopPropagation();
                var currentEle = $(this);
                var value = $(this).html();
                var id = currentEle.attr('id');
                updateValue(currentEle, value, id);
            }
        });
        
    });
    $(document).on('click','.edit_resource_type',function(){
                var id = $(this).attr('id');
                var currentEle = $('.resource_type_td'+id);
                var value = $('.resource_type_td'+id).html();
                updateValue(currentEle, value, id);
    })
    function updateValue(currentEle, value, id) {
        $(document).off('click');
        $(currentEle).html('<input class="typeVal form-control" type="text" value="' + value + '" />');
        $(".typeVal").focus();
        $(".typeVal").keyup(function (event) {
            if (event.keyCode == 13) {
                $(currentEle).html($(".typeVal").val());
            }
        });
        $(document).click(function () {
            if ($(event.target).attr('class') != "typeVal") {
                var name = $(".typeVal").val();
                console.log(id);
                $(currentEle).html($(".typeVal").val().trim());
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('updateDropdownType')}}",
                    method: 'POST',
                    data: {
                        name: name,
                        id: id
                    },
                    success: function (res) {
                        toastr.success("Update Resource type Successfully");
                    },
                });
                $(document).off('click');

            }

        });

        $(".typeVal").keypress(function (e) {
            if (e.which == 13) // the enter key code
            {
                if ($(event.target).attr('class') != "typeVal") {
                    var name = $(".typeVal").val();
                    $(currentEle).html($(".typeVal").val());
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{route("updateDropdownType")}}',
                        method: 'POST',
                        data: {
                            name: name,
                            id: id
                        },
                        success: function (res) {
                            toastr.success("Update Resource type Successfully");
                        },
                    });
                    $(document).off('click');

                }
            }
        });
    }

</script>
<!-- delete resource type start -->
<script>
    $(document).on('click', '.delete_resource_type', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id);
        var dropdowns_id = $(this).attr('href');
        console.log(dropdowns_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route("delete.dropdown.type")}}',
            method: 'GET',
            data: {
                id: id,
                dropdowns_id: dropdowns_id,
            },
            success: function (res) {
                // console.log(res);
                if(res == 'error'){
                    toastr.error("dropdown type not delete because its already assigned");
                }
                else{
                    
                    $('#resource_type_body').html(res);
                    toastr.success("Delete Resource Type Successfully");
                }
                

            },
        });
    });

</script>
<!-- delete resource type end -->
<!-- resource type update end script-->
<script>
    $('.resource_input').keyup(function(key, value){
        var current = $(this);
        var name = current.val();
        var dropdowns_id = $('.delete_resource_type').attr('href');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route("custom.type.validation")}}',
            method:'GET',
            data: {
                name: name,
                dropdowns_id:dropdowns_id
            },
            success: function (res) {
                if(res.errors){
                    console.log(res.errors);
                $('.input_break span').text(res.errors);
                current.css('border','1px solid red');
                current.removeClass('is-valid');
                current.addClass('is-invalid');
                }
                else{
                    if(res.errors){current.css('border','1px solid red');}else{
                        current.css('border','1px solid green');
                    $('#resource_type_name').text("");
                    }
                    
                }
            },
        }); 
    });
</script>
@endsection
