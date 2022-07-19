@extends('admin.master')
@section('content')
<div class=" students-List-section list-of-stds">

    <h1 class="page-heading page-hed-pt">Comments</h1>
    <div class="list-of-student-inner list-std4">
        <div class="row">
            <div class="col-lg-12 comment_div">
                @if(!empty($comments))
                @foreach($comments as $val)
                <div>
                    <p>
                        <img class="main-logo img-fluid" src="{{ asset('admin/images/'.$val->user->profile_photo )}}" alt="" />
                        {{$val->user->name ?? ''}}
                        @if($val->user_id == auth()->user()->id)
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord({{$val->id}},'/delete_visa_comment/')"
                            ><img
                                src="{{ asset('admin/images/list-delet-std.png')}}"
                                alt="edit-std"
                                class="img-fluid"
                        /></a>
                        @endif
                    </p>
                    <p>{{$val->comment_text ?? ''}}</p>
                </div>
                @endforeach
                @else
                <div>
                    <p>
                    <h3 class="text-center">This Course Have No Comments</h3>
                    </p>
                </div>
                @endif
            </div>
            <!-- <div class="col-lg-12">
                <form method="POST" action="{{route('save_comment')}}" id="">
                    @csrf
                    <textarea class="form-control comment_textarea" name="text_area" rows="2" placeholder="Write Comment" required></textarea>
                    <input type="hidden" name="student_id" value="">
                    <button class="comment_btn" type="submit">Add Comment</button>
                </form>
            </div> -->
        </div>
    </div>
    <div class="d-flex justify-content-end">

        <div class="list-std-btns mt-4">

            <!-- <a href="{{route('studentlists')}}"><i class="fas fa-step-backward"></i> &nbsp; Back</a> -->
        </div>
    </div>
</div>
@include('admin.modals.deleteModal')
@endsection
@section('scripts')

@endsection
