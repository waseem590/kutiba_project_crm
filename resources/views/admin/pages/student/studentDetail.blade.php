@extends('admin.master')
@section('content')
<div class="container">
    <div class="row-md-12">
        <div class="col-md-8" style="padding: 10%;">
            <button type="button" class="btn btn-lg btn-primary active"><a href="mailto:{{$student->email}}?Name:{{$data->name}}" style="color:white;text-decoration:none;width:50%">Email Student</a></button>
            <button type="button" class="btn btn-lg btn-primary active"><a href="mailto:{{$student->email}}?Name:{{$data->name}}" style="color:white;text-decoration:none;width:50%">Email Councellor</a></button>
            <!-- <button type="button" class="btn btn-lg btn-primary active">Email admission officer </button> -->
            <button type="button" class="btn btn-lg btn-primary active smsStudent">SMS Student </button>
            <!-- <button type="button" class="btn btn-lg btn-primary active">Whattsapp Student </button> -->
        </div>
    </div>
    <div class="modal fade" id="smspopup" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Student SMS</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="form">

            </div>
        </div>
    </div>
</div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var id = `<?php echo $student->id; ?>`;
    $('.smsStudent').on('click', function() {
        $.ajax({
            method: "POST",
            url: "{{ route('sendsms') }}",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                'id': id
            },
            success: function(response) {
                $('body').find('#smspopup .form').html(response.html);
                $('#smspopup').modal('show');
            }
        });
    })
</script>
@endsection
