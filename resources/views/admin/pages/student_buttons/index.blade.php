@extends('admin.master')
@push('css')
<style>
    .datetimepicker {
        background:url('{{asset("images/calender.png")}}');
        background-repeat: no-repeat;
        background-position: 95%;

    }

    .offerModal.social-custom-modals .form-group .form-control {
        background-color: #fff;
    }

</style>
@endpush
@section('content')
<div class="students-List-section mm-app_list">
    <h1 class="students-list-hed" style="display: inline-block;">Application List</h1>
    <a href="{{route('add.application',$id)}}" class="btn edit_save float-right">Add New Application</a>
    <div class="mm-visible table-responsive">
        <table id="example" class="table table-bordered table-responsive-md table-responsive-lg">

            <thead class="s-list-thead">
                <tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Study Destination</th>
                    <th scope="col">Institution Name</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="custem-text-center">Action</th>
                </tr>
                </tr>
            </thead>
            <tbody>

                @foreach ($applications as $item)
                <tr>
                    <th scope="row" class="w-60">
                        {{$loop->iteration}}
                    </th>
                    <td>
                        @if(!empty($dropdown[5]->dropdownType))
                        @foreach($dropdown[5]->dropdownType as $val)
                        @if($val->id == $item->study_dest)
                        {{$val->name}}
                        @endif
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if(!empty($dropdown[6]->dropdownType))
                        @foreach($dropdown[6]->dropdownType as $val)
                        @if($val->id == $item->inst_name)
                        {{$val->name}}
                        @endif
                        @endforeach
                        @endif
                    </td>
                    <td class="status_td">{{$item->status ?? ''}}</td>
                    <td class="custem-text-center std-list-icon">

                        <a href="{{ route('edit_application',$item->id)}}" class="edit-list-icons"><img
                                src="{{ asset('admin/images/edit-std.png')}}" alt="edit-std" class="img-fluid" /></a>
                        <a href="{{ route('view_application',$item->id)}}" class="edit-list-icons"><img
                                src="{{ asset('admin/images/list-icon-std.png')}}" alt="edit-std"
                                class="img-fluid" /></a>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            class="edit-list-icons"
                            onclick="deleteRecord({{$item->id}},'/users/delete_application/')"><img
                                src="{{ asset('admin/images/list-delet-std.png')}}" alt="edit-std"
                                class="img-fluid" /></a>

                        <?php $tuition_fee = filter_var($item->tuition_fee, FILTER_SANITIZE_NUMBER_INT); ?>

                        <div class="dropdown" style="display: inline-block;">
                            <button class="btn tbl-dropdown dropdown-toggle status_dropdown" title="Status"
                                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" value="{{$item->id}}">

                            </button>
                            <div class="dropdown-menu dropdown status" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Submitted</a>
                                <a class="dropdown-item" href="#">Information Requested</a>
                                <a class="dropdown-item" href="#">Information Provided</a>
                                <a class="dropdown-item" href="#">Offered</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#RejecteddModal"
                                    href="#">Rejected</a>
                                <a class="dropdown-item" href="#">Acceptance sent</a>
                                <a class="dropdown-item" href="#" data-id="{{$item}}">Acceptance Information Requested
                                </a>
                                <a class="dropdown-item" href="">Acceptance Information provided</a>
                                <a class="dropdown-item" href="{{$tuition_fee}}"
                                    data-id="{{$item->start_date}}">Accepted</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#DeclineddModal"
                                    href="#">Declined</a>
                            </div>
                        </div>
                        <input type="hidden" value="{{$item->id ?? ''}}" class="app_id">
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>
</div>
<!-- Add Accepted Modal -->
<div class="modal fade" id="accepted_status" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Change Application Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('application_status')}}" id="application_accepted_modal">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Select Date</label>
                        <input type="date" class="form-control accepted_date" name="change_date" value="">
                        <!-- <input type="number" class="form-control" name="tuition_fee" required> -->
                        <label class="form-label mt-3">Tuition Fee</label>
                        <div class="input-group">

                            <div class="input-group-prepend">

                                <select id="currencyList" class="form-control" style="font-size: 15px;" name="sign">
                                    <option value="$" selected>$</option>
                                    <option value="₡">₡</option>
                                    <option value="₢">₢</option>
                                    <option value="₣">₣</option>
                                    <option value="₥">₥</option>
                                    <option value="₦">₦</option>
                                    <option value="₧">₧</option>
                                    <option value="₨">₨</option>
                                    <option value="₩">₩</option>
                                    <option value="₪">₪</option>
                                    <option value="₫">₫</option>
                                    <option value="€">€</option>
                                    <option value="₭">₭</option>
                                    <option value="₮">₮</option>
                                    <option value="₯">₯</option>
                                    <option value="₰">₰</option>
                                    <option value="₱">₱</option>
                                    <option value="₲">₲</option>
                                    <option value="₳">₳</option>
                                    <option value="₴">₴</option>
                                    <option value="₵">₵</option>
                                    <option value="₶">₶</option>
                                    <option value="₷">₷</option>
                                    <option value="₸">₸</option>
                                    <option value="₹">₹</option>
                                    <option value="₺">₺</option>
                                    <option value="₻">₻</option>
                                    <option value="₼">₼</option>
                                    <option value="₽">₽</option>
                                    <option value="₾">₾</option>
                                    <option value="₿">₿</option>
                                </select>
                            </div>
                            <input type="number" class="form-control tuition_fee" placeholder="0.00" name="tuition_fee"
                                value="@if(!empty($tuition_fee))$tuition_fee @endif">
                        </div>

                        <input type="hidden" class="updated_row" name="updated_row_id">
                        <input type="hidden" class="updated_val" name="updated_val">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn edit_save" value="" id="add_courses_btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Accepted Model -->
<!-- Add Offered Modal -->
<div class="modal fade" id="add_task" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Change Application Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('application_status')}}" id="add_courses_form">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 error-placeholder">
                        <label class="form-label">Select Date</label>
                        <input type="date" class="form-control" name="change_date" required>
                        <input type="hidden" class="updated_row" name="updated_row_id">
                        <input type="hidden" class="updated_val" name="updated_val">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn edit_save" value="" id="add_courses_btn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add offered Model -->


<!-- Rejected Status modal -->
<div class="modal fade" id="RejecteddModal" class="RejecteddModal" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Application Rejection Reasons</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img class="pt-2" src="{{ asset('admin/images/modal-close.png') }}" alt="">
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="" id="rejected_form" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="rejected_reason" id="rejected_reason" cols="30"
                                rows="5" placeholder="Write Reason here..."></textarea>
                        </div>
                        <div class="social-custom-modals-btnn text-center ">
                            <button class="btn btn-primary" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- end Rejected modal -->
<!-- Declined Status modal -->
<div class="modal fade" id="DeclineddModal" class="DeclineddModal" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title " id="staticBackdropLabel">Application Declined Reasons</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <img class="pt-2" src="{{ asset('admin/images/modal-close.png') }}" alt="">
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <form action="" id="declined_form" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="declined_reason" id="rejected_reason" cols="30"
                                rows="5" placeholder="Write Reason here..."></textarea>
                        </div>
                        <div class="social-custom-modals-btnn text-center ">
                            <button class="btn btn-primary" type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- end Declined modal -->
@include('admin.modals.deleteModal')
@endsection
@section('scripts')

<script>
    $(document).on('click', '.status a', function (e) {
        e.preventDefault();
        var val = $(this).text();
        var row = $(this).closest('tr');
        var app_id = row.find('.app_id').val();
        var tuition_fee = parseInt($(this).attr('href'));
        var start_date = $(this).data('id');

        $('.accepted_date').val(start_date);
        $('.tuition_fee').val(tuition_fee);

        if (val == 'Offered') {
            $('body').find('.updated_val').val(val);
            $('body').find('.updated_row').val(app_id);
            $('#add_task').modal('show');
        } else if (val == 'Accepted') {
            $('body').find('.updated_val').val(val);
            $('body').find('.updated_row').val(app_id);
            $('#accepted_status').modal('show');
        } else {
            row.find('.status_td').text(val);
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                data: {
                    val: val,
                    app_id: app_id
                },
                url: "{{ route('application_status') }}",
                type: "POST",
                dataType: "json",
                success: function (data) {
                    toastr.success("Status Updated Successfully");
                }
            });
        }
    })

</script>
<script>
    $('.status_dropdown').on('click', function (e) {
        e.preventDefault();
        // var url = $(this).data('id');
        var id = $(this).val();
        console.log(id);
        var rejected_url = "/users/rejected_reason/" + id;
        $('#rejected_form').attr('action', rejected_url);
        var declined_url = "/users/declined_reason/" + id;
        console.log(declined_url);
        $('#declined_form').attr('action', declined_url);
    });

</script>
<script>
    var calendar = document.getElementById("calendar-table");
    var gridTable = document.getElementById("table-body");
    var currentDate = new Date();
    var selectedDate = currentDate;
    var selectedDayBlock = null;
    var globalEventObj = {};

    var sidebar = document.getElementById("sidebar");

    function createCalendar(date, side) {
        var currentDate = date;
        var startDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

        var monthTitle = document.getElementById("month-name");
        var monthName = currentDate.toLocaleString("en-US", {
            month: "long"
        });
        var yearNum = currentDate.toLocaleString("en-US", {
            year: "numeric"
        });
        monthTitle.innerHTML = `${monthName} ${yearNum}`;

        if (side == "left") {
            gridTable.className = "animated fadeOutRight";
        } else {
            gridTable.className = "animated fadeOutLeft";
        }

        setTimeout(() => {
            gridTable.innerHTML = "";

            var newTr = document.createElement("div");
            newTr.className = "row";
            var currentTr = gridTable.appendChild(newTr);

            for (let i = 1; i < startDate.getDay(); i++) {
                let emptyDivCol = document.createElement("div");
                emptyDivCol.className = "col empty-day";
                currentTr.appendChild(emptyDivCol);
            }

            var lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
            lastDay = lastDay.getDate();

            for (let i = 1; i <= lastDay; i++) {
                if (currentTr.children.length >= 7) {
                    currentTr = gridTable.appendChild(addNewRow());
                }
                let currentDay = document.createElement("div");
                currentDay.className = "col";
                if (selectedDayBlock == null && i == currentDate.getDate() || selectedDate.toDateString() ==
                    new Date(currentDate.getFullYear(), currentDate.getMonth(), i).toDateString()) {
                    selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);

                    document.getElementById("eventDayName").innerHTML = selectedDate.toLocaleString("en-US", {
                        month: "long",
                        day: "numeric",
                        year: "numeric"
                    });

                    selectedDayBlock = currentDay;
                    setTimeout(() => {
                        currentDay.classList.add("blue");
                        currentDay.classList.add("lighten-3");
                    }, 900);
                }
                currentDay.innerHTML = i;

                //show marks
                if (globalEventObj[new Date(currentDate.getFullYear(), currentDate.getMonth(), i)
                        .toDateString()]) {
                    let eventMark = document.createElement("div");
                    eventMark.className = "day-mark";
                    currentDay.appendChild(eventMark);
                }

                currentTr.appendChild(currentDay);
            }

            for (let i = currentTr.getElementsByTagName("div").length; i < 7; i++) {
                let emptyDivCol = document.createElement("div");
                emptyDivCol.className = "col empty-day";
                currentTr.appendChild(emptyDivCol);
            }

            if (side == "left") {
                gridTable.className = "animated fadeInLeft";
            } else {
                gridTable.className = "animated fadeInRight";
            }

            function addNewRow() {
                let node = document.createElement("div");
                node.className = "row";
                return node;
            }

        }, !side ? 0 : 270);
    }

    createCalendar(currentDate);

    var todayDayName = document.getElementById("todayDayName");
    todayDayName.innerHTML = "Today is " + currentDate.toLocaleString("en-US", {
        weekday: "long",
        day: "numeric",
        month: "short"
    });

    var prevButton = document.getElementById("prev");
    var nextButton = document.getElementById("next");

    prevButton.onclick = function changeMonthPrev() {
        currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - 1);
        createCalendar(currentDate, "left");
    }
    nextButton.onclick = function changeMonthNext() {
        currentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1);
        createCalendar(currentDate, "right");
    }

    function addEvent(title, desc) {
        if (!globalEventObj[selectedDate.toDateString()]) {
            globalEventObj[selectedDate.toDateString()] = {};
        }
        globalEventObj[selectedDate.toDateString()][title] = desc;
    }

    function showEvents() {
        let sidebarEvents = document.getElementById("sidebarEvents");
        let objWithDate = globalEventObj[selectedDate.toDateString()];

        sidebarEvents.innerHTML = "";

        if (objWithDate) {
            let eventsCount = 0;
            for (key in globalEventObj[selectedDate.toDateString()]) {
                let eventContainer = document.createElement("div");
                eventContainer.className = "eventCard";

                let eventHeader = document.createElement("div");
                eventHeader.className = "eventCard-header";

                let eventDescription = document.createElement("div");
                eventDescription.className = "eventCard-description";

                eventHeader.appendChild(document.createTextNode(key));
                eventContainer.appendChild(eventHeader);

                eventDescription.appendChild(document.createTextNode(objWithDate[key]));
                eventContainer.appendChild(eventDescription);

                let markWrapper = document.createElement("div");
                markWrapper.className = "eventCard-mark-wrapper";
                let mark = document.createElement("div");
                mark.classList = "eventCard-mark";
                markWrapper.appendChild(mark);
                eventContainer.appendChild(markWrapper);

                sidebarEvents.appendChild(eventContainer);

                eventsCount++;
            }
            let emptyFormMessage = document.getElementById("emptyFormTitle");
            emptyFormMessage.innerHTML = `${eventsCount} events now`;
        } else {
            let emptyMessage = document.createElement("div");
            emptyMessage.className = "empty-message";
            emptyMessage.innerHTML = "Sorry, no events to selected date";
            sidebarEvents.appendChild(emptyMessage);
            let emptyFormMessage = document.getElementById("emptyFormTitle");
            emptyFormMessage.innerHTML = "No events now";
        }
    }

    gridTable.onclick = function (e) {

        if (!e.target.classList.contains("col") || e.target.classList.contains("empty-day")) {
            return;
        }

        if (selectedDayBlock) {
            if (selectedDayBlock.classList.contains("blue") && selectedDayBlock.classList.contains("lighten-3")) {
                selectedDayBlock.classList.remove("blue");
                selectedDayBlock.classList.remove("lighten-3");
            }
        }
        selectedDayBlock = e.target;
        selectedDayBlock.classList.add("blue");
        selectedDayBlock.classList.add("lighten-3");

        selectedDate = new Date(currentDate.getFullYear(), currentDate.getMonth(), parseInt(e.target.innerHTML));

        showEvents();

        document.getElementById("eventDayName").innerHTML = selectedDate.toLocaleString("en-US", {
            month: "long",
            day: "numeric",
            year: "numeric"
        });

    }

    var changeFormButton = document.getElementById("changeFormButton");
    var addForm = document.getElementById("addForm");
    changeFormButton.onclick = function (e) {
        addForm.style.top = 0;
    }

    var cancelAdd = document.getElementById("cancelAdd");
    cancelAdd.onclick = function (e) {
        addForm.style.top = "100%";
        let inputs = addForm.getElementsByTagName("input");
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].value = "";
        }
        let labels = addForm.getElementsByTagName("label");
        for (let i = 0; i < labels.length; i++) {
            labels[i].className = "";
        }
    }

    var addEventButton = document.getElementById("addEventButton");
    addEventButton.onclick = function (e) {
        let title = document.getElementById("eventTitleInput").value.trim();
        let desc = document.getElementById("eventDescInput").value.trim();

        if (!title || !desc) {
            document.getElementById("eventTitleInput").value = "";
            document.getElementById("eventDescInput").value = "";
            let labels = addForm.getElementsByTagName("label");
            for (let i = 0; i < labels.length; i++) {
                labels[i].className = "";
            }
            return;
        }

        addEvent(title, desc);
        showEvents();

        if (!selectedDayBlock.querySelector(".day-mark")) {
            selectedDayBlock.appendChild(document.createElement("div")).className = "day-mark";
        }

        let inputs = addForm.getElementsByTagName("input");
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].value = "";
        }
        let labels = addForm.getElementsByTagName("label");
        for (let i = 0; i < labels.length; i++) {
            labels[i].className = "";
        }

    }

</script>
@endsection
