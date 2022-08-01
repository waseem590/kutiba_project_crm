<section>

    <div class="navbar-wrapper" style="position: fixed !important; z-index: 999; width: 100% !important;">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light">
                <li>
                    <i class="fas fa-bars mt-1 fa-2x pr-3 custom-bars menu-toggle"></i>
                </li>

                <a class="navbar-brand ml-3 " href="{{ url('/home')}}">
                    <img src="{{ asset('admin/images/navbar-logo.png') }}" alt="" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mm-mob-collps" id="navbarText">
                    <ul class="navbar-nav mr-auto">

                        <li class="">
                            <div class="search">
                                <form action="{{ route('generic.search') }}" method="POST">
                                    @csrf
                                    <input class="search-txt" type="text" name="generic_search" placeholder="search" />
                                    <button class="search-btn" type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </li>
                    </ul>

                    <span class="navbar-text">
                        <div class="d-flex flex-row bd-highlight">

                            <div class="">
                                <div class="dropdown cu-dropdown">
                                    <a class="btn border-right" type="button" id="dropdownMenuButton1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('admin/images/notify.png') }}" alt="" />
                                        <span class="notification_count">{{ auth()->user()->unreadNotifications->count() }}</span>
                                    </a>
                                    <ul class="dropdown-menu custom-dropdown-menu notification_list"
                                        aria-labelledby="dropdownMenuButton1">
                                        <h3>Notifications</h3>
                                        <div class="dropdown-divider"></div>
                                        <a style="color: #5f4f8d;" href="{{route('allNotifiMarkAsRead')}}">Mark All Read</a>
                                        <a style="color: #5f4f8d;" href="{{route('deleteAllNotification')}}">Delete All</a>
                                        <div class="dropdown-divider"></div>
                                        <div class="notify_hight">
                                        @foreach(auth()->user()->unreadNotifications as $notification)
                                        <li class="dropdown-item">
                                            <span class="notifi_cross" aria-hidden="true">×</span>
                                            <!-- <p>Counselor Name: {{ $notification->data['comment_creater_name'] ?? '' }}</p> -->
                                            <p class="unread_notifi">Name: {{ $notification->data['notifi_title'] }}</p>
                                            <p class="unread_notifi">Date: {{ $notification->created_at() }}</p>
                                            <input type="hidden" class="notifi_read_id" value="{{$notification->id}}">

                                        </li>
                                        @endforeach
                                        @foreach(auth()->user()->readNotifications as $notification)
                                        <li class="dropdown-item" style="background-color: #f5f7fa;">
                                            <span class="notifi_cross" aria-hidden="true">×</span>
                                            <input type="hidden" class="notifi_read_id" value="{{$notification->id}}">
                                            <a href="#">Name: {{ $notification->data['notifi_title'] }}</a>
                                            <p>{{ $notification->created_at() ?? '' }}</p>
                                        </li>
                                        @endforeach
                                        </div>
                                    </ul>
                                </div>
                            </div>

                            <div class="">
                                <div class="dropdown">
                                    <a class="btn" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="main-logo img-fluid"
                                            src="{{ asset('admin/images/'.Auth::user()->profile_photo )}}" alt="" />
                                    </a>
                                    <div class="dropdown-menu custom-dropdown-menu"
                                        aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('profile') }}">
                                            <i class="fas fa-cog"></i> Profile</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </span>
                </div>
            </nav>
        </div>
    </div>
</section>
<section class="mobile-header">
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="mobile-header">
                    <i class="fas fa-bars mt-3 fa-2x pl-3 custom-bars menu-toggle"></i>
                    <a class="navbar-brand float-right" href="#">
                        <img src="{{ asset('admin/images/navbar-logo.png') }}" alt="" />
                    </a>
                    <ul class="list-unstyled">
                        <li>
                            <div class="search">
                                <input class="search-txt" type="text" name="" placeholder="search" />
                                <a class="search-btn" href="#">
                                    <i class="fas fa-search"></i>
                                </a>
                            </div>
                        </li>
                    </ul>

                    <div class="d-flex flex-row bd-highlight">
                        <div class="">
                            <div class="dropdown cu-dropdown">
                                <a class="btn border-right" type="button" id="dropdownMenuButton1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('admin/images/notify.png') }}" alt="" />
                                    <span class="notification_count">{{ auth()->user()->unreadNotifications->count() }}</span>
                                </a>
                                <ul class="dropdown-menu custom-dropdown-menu notification_list"
                                        aria-labelledby="dropdownMenuButton1">
                                        <h3>Notifications</h3>
                                        <div class="dropdown-divider"></div>
                                        <a style="color: #5f4f8d;" href="{{route('allNotifiMarkAsRead')}}">Mark All Read</a>
                                        <a style="color: #5f4f8d;" href="{{route('deleteAllNotification')}}">Delete All</a>
                                        <div class="dropdown-divider"></div>
                                        <div class="notify_hight">
                                        @foreach(auth()->user()->unreadNotifications as $notification)
                                        <li class="dropdown-item">
                                            <span class="notifi_cross" aria-hidden="true">×</span>
                                            <p class="unread_notifi"> Name: {{ $notification->data['notifi_title'] }}</p>
                                            <input type="hidden" class="notifi_read_id" value="{{$notification->id}}">
                                            <p>{{ $notification->created_at() ?? ''}}</p>
                                        </li>
                                        @endforeach
                                        @foreach(auth()->user()->readNotifications as $notification)
                                        <li class="dropdown-item" style="background-color: #f5f7fa;">
                                            <span class="notifi_cross" aria-hidden="true">×</span>
                                            <input type="hidden" class="notifi_read_id" value="{{$notification->id}}">
                                            <a href="#">Name: {{ $notification->data['notifi_title'] }}</a>
                                            <p>{{ $notification->created_at() ?? '' }}</p>
                                        </li>
                                        @endforeach
                                        </div>
                                    </ul>
                            </div>
                        </div>
                        <div class="">
                                <div class="dropdown">
                                    <a class="btn" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="main-logo img-fluid"
                                            src="{{ asset('admin/images/'.Auth::user()->profile_photo )}}" alt="" />
                                    </a>
                                    <div class="dropdown-menu custom-dropdown-menu"
                                        aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('profile') }}">
                                            <i class="fas fa-cog"></i> Profile</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<script>
    $('body').on('click', '.unread_notifi', function(){
           var student_id = $(this).closest('li').find('.student_id').val();
           var notifi_read_id = $(this).closest('li').find('.notifi_read_id').val();
           $.ajaxSetup({
               headers: {
                   "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
               },
           });
           $.ajax({
               data:{student_id:student_id,notifi_read_id:notifi_read_id},
               url: "{{ route('notifiMarkAsRead') }}",
               type: "POST",
               dataType: "json",
               success: function (data) {
                   window.location.href = `/student/`+data+``;
               }
           });
       })

       $('body').on('click', '.notifi_cross', function(){
           var notifi_read_id = $(this).closest('li').find('.notifi_read_id').val();
           $.ajaxSetup({
               headers: {
                   "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
               },
           });
           $.ajax({
               data:{notifi_read_id:notifi_read_id},
               url: "{{ route('deleteNotification') }}",
               type: "POST",
               dataType: "json",
               success: function (data) {
               location.reload();
               }
           });
       })
</script>
