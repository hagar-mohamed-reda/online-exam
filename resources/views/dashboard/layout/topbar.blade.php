

<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo "   >
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <img src="{{ url('/') }}/image/user.png" width="30px" >
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img src="{{ url('/') }}/image/user.png" width="50px" >
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top btn-" style="height: 50px" >
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" style="height: 50px;" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu" style="margin-right: 230px" id="topbarDiv" >
            <ul class="nav navbar-nav">


                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell"></i>
                        <span class="label label-success" v-html="notifications.length <= 0? '' : notifications.length" ></span>
                    </a>
                    <ul class="dropdown-menu w3-round shadow" style="left: 20px;" >
                        <li class="header text-center">لديك <span v-html="notifications.length" ></span> اشعارات لم تقراء</li>
                        <li  v-for="notification in notifications"  >
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i v-bind:class="notification.icon + ' w3-text-teal'"></i> <span  v-html="notification.body"  ></span> 
                                    </a>
                                </li>
                                <!-- end notification -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>


                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ url('/') }}/image/user.png" width="30px" class="user-image"  >  
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu w3-round shadow" style="left: 0px" >
                        <!-- The user image in the menu -->
                        <li class="user-header w3-teal" >
                            <img src="{{ url('/') }}/image/user.png" width="30px" class="img-circle"  > 

                            <p>
                                {{ Auth::user()->name }}
                                <small>{{ Auth::user()->created_at }}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                @if (Auth::user()->type == 'student')
                                <div class="col-xs-6 text-center" onclick="showPage('student/exam')" >
                                    <a href="#">{{ __('exams room') }}</a>
                                </div> 
                                <div class="col-xs-6 text-center" onclick="showPage('student/myexam')" >
                                    <a href="#">{{ __('my exams') }}</a>
                                </div>   
                                @elseif (Auth::user()->type == 'doctor')
                                <div class="col-xs-4 text-center" onclick="showPage('question')" >
                                    <a href="#">{{ __('questions') }}</a>
                                </div> 
                                <div class="col-xs-4 text-center" onclick="showPage('exam')" >
                                    <a href="#">{{ __('exam') }}</a>
                                </div>   
                                <div class="col-xs-4 text-center" onclick="showPage('doctor-course')" >
                                    <a href="#">{{ __('course') }}</a>
                                </div>   
                                @elseif (Auth::user()->type == 'admin')
                                <div class="col-xs-4 text-center" onclick="showPage('question')" >
                                    <a href="#">{{ __('questions') }}</a>
                                </div> 
                                <div class="col-xs-4 text-center" onclick="showPage('exam')" >
                                    <a href="#">{{ __('exam') }}</a>
                                </div>   
                                <div class="col-xs-4 text-center" onclick="showPage('doctor-course')" >
                                    <a href="#">{{ __('course') }}</a>
                                </div>   
                                @endif
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left"  onclick="showPage('profile')"  >
                                <a href="#" class="btn btn-default btn-flat">{{ __('profile') }}</a>
                            </div>
                            <div class="pull-right"   >
                                <a href="{{ url('/') }}/logout"  class="btn btn-default btn-flat">{{ __('logout') }}</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>