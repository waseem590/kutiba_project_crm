@extends('admin.master')
@push('css')
<style>
    .lang_pr {
        display: -webkit-box;
        margin: 0 auto;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        height: 56px;
    }
    .knowledge-content .lang_pr pre {
        overflow: hidden !important;
    }
    .dragBox {
        height: 33px;
        line-height: 16px;
    }

</style>
@endpush
@section('content')
<div class="add-students-section">
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap" dir="rtl">
            <h1 class="page-heading" style="text-align:right; margin-left:-30px" dir="rtl">
                {{ __('translation.Knowledge_Center') }}</h1>
            <div dir="rtl" class="mb-3">
                <div class="dropdown cu-dropdown float-left">
                    <button class="btn dropdown-toggle lang-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-expanded="false">
                        {{ __('translation.Languages') }}
                    </button>
                    <div class="dropdown-menu dd_menu text-right" aria-labelledby="dropdownMenuButton">
                        <a dir="rtl" class="dropdown-item" href="/guidelines/language/en/1"> <img
                                src="{{asset('images/usa.png')}}" alt="usaa_lang"> English</a>
                        <a dir="rtl" class="dropdown-item" href="/guidelines/language/ar/1"> <img
                                src="{{asset('images/saudia.png')}}"
                                alt="saudia_lang">{{ __('translation.Arabic') }}</a>
                    </div>
                </div>
                <button class="btn edit_save mr-2 add_uni" data-toggle="modal"
                    data-target="#add-uni">{{ __('translation.Add_University') }}</button>

            </div>
        </div>
    </div>
    <div class="knowledge-center-wrapper" dir="rtl">
        <div class="row">
            <?php $paginate = count($count_uni); ?>
            @foreach($universities as $universitie)
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="knowledge-center-views" dir="rtl" style="text-align:right">
                    <div class="knowledge-img">
                        <img src="{{$universitie['uni_file']}}" alt="uni_img">
                    </div>
                    <div class="knowledge-content">
                        <h2>{{$universitie['ar_title']}}</h2>

                        <div style="overflow-wrap: break-word;" class="lang_pr">
                            {!!$universitie['arabic_summernote']!!}
                        </div>
                        <a href="{{route('university.detail.ar',$universitie['id'])}}"
                            class="knowledge-more ">{{ __('translation.read_more') }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="std-List-pagination">
            <nav aria-label="...">
                <ul class="pagination">
                    @for($i=1; $i<=ceil($paginate/6); $i++) <li class="page-item"><a class="page-link"
                            href="/guidelines/language/{{session()->get('locale')}}/{{$i}}">{{$i}}</a></li>
                        @endfor
                </ul>
            </nav>
        </div>
    </div>

    <!-- The Modal -->


    <div class="modal fade" id="add-uni">
        <div class="modal-dialog adduni-model">
            <div class="modal-content">


                <div class="modal-header">
                    <h4 class="modal-title">{{__('translation.Add_University')}}</h4>
                    <apan data-bs-dismiss="modal" class="close" data-dismiss="modal" aria-label="Close">&times;</span>
                </div>


                <div class="modal-body">
                    <form action="{{ route('add.university') }}" method="POST" id="add_university"
                        enctype='multipart/form-data'>
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="knowledge-label"
                                        for="">{{__('translation.Title')}}</small></label>
                                    <input type="text" class="form-control knowledge-textbox" name="en_title"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="knowledge-label" for="">{{__('translation.Title_2')}}</label>
                                    <input type="text" class="form-control knowledge-textbox arabic_input "
                                        placeholder="" name="ar_title">
                                    <span class="text-danger arabic_danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="knowledge-label" for="">{{ __('translation.web_link') }}</label>
                                    <input type="text" class="form-control knowledge-textbox" name="web_link"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <label class="knowledge-label" for="">{{ __('translation.uni_img') }}</label>
                                <div class="custom-file">
                                    <!-- <input type="file" class="custom-file-input form-control knowledge-textbox"
                                        id="custoFile" name="uni_file">
                                    <label class="custom-file-label custom-file-uploader"
                                        for="customFile">{{ __('translation.choose_file') }}</label> -->
                                    <div class="uploadOuter">
                                        <span class="dragBox form-control" >
                                            {{ __('translation.drage_img') }}
                                            <input type="file" class="form-control" name="uni_file" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"/>
                                        </span>
                                    </div>
                                    <div id="preview"></div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <label class="knowledge-label" for="">{{ __('translation.world_file') }}</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control knowledge-textbox"
                                        id="" name="doc_file">
                                    <label class="custom-file-label custom-file-uploader"
                                        for="customFile">{{ __('translation.choose_file') }}</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <label class="knowledge-label"
                                    for="">{{ __('translation.powerpoint_file') }}</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control knowledge-textbox"
                                        id="" name="ppt_file">
                                    <label class="custom-file-label custom-file-uploader"
                                        for="customFile">{{ __('translation.choose_file') }}</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <label class="knowledge-label" for="">{{ __('translation.excel_file') }}</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control knowledge-textbox"
                                        id="" name="exl_file">
                                    <label class="custom-file-label custom-file-uploader"
                                        for="customFile">{{ __('translation.choose_file') }}</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="knowledge-label" for="">{{ __('translation.des_en') }}</label>
                                    <div class="word-file-area">
                                        <textarea class="form-control summernote" name="english_summernote"
                                            id="english_summernote"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label class="knowledge-label" for="">{{ __('translation.des_ar') }}</label>
                                    <textarea class="form-control arabic_input" name="arabic_summernote"
                                        id="arabic_summernote"></textarea>
                                    <span class="text-danger arabic_danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <button type="submit"
                                        class="btn edit_save uni_submit">{{ __('translation.submit') }}</button>
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
<script>
    "use strict";
    function dragNdrop(event) {
        var fileName = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("preview");
        var previewImg = document.createElement("img");
        previewImg.setAttribute("src", fileName);
        preview.innerHTML = "";
        preview.appendChild(previewImg);
    }
    function drag() {
        document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
    }
    function drop() {
        document.getElementById('uploadFile').parentNode.className = 'dragBox';
    }
</script>
<script type="text/javascript">
    $('#english_summernote').summernote({
        height: 150,
        placeholder: 'Start typing your text...',
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "italic", "underline", "clear"]],
            ["fontname", ["fontname"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
            ["table", ["table"]],
            ["insert", ["link", "hr"]],
            ["view", ["fullscreen", "codeview"]],
            ["help", ["help"]]
        ],
        callbacks: {
            onKeyup: function (e) {
                var textareavalue = $('#english_summernote').summernote('code');
                $('#english_summernote').val(textareavalue);
            },
        },
    });

</script>
<script type="text/javascript">
    $('#arabic_summernote').summernote({
        height: 150,
        placeholder: 'Enter Only Arabic...',
        callbacks: {
            onKeyup: function (e) {
                var textareavalue = $('#arabic_summernote').summernote('code');
                var arabic = /[\u0600-\u06FF]/g; //setting arabic unicode
                var match = textareavalue.match(arabic);
                var spacesMatch = textareavalue.match(new RegExp(" ", 'g'));

                if (match) {
                    $($('#arabic_summernote').summernote('code')).attr('dir', 'rtl');
                    $('.arabic_danger').text("");
                    $('#arabic_summernote').val(textareavalue);
                } else {
                    $($('#arabic_summernote').summernote('reset'));
                    $('.arabic_danger').text("Enter only Arabic Words");
                }
            },

        }
    });

</script>
<!-- arabic direction start -->
<script>
    $(".arabic_input").keyup(function () {
        var textareavalue = $(this).val(); //Getting input value
        var arabic = /[\u0600-\u06FF]/g; //setting arabic unicode
        var match = textareavalue.match(arabic);
        var spacesMatch = textareavalue.match(new RegExp(" ", 'g'));
        if (match) {
            $(this).attr('dir', 'rtl');

        } else {
            $(this).val(' ');
            $('.arabic_danger').text("Enter only Arabic Words");

        }

    });
    $(".arabic_input").change(function () {
        var textareavalue = $(this).val(); //Getting input value
        var arabic = /[\u0600-\u06FF]/g; //setting arabic unicode
        var match = textareavalue.match(arabic);
        var spacesMatch = textareavalue.match(new RegExp(" ", 'g'));
        if (match) {
            $(this).attr('dir', 'rtl');
            $('.arabic_danger').text("");
        } else {
            $(this).val(' ');
            $('.arabic_danger').text("Enter only Arabic Words");

        }

    });

</script>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

</script>
<!-- arabic direction end -->
@endpush
