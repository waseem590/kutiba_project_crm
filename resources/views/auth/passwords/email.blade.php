@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row" style="margin-bottom:0px !important;">
                            <div class="col-md-5">
                                <label for="email" class=" col-form-label text-md-right"
                                    style="/*! position: relative; */padding-left: 21px;">E-Mail Address</label>
                            </div>

                            <div class="col-md-7 mb-md-0 mb-3">
                                <input id="email" type="email" class="form-control " name="email" value="" required=""
                                    autocomplete="email" autofocus="" style="margin-top: 10px;">

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
