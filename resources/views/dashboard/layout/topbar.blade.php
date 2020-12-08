
 
  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo shadow" style="background-image: url({{ url('image/header.png') }});background-size: cover;min-height: 50px;" >
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
      <a href="#" class="sidebar-toggle" style="height: 65px;" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu" style="margin-right: 230px" id="topbarDiv" >
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
              <span class="label label-success" v-html="notifications.length <= 0? '' : notifications.length" ></span>
            </a>
              <ul class="dropdown-menu w3-round shadow" style="left: 0!important;right:auto!important;" >
                  <li class="header text-center">لديك <span v-html="notifications.length" ></span> اشعارات لم تقراء</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu nicescroll">
                    <li v-for="notification in notifications" onclick="showPage('dashboard/notification')" ><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                          <!--
                        <img v-bind:src="notification.icon" class="img-circle" alt="User Image">
                          -->
                          <span class="fa fa-bell" ></span>
                      </div>
                      <h4>
                          <span v-html="notification.title" ></span>
                          <small><i class="fa fa-clock-o" ></i> <b v-html="notification.created_at" ></b></small>
                      </h4>
                      <p v-html="notification.message" ></p>
                    </a>
                  </li> 
                </ul>
              </li>
              
<!--              <li class="footer"><a href="#">See All Messages</a></li>-->
              
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ url('/') }}/image/user.png" class="user-image" alt="User Image">
              <span class="hidden-xs"> </span>
            </a>
            <ul class="dropdown-menu shadow w3-white w3-round">
              <!-- User image -->
              <li class="user-header w3-white w3-round">
                 
                <img src="{{ url('/') }}/image/user.png" class="img-circle" alt="User Image">

                <div class="pull-right">
                    <div class="w3-large" >{{ Auth::user()->name }}</div>
                    <br>
                    <a href="#" onclick="showPage('profile')" class="btn btn-primary w3-round shadow btn-sm ">{{ __('profile') }}</a>
                    <br>
                    <br>
                    <a href="{{ url('/') }}/logout"  class="btn w3-red w3-round shadow btn-sm ">{{ __('logout') }}</a>
                </div>
              </li>  
            </ul>
          </li> 
        </ul>
      </div>
    </nav>
  </header>