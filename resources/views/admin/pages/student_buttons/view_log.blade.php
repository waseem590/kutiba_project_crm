@extends('admin.master')
@push('css')
    <style>
        #application_log tr{
        font-weight:  !important;
        font-size:12px !important;
    }
    </style>
@endpush
@section('content')
    <div class="students-List-section">
        <h1 class="page-heading">Application Log Activities</h1>
        <div class="table-responsive">
            <table id="application_log" class="table table-bordered">
                <thead class="s-list-thead">
                    <tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                        <th scope="col">Link</th>
                        <!-- <th scope="col">Method</th> -->
                        <!-- <th scope="col">Agent</th> -->
                        <th scope="col">created_at</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @if ($logs)
                        <?php $counter = 0; ?>
                        @foreach ($logs as $log)
                            <tr>
                                <th>{{ ++$counter }}</th>
                                <?php $users = \App\Models\User::find($log->user_id); ?>
                                <th>{{ $users->name ?? '' }}</th>
                                <th>{{ $users->roles->first()->name ?? '' }}</th>
                                <th>{{ $log->subject }}</th>
                                <th>{{ $log->url }}</th>
                                <!-- <th>{{ $log->method }}</th> -->
                                <!-- <th>{{ $log->agent }}</th> -->
                                <th>{{ date('d-m-Y h:i a', strtotime($log->created_at)) }}</th>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
    </div>
@endsection
