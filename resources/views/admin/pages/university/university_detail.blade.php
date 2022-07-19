@extends('admin.master')
@push('css')

@endpush

@section('content')
<div class="add-students-section">
    <div class="list-std-btns d-flex justify-content-between mr-3">
        <h1 class="page-heading">{{__('translation.Knowledge_Center')}}</h1>
        <a href="{{ url()->previous() }}"><i class="fas fa-step-backward"></i> &nbsp; Back</a>
    </div>
    <div class="knowledge-center-wrapper">
        <div class="knowledge-detail-img">
            <img src="{{$university->uni_file}}" alt="knowledge-detail-img">
        </div>
        <div class="knowledge-detail-content">
            <div class="detail-top-div flex-wrap">
                <h1>{{$university['en_title']}}</h1>
                <div class="konowldege-top-social">
                    <a href="{{URL::to($university['doc_file'])}}" download="{{$university['en_title']}}"><img
                            src="{{asset('images/word-file-icon.png')}}" alt="word-file-icon"></a>
                    <a href="{{URL::to($university['exl_file'])}}" download="{{$university['en_title']}}"><img
                            src="{{asset('images/xcel-icon.png')}}" alt="xcel-icon"></a>
                    <a href="{{URL::to($university['ppt_file'])}}" download="{{$university['en_title']}}"><img
                            src="{{asset('images/powerpoint-icon.png')}}" alt="powerpoint-icon"></a>
                </div>
            </div>
            <div class="text-justify">
                {!! $university->english_summernote !!}
            </div>
            <div>
                <a href="/guidelines/language/en/1" class="knowledge-more ">{{__('translation.back')}}</a>
            </div>
        </div>
    </div>

    <!-- The Modal -->


    <div class="modal fade" id="add-uni">
        <div class="modal-dialog adduni-model">
            <div class="modal-content">


                <div class="modal-header">
                    <h4 class="modal-title">Add University</h4>
                    <button type="button" data-bs-dismiss="modal" class="cross-icon"
                        data-dismiss="modal">&times;</button>
                </div>


                <div class="modal-body">
                    <form action="#">
                        <div class="form-row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="knowledge-label" for="">Title
                                        <small>(English)</small></label>
                                    <input type="text" class="form-control knowledge-textbox" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="knowledge-label" for="">Title
                                        <small>(Arabic)</small></label>
                                    <input type="text" class="form-control knowledge-textbox" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="knowledge-label" for="">Website Link</label>
                                    <input type="text" class="form-control knowledge-textbox" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group mb-4 pb-2">
                                    <label class="knowledge-label" for="">Attachment</label>
                                    <div class="input-group">
                                        <input type="text" name="filename1" class="form-control knowledge-textbox"
                                            placeholder="No file selected" readonly>
                                        <span class="input-group-btn">
                                            <div class="btn btn-default  custom-file-uploader">
                                                <input type="file" name="file"
                                                    onchange="this.form.filename1.value = this.files.length ? this.files[0].name : ''" />
                                                Browse
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group  mb-4 pb-2">
                                    <div class="input-group">
                                        <input type="text" name="filename2" class="form-control knowledge-textbox"
                                            placeholder="No file selected" readonly>
                                        <span class="input-group-btn">
                                            <div class="btn btn-default  custom-file-uploader">
                                                <input type="file" name="file"
                                                    onchange="this.form.filename2.value = this.files.length ? this.files[0].name : ''" />
                                                Browse
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group mb-4 pb-2">
                                    <div class="input-group">
                                        <input type="text" name="filename3" class="form-control knowledge-textbox"
                                            placeholder="No file selected" readonly>
                                        <span class="input-group-btn">
                                            <div class="btn btn-default  custom-file-uploader">
                                                <input type="file" name="file"
                                                    onchange="this.form.filename3.value = this.files.length ? this.files[0].name : ''" />
                                                Browse
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="knowledge-label" for="">Description
                                        <small>(English)</small></label>
                                    <div class="word-file-area">
                                        <img src="./Image/word-image.png" alt="wordfile" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="knowledge-label" for="">Description
                                        <small>(Arabic)</small></label>
                                    <div class="word-file-area">
                                        <img src="./Image/word-image.png" alt="wordfile" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- model end  -->
</div>
@endsection

@push('js')
@endpush
