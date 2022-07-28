@extends('admin.master')
@push('css')
    <style>
        .datetimepicker {
            background: url('{{ asset('images/calender.png') }}');
            background-repeat: no-repeat;
            background-position: 95%;

        }

        .existing_student {
            display: none;
        }

        .new_student_input {
            display: none;
        }

        .margin_top {}
    </style>
@endpush

@section('content')
    <div class="add-students-section">
        <h1 class="page-heading main_heading_h1">Generate Ticket</h1>

        <form action="{{ route('ticket.store') }}" method="post" class="tab-content" id="ticket_form">
            @csrf
            <div class="col-md-6 mx-auto">


                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="users_id" class="tab-inner-label">User</label>
                        <select class="form-control select-inner-text  @error('users_id') is-invalid @enderror" id="users_id"
                            name="users_id">
                            <option disabled="" selected="">Select</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" class="text-capitalize">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('users_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="title" class="tab-inner-label">Title</label>
                        <input type="text" class="form-control select-inner-text  @error('title') is-invalid @enderror" id="title"
                            value="{{ old('title') }}" placeholder="New Task" name="title" />
                        @error('title')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="periority" class="tab-inner-label">Priority</label>
                        <select class="form-control select-inner-text @error('periority') is-invalid @enderror" id="periority" name="periority">
                            <option disabled="" selected="">Select</option>
                            <option value="low" class="text-capitalize">low</option>
                            <option value="medium" class="text-capitalize">medium</option>
                            <option value="high" class="text-capitalize">high</option>
                        </select>
                        @error('periority')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="message" class="tab-inner-label">Message</label>
                        <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" cols="30" rows="10">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12 d-flex flex-row-reverse student-form-action">
                        <button class="btn " type="submit" href="#tabs-1">Open Ticket</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
