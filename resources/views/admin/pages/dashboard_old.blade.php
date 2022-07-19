<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- ************************************************************************ !-->
  <!-- ****                                                              **** !-->
  <!-- ****       ¤ Designed and Developed by  LEADconcept               **** !-->
  <!-- ****               http://www.leadconcept.com                     **** !-->
  <!-- ****                                                              **** !-->
  <!-- ************************************************************************ !-->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" />

    <title>Dashboard</title>
  </head>
  <body>

    <section>
      <div class="navbar-wrapper" style="position: fixed !important; z-index: 999; width: 100% !important;">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light">
            <li>
              <i
                class="fas fa-bars mt-1 fa-2x pr-3 custom-bars menu-toggle"
              ></i>
            </li>

            <a class="navbar-brand ml-3 " href="#">
              <img src="{{ asset('admin/images/navbar-logo.png') }}" alt="" />
            </a>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarText"
              aria-controls="navbarText"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
              <ul class="navbar-nav mr-auto">

                <li class="">
                  <div class="search">
                    <input
                      class="search-txt"
                      type="text"
                      name=""
                      placeholder="search"
                    />
                    <a class="search-btn" href="#">
                      <i class="fas fa-search"></i>
                    </a>
                  </div>
                </li>
              </ul>
              <span class="navbar-text">
                <div class="d-flex flex-row bd-highlight">
                  <div class="">
                    <div class="dropdown cu-dropdown">
                      <a
                        class="btn border-left"
                        type="button"
                        id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <img src="{{ asset('admin/images/notify.png')}}" alt="" />
                      </a>
                      <div
                        class="dropdown-menu custom-dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                      >
                        <a class="dropdown-item" href="#">
                          <i class="fas fa-cog"></i> Settings</a
                        >
                        <a class="dropdown-item" href="#">
                          <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="">
                    <div class="dropdown cu-dropdown">
                      <a
                        class="btn border-right"
                        type="button"
                        id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <img src="{{ asset('admin/images/message.png')}}" alt="" />
                      </a>
                      <div
                        class="dropdown-menu custom-dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                      >
                        <a class="dropdown-item" href="#">
                          <i class="fas fa-cog"></i> Settings</a
                        >
                        <a class="dropdown-item" href="#">
                          <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="">
                    <div class="dropdown">
                      <a
                        class="btn"
                        type="button"
                        id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <img class="main-logo img-fluid" src="{{ asset('admin/images/main-logo.png')}}" alt="" />
                      </a>
                      <div
                        class="dropdown-menu custom-dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                      >
                        <a class="dropdown-item" href="#">
                          <i class="fas fa-cog"></i> Settings</a
                        >
                        <a class="dropdown-item" href="#">
                          <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
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
              <i
              class="fas fa-bars mt-3 fa-2x pl-3 custom-bars menu-toggle"
            ></i>
            <a class="navbar-brand float-right" href="#">
              <img src="{{ asset('admin/images/navbar-logo.png')}}" alt="" />
            </a>
            <ul class="list-unstyled">
              <li class=" " style="margin-top: 50px !important; margin-left: -33px !important;">
                <div class="search">
                  <input
                    class="search-txt"
                    type="text"
                    name=""
                    placeholder="search"
                  />
                  <a class="search-btn" href="#">
                    <i class="fas fa-search"></i>
                  </a>
                </div>
              </li>
            </ul>

            <div class="d-flex flex-row bd-highlight">
              <div class="">
                <div class="dropdown cu-dropdown">
                  <a
                    class="btn border-left"
                    type="button"
                    id="dropdownMenuButtonn"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <img src="{{ asset('admin/images/notify.png')}}" alt="" />
                  </a>
                  <div
                    class="dropdown-menu custom-dropdown-menu"
                    aria-labelledby="dropdownMenuButtonn"
                  >
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-cog"></i> Settings</a
                    >
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                  </div>
                </div>
              </div>
              <div class="">
                <div class="dropdown cu-dropdown">
                  <a
                    class="btn border-right"
                    type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <img src="{{ asset('admin/images/message.png')}}" alt="" />
                  </a>
                  <div
                    class="dropdown-menu custom-dropdown-menu"
                    aria-labelledby="dropdownMenuButton"
                  >
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-cog"></i> Settings</a
                    >
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                  </div>
                </div>
              </div>
              <div class="">
                <div class="dropdown">
                  <a
                    class="btn"
                    type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    <img src="{{ asset('admin/images/employe.png')}}" alt="" />
                  </a>
                  <div
                    class="dropdown-menu custom-dropdown-menu"
                    aria-labelledby="dropdownMenuButton"
                  >
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-cog"></i> Settings</a
                    >
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                  </div>
                </div>
              </div>
            </div>

            </div>

          </div>
        </div>
      </div>
    </section>


    <section>
      <div class="container-fluid">
        <div id="wrapper">
          <!-- ===== sidebar-wrapper start ====== -->
          <div id="sidebar-wrapper">
            <ul class="sidebar-nav ">
              <div class="text-center my-4">
                <img class="img-fluid" src="{{ asset('admin/images/main-logo.png')}}" alt="" />
              </div>

              <div class="profile-bio text-center">
                <h5 class="mb-0">Scarlett Johansson</h5>
                <p class="mt-1">Steven tailr</p>
              </div>

              <li class="active">
                <a href="#">
                  <img src="{{ asset('admin/images/01.png')}}" alt="image" />
                  <span >Dashboard</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{{ asset('admin/images/02.png')}}" alt="image" />
                  <span>Add Student</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{{ asset('admin/images/03.png')}}" alt="image" />
                  <span class=pl-4>List of Students </span>
                </a>
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
              <li>
                <a href="#">
                  <img src="{{ asset('admin/images/09.png')}}" alt="image" />
                  <span>Setting</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="{{ asset('admin/images/010.png')}}" alt="image" />
                  <span>Setting</span>
                </a>
              </li>
            </ul>
          </div>


          <!-- ====== sidebar-wrapper end ====== -->

          <!-- ====== page-content-wrapper start ====== -->

          <div id="page-content-wrapper">
            <section class="container-fluid">
              <div class="row ">
                <div class="col-md-3">
                  <div class="card custom-cards custom-card-1 text-white">
                    <div class="card-body">
                      <div class="float-left card-image mt-3">
                        <img src="{{ asset('admin/images/card-0.png')}}" alt="" />
                      </div>
                      <span class="vertical-line"></span>

                      <div class="float-right card-content mt-3">
                        <span>Course</span>
                        <p class="mb-0">6000</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card custom-cards custom-card-2 text-white">
                    <div class="card-body">
                      <div class="float-left card-image mt-2">
                        <img src="{{ asset('admin/images/card-1.png')}}" alt="" />
                      </div>
                      <span class="vertical-line"></span>
                      <div class="float-right card-content mt-3">
                        <span>Course</span>
                        <p class="mb-0">6000</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card custom-cards custom-card-3 text-white">
                    <div class="card-body">
                      <div class="float-left card-image mt-2">
                        <img src="{{ asset('admin/images/card-2.png')}}" alt="" />
                      </div>
                      <span class="vertical-line"></span>
                      <div class="float-right card-content mt-3">
                        <span>Course</span>
                        <p class="mb-0">6000</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card custom-cards custom-card-4 text-white">
                    <div class="card-body">
                      <div class="float-left card-image mt-3">
                        <img src="{{ asset('admin/images/card-3.png')}}" alt="" />
                      </div>
                      <span class="vertical-line"></span>
                      <div class="float-right card-content mt-3">
                        <span>Course</span>
                        <p class="mb-0">6000</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <section class="content-area mt-2">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 mt-3">
                    <div class="student-card bg-white pt-4 pb-3">
                      <h4>Students List</h4>
                      <div class="d-flex student-list flex-row bd-highlight mb-3">
                        <div class="p-2 bd-highlight tab-heading flex-grow-1 pl-4">Full Name</div>
                        <div class="p-2 customize tab-heading  bd-highlight">Position</div>
                        <div class="p-2 customize tab-heading  bd-highlight">Age</div>
                        <div class="p-2 customize tab-heading bd-highlight mr-4">Grade</div>
                      </div>
                      <div class="d-flex custom-gray shadow-sm student-list-name flex-row bd-highlight mb-3">
                        <div class=" bd-highlight mr-3">
                          <img class="img-fluid " src="{{ asset('admin/images/student-1.png')}}" alt="">
                        </div>
                        <div class="p-2 bd-highlight customize-2 flex-grow-1 customize-3 ">Ronny</div>
                        <div class="p-2 customize-1 pl-2 bd-highlight">A+</div>
                        <div class="p-2 customize-1 bd-highlight">23</div>
                        <div class="p-2 customize  ml-2 customize-4 bd-highlight">1</div>
                      </div>
                      <div class="d-flex student-list-name flex-row bd-highlight mb-3">
                        <div class=" bd-highlight mr-3">
                          <img class="img-fluid " src="{{ asset('admin/images/student-2.png')}}" alt="">
                        </div>
                        <div class="p-2 bd-highlight customize-2 flex-grow-1  customize-3">Riana Right</div>
                        <div class="p-2 customize-1 bd-highlight">B</div>
                        <div class="p-2 customize-1 bd-highlight">19</div>
                        <div class="p-2 customize ml-2 customize-4 bd-highlight">1</div>
                      </div>
                      <div class="d-flex custom-gray shadow-sm student-list-name flex-row bd-highlight mb-3">
                        <div class=" bd-highlight mr-3">
                          <img class="img-fluid " src="{{ asset('admin/images/student-3.png')}}" alt="">
                        </div>
                        <div class="p-2 bd-highlight customize-2 flex-grow-1 customize-3">Yabes Alamanda</div>
                        <div class="p-2 customize-1 bd-highlight">A</div>
                        <div class="p-2 customize-1 bd-highlight">29</div>
                        <div class="p-2 customize ml-2 customize-4 bd-highlight">1</div>
                      </div>
                      <div class="d-flex student-list-name flex-row bd-highlight mb-3">
                        <div class=" bd-highlight mr-3">
                          <img class="img-fluid " src="{{ asset('admin/images/student-4.png')}}" alt="">
                        </div>
                        <div class="p-2 bd-highlight customize-2 flex-grow-1 customize-3">Woo ush Lee</div>
                        <div class="p-2 customize-1 bd-highlight">D</div>
                        <div class="p-2 customize-1 bd-highlight">21</div>
                        <div class="p-2 customize ml-2 customize-4 bd-highlight">1</div>
                      </div>

                    </div>
                    <div class="notify-box">
                      <h5 class="float-left mt-2">Activies Notification</h5>
                      <a
                        class="btn btn-outline-success float-right px-3 py-1"
                        href=""
                        >View All</a
                      >
                      <div class="clearfix"></div>
                      <div class="py-3">
                        <h4>Lorem Ipsum</h4>
                        <h3>02 Nov, 2021</h3>
                        <p>
                          Lorem Ipsum is simply dummy text of the printing and
                          typesetting industry. Lorem Ipsum has been the
                          industry's standard dummy text ever since the 1500s,
                        </p>
                      </div>

                      <div class="">
                        <h4>Lorem Ipsum</h4>
                        <h3>02 Nov, 2021</h3>
                        <p>
                          Lorem Ipsum is simply dummy text of the printing and
                          typesetting industry. Lorem Ipsum has been the
                          industry's standard dummy text ever since the 1500s,
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="student-performance pb-0">
                      <h5 class="float-left mt-2">Students Performance</h5>
                      <span class="float-right px-3 py-1"
                        >All the data in percentage (%)</span
                      >
                      <div class="clearfix"></div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="py-3 student-performance-data">
                            <div class="media">
                              <span class="badge badge-1 badge-primary"
                                ><p style="opacity: 0">a</p></span
                              >
                              <div class="media-body ml-2">
                                <h5 class="mt-0 mb-0">Govt School</h5>
                                <p>Performance</p>
                              </div>
                            </div>
                            <div class="media">
                              <span class="badge badge-2 badge-primary"
                                ><p style="opacity: 0">a</p></span
                              >
                              <div class="media-body ml-2">
                                <h5 class="mt-0 mb-0">Private School</h5>
                                <p>Performance</p>
                              </div>
                            </div>
                            <div class="media">
                              <span class="badge badge-3 badge-primary"
                                ><p style="opacity: 0">a</p></span
                              >
                              <div class="media-body ml-2">
                                <h5 class="mt-0 mb-0">Avarage School</h5>
                                <p>Performance</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div>
                            <img
                              class="img-fluid mt-3 w-100"
                              src="{{ asset('admin/images/graph-01.png')}}"
                              alt=""
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="top-results ">
                      <h5 class="mt-2 mb-3">Top Position</h5>
                      <img class="w-100 img-fluid" src="{{ asset('admin/images/yearly-graph.png')}}" alt="">


                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>

          <!-- ====== page-content-wrapper end ====== -->
        </div>
      </div>
    </section>

          <!-- about agency -->
  <section class="last-footer mt-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <p>© Copyright 2021 KMABIZ. All rights reserved</p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 text-right-last">
          <p class="float-bottm">
            Designed & Developed by
            <a href="https://leadconcept.com/" target="_blank">LEADconcept</a>
          </p>
        </div>
      </div>
    </div>
  </section>


    <script src="{{asset("admin/js/jquery.js")}}"></script>
    <script src="{{asset("admin/js/bootstrap.min.js")}}"></script>
    <script src="{{asset("admin/js/scripts.js")}}"></script>
  </body>
</html>
