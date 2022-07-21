    <script src="{{asset('admin/js/jquery.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    {{-- <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script> --}}
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/script.js')}}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    @jquery
    @toastr_js
    @toastr_render
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script> --}}

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="{{ asset('admin-panel/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/b-2.1.1/b-colvis-2.1.1/b-html5-2.1.1/datatables.min.js"></script>
    <script src="{{asset('js/jquery.datetimepicker.full.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/zf/r-2.2.9/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".sidebar-nav li a").click(function () {
                $(".sidebar-nav li a").removeClass("active");
                $(this).addClass("active");
            });

            //   datatable

            // $(document).ready(function () {
            //     $('#responsive').DataTable({
            //         responsive: {
			// 			details: {
			// 				display:
			// 					$.fn.dataTable.Responsive.display.childRowImmediate,
			// 				type: "none",
			// 				target: "",
			// 			},
			// 		},
            //     });
            // });
        });

    </script>
    <script>
        $(document).ready(function () {
            var timer;
            var nav = $('.sidebar-nav').find('li');
            var a = nav.find('a');
            // console.log(a);
            var flag = true;
            $(".students_click").on("click", function (e) {
                if (flag == true) {
                    // console.log("Click!");

                    // Clear previous timer if any.
                    clearTimeout(timer);
                    timer = setTimeout(function () {

                        // Get expanded states for each ul.
                        var expanded = [];
                        $(".students_click").each(function () {
                            var thisExpanded = $(this).attr("aria-expanded");
                            // console.log(thisExpanded);

                            if (typeof (thisExpanded) != "undefined") {
                                expanded.push(thisExpanded);
                            } else {
                                expanded.push("undefined");
                            }
                        });

                        // Show it in console.
                        var expandedString = JSON.stringify(expanded);
                        // console.log(expandedString);

                        // Save it in Storage.
                        localStorage.setItem("ULexpanded", expandedString);
                    }, 600);
                    flag = false;
                    console.log("true click");
                    $('#students_submenue').show();
                } else {
                    localStorage.clear();
                    $('#students_submenue').hide();
                    console.log("false click");
                    flag = true;
                }
            });

            // On load, set ul to previous state.
            // console.log("---- On Load.");

            // Parse the string back to an array.
            var previousState = JSON.parse(localStorage.getItem("ULexpanded"));
            // console.log(previousState);

            // If there is data in locaStorage.
            if (previousState != null) {
                console.log("Setting ul states on...");

                $(".sidebar-nav .nav-item a").each(function (index) {
                    // If the ul was expanded.
                    if (previousState[index] == "true") {
                        // console.log("Index #" + index);
                        $(this).attr("aria-expanded", previousState[index]);
                        $('#students_submenue').show();
                    }
                });
            } else {
                // if($('.sidebar-nav nav-item a').not('.students_click').click()){
                //     $('#students_submenue ul').hide();
                // }
            }
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{asset('admin/js/summernote-ext-rtl.js')}}"></script>
    <script>
         $(document).ready(function () {
                $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            lengthChange: false,
                            extend: 'csv',
                            text: '<i class="fa fa-download" aria-hidden="true"></i>',
                            filename:'Students Record',
                            exportOptions: {
                                columns: [0,1,2,3]
                            },
                        }
                    ],
                    // responsive: {
					// 	details: {
					// 		display:
					// 			$.fn.dataTable.Responsive.display.childRowImmediate,
					// 		type: "none",
					// 		target: "",
					// 	},
					// },
                });
                $('#user_log').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            lengthChange: false,
                            extend: 'csv',
                            text: '<i class="fa fa-download" aria-hidden="true"></i>',
                            filename:'Students Record',
                            exportOptions: {
                                columns: [0,1,2,3]
                            },
                        }
                    ],
                    "pageLength": 25,
                    // responsive: {
					// 	details: {
					// 		display:
					// 			$.fn.dataTable.Responsive.display.childRowImmediate,
					// 		type: "none",
					// 		target: "",
					// 	},
					// },
                });
            });
    </script>
    <script>
         $(document).ready(function () {
                $('#expire_datatable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            lengthChange: false,
                            extend: 'csv',
                            text: '<i class="fa fa-download" aria-hidden="true"></i>',
                            filename:'Students Record',
                            exportOptions: {
                                columns: [0,1,2,3]
                            },
                        }
                    ],
                    // responsive: {
					// 	details: {
					// 		display:
					// 			$.fn.dataTable.Responsive.display.childRowImmediate,
					// 		type: "none",
					// 		target: "",
					// 	},
					// },
                });
            });
    </script>
    <script>
         $(document).ready(function () {
                $('#unpaid').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            lengthChange: false,
                            extend: 'csv',
                            text: '<i class="fa fa-download" aria-hidden="true"></i>',
                            filename:'Students Record',
                            exportOptions: {
                                columns: [0,1,2,3]
                            },
                        }
                    ],
                    // responsive: {
					// 	details: {
					// 		display:
					// 			$.fn.dataTable.Responsive.display.childRowImmediate,
					// 		type: "none",
					// 		target: "",
					// 	},
					// },
                });
            });
    </script>
    <script>
        $(document).ready(function() {
        $('#AppView-tble').DataTable({
            // responsive: {
			// 			details: {
			// 				display:
			// 					$.fn.dataTable.Responsive.display.childRowImmediate,
			// 				type: "none",
			// 				target: "",
			// 			},
			// 		},
        });
        $('.navbar-toggler').click(function(e){
            $('.mm-mob-collps').toggleClass('in');
        })
    } );
    </script>
    @stack('js')
    @yield('js')
    {!! JsValidator::formRequest('App\Http\Requests\AddStudentRequest', '#add_student_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\StudentInformationRequest', '#student_information_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\StudentInformationRequest', '#contact_detail_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\ProfileRequest', '#profileform') !!}
    {!! JsValidator::formRequest('App\Http\Requests\DropdownRequest', '#add_resource_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\DropdownRequest', '#updatedropdown') !!}
    {!! JsValidator::formRequest('App\Http\Requests\DropdownRequest', '#update_resource_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\DropdownTypeRequest', '#add_dropdown_type') !!}
    {!! JsValidator::formRequest('App\Http\Requests\DropdownTypeRequest', '#dropdown_type_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\RolesRequest', '#role_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\DropdownTypeRequest', '#add_resource_type') !!}
    {!! JsValidator::formRequest('App\Http\Requests\SchoolContactRequest', '#school_contact_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\UnivesityRequest', '#add_university') !!}
    {!! JsValidator::formRequest('App\Http\Requests\UnivesityRequest', '#update_university') !!}
    {!! JsValidator::formRequest('App\Http\Requests\AddApplicationRequest', '#add_application_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\AccommodationRequest', '#accommodation_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\LoginDetailRequest', '#login_detail_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\VisaRequest', '#visa_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\SmsStudentRequest', '#send_sms_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\TaskRequest', '#add_task_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\VisaCommentRequest', '#commend_form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\AppAcceptedRequest', '#application_accepted_modal') !!}
    {!! JsValidator::formRequest('App\Http\Requests\AttachmentRequest', '#add_attachment') !!}

