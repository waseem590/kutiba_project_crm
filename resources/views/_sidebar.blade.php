<div id="sidebar-wrapper">
    <ul class="sidebar-nav ">
        <div class="text-center my-4">
            <img class="img-fluid dashboard-icon-border" src="{{ asset('admin/images/'.Auth::user()->profile_photo )}}"
                alt="" />
        </div>

        <div class="profile-bio text-center auth_name">
            <h5 class="mb-0">{{ Auth::user()->name ?? '' }}</h5>
            <!-- <p class="mt-1">Steven tailr</p> -->
        </div>

        <li class="active">
            <a href="#">
                <img src="{{ asset('admin/images/01.png')}}" alt="image" />
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item stu-dropdown">
            <a class="nav-link collapsed text-truncate" href="#students_submenue" data-toggle="collapse"
                data-target="#students_submenue"><img src="{{ asset('admin/images/02.png')}}" alt="image" /> <span
                    class="d-none d-sm-inline pl-2">Students</span> <i class="fas fa-angle-down arrow_style"></i></a>
                    
            <div class="collapse" id="students_submenue" aria-expanded="false">
                <ul class="flex-column nav">
                <li>
                    <a href="{{url('student/create')}}">
                    <i class="fas fa-arrow-alt-right color-white" style="padding-left:1rem !important"></i>
                    <span style="padding-left:5rem !important">Add Student</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('studentlists') }}">
                    <i class="fas fa-arrow-alt-right color-white" style="padding-left:2rem !important"></i>
                        <span style="padding-left:5rem !important">List of Students </span>
                    </a>
                </li>
                    <li class="nav-item ">
                        <a class="nav-link collapsed text-truncate" href="#submenu1" data-toggle="collapse"
                            data-target="#submenu1"> <i class="fas fa-cog color-white"></i><span class="d-none d-sm-inline" style="padding-left:5rem !important">Settings</span><i class="fas fa-angle-down arrow_style"></i></a>
                        <div class="collapse" id="submenu1" aria-expanded="false">
                            <ul class="flex-column nav">
                                <li class="nav-item stu-dropdown">
                                    <a class="nav-link py-0" href="{{route('dropdown.index')}}">
                                        <i class="fas fa-arrow-alt-right color-white"></i>
                                        <span class="sub_menue_child">Dropdown</span>
                                    </a>
                                </li>
                                <li class="nav-item stu-dropdown">
                                    <a class="nav-link " href="{{route('dropdownType')}}">
                                        <i class="fas fa-arrow-alt-right color-white" style="padding-left:34px;"></i>
                                        <span style="padding-left:73px;">Dropdown Type</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </li>
        <!-- <li class="nav-item ">
            <a class="nav-link collapsed text-truncate" href="#submenu1" data-toggle="collapse"
                data-target="#submenu1"><img src="{{ asset('admin/images/02.png')}}" alt="image" /> <span
                    class="d-none d-sm-inline dropdown-toggle">Settings</span></a>
            <div class="collapse" id="submenu1" aria-expanded="false">
                <ul class="flex-column nav">
                    <li class="nav-item pl-5 stu-dropdown">
                        <a class="nav-link py-0" href="{{route('dropdown.index')}}">
                            <img src="{{ asset('admin/images/02.png')}}" alt="image" />
                            <span class="pl-3 ">Dropdown</span>
                        </a>
                    </li>
                    <li class="nav-item stu-dropdown pl-5">
                        <a class="nav-link py-0" href="{{route('dropdownType')}}">
                            <img src="{{ asset('admin/images/02.png')}}" alt="image" />
                            <span class="pl-5">Dropdown Type</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li> -->
        
        

        <li>
            <a href="{{ route('user.index') }}">
                <img src="{{ asset('admin/images/09.png')}}" alt="image" />
                <span>Users</span>
            </a>
        </li>
        <li>
            <a href="{{ route('role.index') }}">
                <img src="{{ asset('admin/images/09.png')}}" alt="image" />
                <span>Roles</span>
            </a>
        </li>
        <li>
            <a href="{{ route('permission.index') }}">
                <img src="{{ asset('admin/images/010.png')}}" alt="image" />
                <span>Permissions</span>
            </a>
        </li>
        <li class="nav-item stu-dropdown">
            <a class="nav-link collapsed text-truncate" href="#guidlines_submenue" data-toggle="collapse"
                data-target="#guidlines_submenue">                
                <img src="{{ asset('admin/images/04.png')}}" alt="image" />
                <span class="d-none d-sm-inline pl-2">Guidelines</span> <i class="fas fa-angle-down arrow_style"></i></a>
            <div class="collapse" id="guidlines_submenue" aria-expanded="false">
                <ul class="flex-column nav">
                <li>
                    <a href="#">
                    <i class="fas fa-arrow-alt-right color-white" style="padding-left:2.8rem !important"></i>
                    <span style="padding-left:5rem !important">Knowledge Center</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fas fa-arrow-alt-right color-white" style="padding-left:2rem !important"></i>
                        <span style="padding-left:5rem !important">School Contacts </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fas fa-arrow-alt-right color-white" style="padding-left:3rem !important"></i>
                        <span style="padding-left:5rem !important">Apply Login Details</span>
                    </a>
                </li>
                </ul>
            </div>
        </li>
        <li class="">
            <a href="#">
                <img src="{{ asset('admin/images/04.png')}}" alt="image" />
                <span class="pr-2">Guidelines </span>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="{{ asset('admin/images/05.png')}}" alt="image" />
                <span>Registration</span>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="{{ asset('admin/images/07.png')}}" alt="image" />
                <span class="pl-2">Team Member</span>
            </a>
        </li>
        <li>
            <a href="#">
                <img src="{{ asset('admin/images/08.png')}}" alt="image" />
                <span class="pr-3">Schedule</span>
            </a>
        </li>
    </ul>
</div>
