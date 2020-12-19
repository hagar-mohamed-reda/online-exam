 
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar shadow"  >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar  ">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="background: url({{ url('/image/nav.jpg') }}) contain no-repeat;height: 150px;padding-top: 50px;" >
            <div class="pull-left image">
                @if (Auth::user()->photo)
                <img src="{{ url('/') }}/image/users/{{ Auth::user()->photo }}" class="img-circle" alt="User Image">
                @else
                <img src="{{ url('/') }}/image/user.png" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="pull-left info w3-padding">
                <b>{{ Auth::user()->name }}</b> 
            </div>
        </div> 
        
        <ul class="sidebar-menu font" data-widget="tree">
            <li class="header text-uppercase">{{ __('main navigation') }}</li>
             
            <li class="treeview font w3-text-amber" onclick="showPage('dashboard/main')" >
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>{{ __('dashboard') }}</span> 
                </a>
            </li>    
            
            @if (Auth::user()->type == 'admin')
              
            <li class="treeview font w3-text-indigo" onclick="showPage('category')">
                <a href="#">
                    <i class="fa fa-address-book-o"></i> <span>{{ __('category') }}</span> 
                </a>
            </li>  
              
            <li class="treeview font w3-text-indigo" onclick="showPage('degreemap')">
                <a href="#">
                    <i class="fa fa-percent"></i> <span>{{ __('degreemap') }}</span> 
                </a>
            </li>  
              
            <li class="treeview font w3-text-indigo" onclick="showPage('department')">
                <a href="#">
                    <i class="fa fa-bank"></i> <span>{{ __('department') }}</span> 
                </a>
            </li>  
              
            <li class="treeview font w3-text-indigo" onclick="showPage('dashboard/doctor')">
                <a href="#">
                    <i class="fa fa-users"></i> <span>{{ __('doctors') }}</span> 
                </a>
            </li>  
              
            <li class="treeview font w3-text-indigo" onclick="showPage('dashboard/student')">
                <a href="#">
                    <i class="fa fa-users"></i> <span>{{ __('students') }}</span> 
                </a>
            </li>  
              
            <li class="treeview font w3-text-indigo" onclick="showPage('course')">
                <a href="#">
                    <i class="fa fa-desktop"></i> <span>{{ __('course') }}</span> 
                </a>
            </li>  
              
            <!--
            <li class="treeview font w3-text-indigo" onclick="showPage('user')">
                <a href="#">
                    <i class="fa fa-users"></i> <span>{{ __('users') }}</span> 
                </a>
            </li>  
            
            -->
             
            <li class="treeview font w3-text-indigo" onclick="showPage('question')">
                <a href="#">
                    <i class="fa fa-comment"></i> <span>{{ __('questions') }}</span> 
                </a>
            </li>  
             
            <li class="treeview font w3-text-indigo" onclick="showPage('exam')">
                <a href="#">
                    <i class="fa fa-comment"></i> <span>{{ __('exams') }}</span> 
                </a>
            </li>  
             
            <li class="treeview font w3-text-indigo" onclick="showPage('student-exam')">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>{{ __('student exams') }}</span> 
                </a>
            </li>  
             
            @elseif (Auth::user()->type == 'doctor')   
              
            <li class="treeview font w3-text-indigo" onclick="showPage('category')">
                <a href="#">
                    <i class="fa fa-address-book-o"></i> <span>{{ __('category') }}</span> 
                </a>
            </li>  
              
           
              
            <li class="treeview font w3-text-indigo" onclick="showPage('doctor-course')">
                <a href="#">
                    <i class="fa fa-desktop"></i> <span>{{ __('course') }}</span> 
                </a>
            </li>  
            
             
            <li class="treeview font w3-text-indigo" onclick="showPage('question')">
                <a href="#">
                    <i class="fa fa-comment"></i> <span>{{ __('questions') }}</span> 
                </a>
            </li>  
             
            <li class="treeview font w3-text-indigo" onclick="showPage('exam')">
                <a href="#">
                    <i class="fa fa-comment"></i> <span>{{ __('exams') }}</span> 
                </a>
            </li>  
            
            <li class="treeview font w3-text-indigo" onclick="showPage('student-exam')">
                <a href="#">
                    <i class="fa fa-desktop"></i> <span>{{ __('student exams') }}</span> 
                </a>
            </li>   
          
            @elseif (Auth::user()->type == 'student')
              
            <li class="treeview font w3-text-indigo" onclick="showPage('student/exam')">
                <a href="#">
                    <i class="fa fa-desktop"></i> <span>{{ __('exams room') }}</span> 
                </a>
            </li>  
              
            <li class="treeview font w3-text-indigo" onclick="showPage('student/myexam')">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>{{ __('my exams') }}</span> 
                </a>
            </li>  
            
            @endif
            
            
           
             
<!--            <li class="treeview font w3-text-brown" >
                <a href="#">
                    <i class="fa fa-bar-chart"></i> <span>التقارير</span> 
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li  onclick="showPage('dashboard/report/productorders')" ><a href="#"><i class="fa fa-line-chart"></i> مبيعات الاصناف</a></li> 
                    <li  onclick="showPage('dashboard/report/productviews')" ><a href="#"><i class="fa fa-bar-chart"></i> مشاهدات الاصناف</a></li> 
                    <li  onclick="showPage('dashboard/report/orders')" ><a href="#"><i class="fa fa-shopping-cart"></i> الطلبات</a></li>  
                </ul>
            </li>-->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>