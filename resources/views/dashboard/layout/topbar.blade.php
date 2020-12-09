 
<header class="main-header w3-block"  id="topbarDiv">
    <nav class="navbar navbar-static-top w3-top">
        <div class="container">
            <div class="navbar-header">
                <a href="#"  onclick="showPage('dashboard/main')" class="navbar-brand">
                    <img src="{{ url('/') }}/image/logo.png" style="width: 40px" >
                </a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="navbar-collapse pull-right collapse" id="navbar-collapse" aria-expanded="false" style="height: 1px;">
                <ul class="nav navbar-nav">
                     
                    @if (Auth::user()->type == 'student')
                    <li  onclick="showPage('student/exam')" ><a href="#">{{ __('exams room') }}</a></li>
                    <li  onclick="showPage('student/myexam')" ><a href="#">{{ __('my exams') }}</a></li>
                    @endif
                    
                    @if (Auth::user()->type == 'doctor')
                    <li  onclick="showPage('category')" ><a href="#">{{ __('category') }}</a></li>
                    <li  onclick="showPage('doctor-course')" ><a href="#">{{ __('course') }}</a></li>
                    <li  onclick="showPage('question')" ><a href="#">{{ __('questions') }}</a></li>
                    <li  onclick="showPage('exam')" ><a href="#">{{ __('exam') }}</a></li>
                    <li  onclick="showPage('student-exam')" ><a href="#">{{ __('student exams') }}</a></li> 
                    @endif
                    
                     
                    <!--
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                    -->
                </ul> 
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    
                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <span class="label label-success" v-html="notifications.length <= 0? '' : notifications.length" ></span>
                        </a>
                        <ul class="dropdown-menu w3-round shadow">
                            <li class="header text-center">لديك <span v-html="notifications.length" ></span> اشعارات لم تقراء</li>
                            <li  v-for="notification in notifications"  >
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">
                                    <li><!-- start notification -->
                                        <a href="#">
                                            <i v-bind:class="notification.icon + ' w3-text-teal'"></i> <span  v-html="notification.message"  ></span> 
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
                        <ul class="dropdown-menu" style="left: 0px" >
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
                                    <div class="col-xs-4 text-center" onclick="showPage('questions')" >
                                        <a href="#">{{ __('questions') }}</a>
                                    </div> 
                                    <div class="col-xs-4 text-center" onclick="showPage('exam')" >
                                        <a href="#">{{ __('exam') }}</a>
                                    </div>   
                                    <div class="col-xs-4 text-center" onclick="showPage('doctor-course')" >
                                        <a href="#">{{ __('course') }}</a>
                                    </div>   
                                    @elseif (Auth::user()->type == 'admin')
                                    <div class="col-xs-4 text-center" onclick="showPage('questions')" >
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
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>