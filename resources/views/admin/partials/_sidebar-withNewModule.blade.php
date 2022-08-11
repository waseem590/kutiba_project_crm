<div id="sidebar-wrapper">
    <ul class="sidebar-nav ">
        <div class="row ml-0" style="padding: 0px;margin: 0px;">
            <div class="col-12">
                <div class="text-center md-my-4 mt-4">
                    <a href="{{ route('profile') }}"><span class="side-profile">
                            <img class="img-fluid dashboard-icon-border"
                                src="{{ asset('admin/images/' . Auth::user()->profile_photo) }}" alt="" />
                        </span></a>
                </div>
            </div>
        </div>

        <div class="profile-bio text-center auth_name">
            <a href="{{ route('profile') }}" class="text-decoration-none">
                <h5 class="mb-0">{{ Auth::user()->name ?? '' }}</h5>
            </a>
            <!-- <p class="mt-1">Steven tailr</p> -->
        </div>

        <li>
            <a class="nav-link mm-dash-link" href="{{ route('home') }}">
                <img src="{{ asset('admin/images/01.png') }}" alt="image" />
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item stu-dropdown">
            <a class="collapsed text-truncate students_click" href="#students_submenue" data-toggle="collapse"
                data-target="#students_submenue">
                <!-- <img src="{{ asset('admin/images/02.png') }}" alt="image" /> -->
                <i class="fas fa-user-graduate bulk-mail"></i>
                <span class="d-none d-sm-inline pl-2 mm-gudeline">Students</span> <i
                    class="fas fa-angle-down arrow_style"></i>
            </a>

            <div class="collapse www" id="students_submenue" aria-expanded="false">
                <ul class="flex-column nav">
                    <li>
                        <a class="nav-link" href="{{ url('student/create') }}">
                            <i class="fas fa-arrow-alt-right color-white"></i>
                            <div class="add-std-new"> <i class="fas fa-user-plus"></i>
                                <p>Add Student
                                <p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('studentlists') }}">
                            <i class="fas fa-arrow-alt-right color-white"></i>

                            <div class="add-std-new"> <i class="fas fa-receipt"></i>
                                <p>List of Students
                                <p>
                            </div>
                        </a>
                    </li>
                    @can('send bulk emails')
                        <li class="">
                            <a class="nav-link" href="mailto:{{ $all_students }}">
                                <i class="fas fa-arrow-alt-right color-white"></i>
                                <div class="add-std-new"> <i class="fas fa-cog"></i>
                                    <p>Send Bulk Emails
                                    <p>
                                </div>
                            </a>
                        </li>
                    @endcan
                    @can('student_settings')
                        <li class="">
                            <a class="nav-link" href="{{ route('resource.create') }}">
                                <i class="fas fa-arrow-alt-right color-white"></i>

                                <div class="add-std-new"> <i class="fas fa-cog"></i>
                                    <p>Settings
                                    <p>
                                </div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
        <li class="nav-item stu-dropdown">
            <a class="collapsed text-truncate" href="#visa_submenue" data-toggle="collapse"
                data-target="#visa_submenue">
                <img src="{{ asset('admin/images/02.png') }}" alt="image" />
                <!-- <i class="fab fa-cc-visa"></i> -->
                <span class="d-none d-sm-inline pl-2 mm-gudeline">Visa</span> <i
                    class="fas fa-angle-down arrow_style"></i></a>

            <div class="collapse www" id="visa_submenue" aria-expanded="false">
                <ul class="flex-column nav">
                    @can('add visa')
                        <li>
                            <a class="nav-link" href="{{ route('store.visa') }}">
                                <i class="fas fa-arrow-alt-right color-white"></i>
                                <div class="add-std-new"><i class="fab fa-cc-visa"></i>
                                    <p>Add Visa
                                    <p>
                                </div>
                            </a>
                        </li>
                    @endcan
                    <li>
                        <a class="nav-link" href="{{ route('visa.list', 1) }}">
                            <i class="fas fa-arrow-alt-right color-white"></i>

                            <div class="add-std-new"> <i class="fas fa-receipt"></i>
                                <p>List of Visa
                                <p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- new collapse  -->
        <li class="nav-item stu-dropdown">
            <a class="collapsed text-truncate" href="#users-submenus" data-toggle="collapse"
                data-target="#users-submenus">
                <!-- <img src="{{ asset('admin/images/02.png') }}" alt="image" /> -->
                <i class="fas  fa-users bulk-mail"></i>
                <span class="d-none d-sm-inline pl-2 mm-gudeline">Users</span> <i
                    class="fas fa-angle-down arrow_style"></i>
            </a>

            <div class="collapse www" id="users-submenus" aria-expanded="false">
                <ul class="flex-column nav">
                    <li>
                        <a class="nav-link" href="{{ route('zone.city') }}">
                            <i class="fas fa-arrow-alt-right color-white"></i>
                            <div class="add-std-new"> <i class="fas fa-user-clock"></i>
                                <p>Add Timezone
                                </p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <i class="fas fa-arrow-alt-right color-white"></i>
                            <div class="add-std-new"> <i class="fas fa-receipt"></i>
                                <p>Users List
                                <p>
                            </div>
                        </a>
                    </li>
                    @can('add_user_role_permission')
                        <li>
                            <a class="nav-link" href="{{ route('staff_birthday') }}">
                                <i class="fas fa-arrow-alt-right color-white"></i>
                                <div class="add-std-new"> <i class="fas fa-receipt"></i>
                                    <p>Birthday Card
                                    <p>
                                </div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
        <!-- end  -->

        @can('add_user_role_permission')
            <li>
                <a class="nav-link mm-img-pad" href="{{ route('role.index') }}">
                    <img src="{{ asset('admin/images/09.png') }}" alt="image" />
                    <span>Roles</span>
                </a>
            </li>
            <li>
                <a class="nav-link mm-img-pad" href="{{ route('permission.index') }}">
                    <img src="{{ asset('admin/images/010.png') }}" alt="image" />
                    <span>Permissions</span>
                </a>
            </li>
        @endcan


        <li class="nav-item stu-dropdown mm-knowlidge">
            <a class="nav-link collapsed text-truncate" href="#ticket_submenue" data-toggle="collapse"
                data-target="#ticket_submenue">
                <img src="{{ asset('admin/images/04.png') }}" alt="image" />
                <span class="d-none d-sm-inline pl-2 mm-gudeline">Ticket</span> <i
                    class="fas fa-angle-down arrow_style"></i></a>
            <div class="collapse" id="ticket_submenue" aria-expanded="false">

                <ul class="flex-column nav ">
                    @can('generate_ticket')
                        <li>
                            <a class="nav-link" href="{{ route('ticket.create') }}">
                                <i class="fas fa-arrow-alt-right color-white"></i>
                                <div class="add-std-new"> <i class="fas fa-graduation-cap"></i>
                                    <p>Generate Ticket
                                    <p>
                                </div>
                            </a>
                        </li>
                    @endcan
                    <li>
                        <a class="nav-link" href="{{ route('ticket.showList') }}">
                            <i class="fas fa-arrow-alt-right color-white"></i>
                            <div class="add-std-new"> <i class="fas fa-graduation-cap"></i>
                                <p>View Ticket
                                <p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item stu-dropdown mm-knowlidge">
            <a class="nav-link collapsed text-truncate" href="#guidlines_submenue" data-toggle="collapse"
                data-target="#guidlines_submenue">
                <img src="{{ asset('admin/images/04.png') }}" alt="image" />
                <span class="d-none d-sm-inline pl-2 mm-gudeline">Guidelines</span> <i
                    class="fas fa-angle-down arrow_style"></i></a>
            <div class="collapse" id="guidlines_submenue" aria-expanded="false">

                <ul class="flex-column nav ">
                    <li>
                        <a class="nav-link" href="/guidelines/language/en/1">
                            <i class="fas fa-arrow-alt-right color-white"></i>
                            <div class="add-std-new"> <i class="fas fa-graduation-cap"></i>
                                <p>Knowledge Center
                                <p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('school_contacts') }}">
                            <i class="fas fa-arrow-alt-right color-white"></i>

                            <div class="add-std-new"> <i class="fas fa-university"></i>
                                <p>School Contacts
                                <p>
                            </div>
                        </a>
                    </li>
                    <li class="">
                        <a class="nav-link" href="{{ route('login.details') }}">
                            <i class="fas fa-arrow-alt-right color-white"></i>

                            <div class="add-std-new"> <i class="fas fa-sign-in-alt"></i>
                                <p>Apply Login Details
                                <p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- <li>
            <a class="nav-link" href="#">
                <img src="{{ asset('admin/images/05.png') }}" alt="image" />
                <span>Registration</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="#">
                <img src="{{ asset('admin/images/07.png') }}" alt="image" />
                <span class="pl-2">Team Member</span>
            </a>
        </li>
        <li>
            <a class="nav-link" href="#">
                <img src="{{ asset('admin/images/08.png') }}" alt="image" />
                <span class="pr-3">Schedule</span>
            </a>
        </li> -->
        <li>
            <a class="nav-link mm-img-pad" href="{{ route('user.logs') }}">
                <img src="{{ asset('admin/images/08.png') }}" alt="image" />
                <span class="pr-3">User Logs</span>
            </a>
        </li>
    </ul>
</div>
