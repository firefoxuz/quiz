<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{__('data.site.title')}}</title>
    <!--Plugin CSS-->
    <link href="{{asset('template/css/plugins.min.css')}}" rel="stylesheet">
    <!--main Css-->
    <link href="{{asset('template/css/main.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('datepickerjs/datepicker.css')}}">
    @livewireStyles
</head>
<body>
<!-- header-->
<div id="header-fix" class="header py-4 py-lg-2 fixed-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-3 col-xl-2 align-self-center">
                <div class="site-logo">
                    <a href="index-2.html"><img src="dist/images/logo-v1.png" alt="" class="img-fluid"/></a>
                </div>
                <div class="navbar-header">
                    <button type="button" id="sidebarCollapse" class="navbar-btn bg-transparent float-right">
                        <i class="glyphicon glyphicon-align-left"></i>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-lg-3 align-self-center d-none d-lg-inline-block">
            </div>
            <div class="col-12 col-lg-6 col-xl-7 d-none d-lg-inline-block">
                <nav class="navbar navbar-expand-lg p-0">
                    <ul class="navbar-nav notification ml-auto d-inline-flex">
                        <li class="nav-item dropdown  align-self-center">
                            <ul class="dropdown-menu border-bottom-0 rounded-0 py-0">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="media py-2">
                                            <img src="dist/images/author.jpg" alt=""
                                                 class="d-flex mr-3 img-fluid redial-rounded-circle-50"/>
                                            <div class="media-body">
                                                <h6 class="mb-0">john send a message</h6>
                                                <small class="redial-light">12 min ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="media py-2">
                                            <img src="dist/images/author2.jpg" alt=""
                                                 class="d-flex mr-3 img-fluid redial-rounded-circle-50"/>
                                            <div class="media-body">
                                                <h6 class="mb-0">Peter send a message</h6>
                                                <small class="redial-light">15 min ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="media py-2">
                                            <img src="dist/images/author3.jpg" alt=""
                                                 class="d-flex mr-3 img-fluid redial-rounded-circle-50"/>
                                            <div class="media-body">
                                                <h6 class="mb-0">Bill send a message</h6>
                                                <small class="redial-light">5 min ago</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li><a class="dropdown-item text-center py-2" href="#"> <strong>Read All Message <i
                                                class="fa fa-angle-right pl-2"></i></strong></a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown  align-self-center">
                            <ul class="dropdown-menu border-bottom-0 rounded-0 py-0">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="media py-2">
                                            <img src="dist/images/author.jpg" alt=""
                                                 class="d-flex mr-3 img-fluid redial-rounded-circle-50"/>
                                            <div class="media-body">
                                                <h6 class="mb-0">john</h6>
                                                <small class="redial-light"> New user registered. </small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="media py-2">
                                            <img src="dist/images/author2.jpg" alt=""
                                                 class="d-flex mr-3 img-fluid redial-rounded-circle-50"/>
                                            <div class="media-body">
                                                <h6 class="mb-0">Peter</h6>
                                                <small class="redial-light"> Server #12 overloaded. </small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="media py-2">
                                            <img src="dist/images/author3.jpg" alt=""
                                                 class="d-flex mr-3 img-fluid redial-rounded-circle-50"/>
                                            <div class="media-body">
                                                <h6 class="mb-0">Bill</h6>
                                                <small class="redial-light"> Application error. </small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li><a class="dropdown-item text-center py-3" href="#"> <strong>See All Tasks <i
                                                class="fa fa-angle-right pl-2"></i></strong></a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown user-profile align-self-center">
                            <a class="nav-link" data-toggle="dropdown" aria-expanded="false">
                                <span class="float-right pl-3 text-white"><i class="fa fa-angle-down"></i></span>
                                <div class="media">
                                    <img src="dist/images/author.jpg" alt=""
                                         class="d-flex mr-3 img-fluid redial-rounded-circle-50" width="45"/>
                                    <div class="media-body align-self-center">
                                        <p class="mb-2 text-white text-uppercase font-weight-bold">John Deo</p>
                                        <small class="redial-primary-light font-weight-bold text-white"> Admin </small>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu border-bottom-0 rounded-0 py-0">
                                <li><a class="dropdown-item py-2" href="#"><i class="fa fa-user pr-2"></i> User Profile</a>
                                </li>
                                <li><a class="dropdown-item py-2" href="#"><i class="fa fa-cog pr-2"></i> Setting</a>
                                </li>
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="method" value="DELETE">
                                    <li>
                                        <button type="submit" class="dropdown-item py-2"><i
                                                class="fa fa-sign-out pr-2"></i> logout
                                        </button>
                                    </li>
                                </form>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End header-->

<!-- Main-content Top bar-->
<div class="redial-relative mt-80">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-2 align-self-center my-3 my-lg-0">
                <h6 class="text-uppercase redial-font-weight-700 redial-light mb-0 pl-2">Dashboard</h6>
            </div>
            <div class="col-12 col-md-4 align-self-center">
            </div>
            <div class="col-12 col-md-6">
            </div>
        </div>
    </div>
</div>
<!-- End Main-content Top bar-->

<!-- main-content-->
<div class="wrapper">
    @include('layout.sidebar')
    <div id="content">

        @yield('content')
    </div>
</div>
<!-- End main-content-->

<!-- Top To Bottom--> <a href="#" class="scrollup text-center redial-bg-primary redial-rounded-circle-50 ">
    <h4 class="text-white mb-0"><i class="icofont icofont-long-arrow-up"></i></h4>
</a>
<!-- End Top To Bottom-->

<!-- jQuery -->
<script src="{{asset('template/js/plugins.min.js')}}"></script>
<script src="{{asset('template/js/common.js')}}"></script>
<script src="{{asset('template/js/toastr.js')}}"></script>
@livewireScripts
@yield('scripts')
</body>
</html>
