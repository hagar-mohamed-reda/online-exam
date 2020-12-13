
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="font w3-xxlarge" >
        {{ __('dashboard') }} 
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li class="active">{{ __('dashboard') }}</li>
    </ol>
</section>

<!-- Main content -->
<section class="content" style="overflow: auto!important" >
    <!-- Info boxes -->
    <div class="row">
        @if (Auth::user()->type == 'student')
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <a class="info-box"  href="#"   onclick="showPage('student/exam')"  >
                <span class="info-box-icon bg-teal"><i class="fa fa-newspaper-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('exams room') }}</span>
                    <span class="info-box-number">{{ Auth::user()->toStudent()->exams()->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" >
            <a class="info-box" href="#"  >
                <span class="info-box-icon bg-aqua"><i class="fa fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('courses') }}</span>
                    <span class="info-box-number">{{ Auth::user()->toStudent()->courses()->count() }}<small></small></span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <a class="info-box"  href="#"    onclick="showPage('student/myexam')" >
                <span class="info-box-icon bg-red"><i class="fa fa-newspaper-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('exams') }}</span>
                    <span class="info-box-number">{{ Auth::user()->toStudent()->studentExams()->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        @endif
        <!-- /.col -->
        @if (Auth::user()->type == 'doctor')
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12" onclick="showPage('category')">
            <a class="info-box"  href="#"    >
                <span class="info-box-icon bg-red"><i class="fa fa-th-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('categories') }}</span>
                    <span class="info-box-number">{{ Auth::user()->toDoctor()->categories()->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" onclick="showPage('doctor-course')">
            <a class="info-box" href="#"  >
                <span class="info-box-icon bg-aqua"><i class="fa fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('courses') }}</span>
                    <span class="info-box-number">{{ Auth::user()->toDoctor()->doctorCourses()->count() }}<small></small></span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12" onclick="showPage('exam')">
            <a class="info-box"  href="#"    >
                <span class="info-box-icon bg-red"><i class="fa fa-newspaper-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('exams') }}</span>
                    <span class="info-box-number">{{ Auth::user()->toDoctor()->exams()->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        @endif
        <!-- /.col -->
        @if (Auth::user()->type == 'admin')
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12" onclick="showPage('category')">
            <a class="info-box"  href="#"    >
                <span class="info-box-icon bg-red"><i class="fa fa-th-list"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('categories') }}</span>
                    <span class="info-box-number">{{ App\Category::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" onclick="showPage('doctor-course')">
            <a class="info-box" href="#"  >
                <span class="info-box-icon bg-aqua"><i class="fa fa-graduation-cap"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('courses') }}</span>
                    <span class="info-box-number">{{ App\Course::count() }}<small></small></span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12" onclick="showPage('exam')">
            <a class="info-box"  href="#"    >
                <span class="info-box-icon bg-red"><i class="fa fa-newspaper-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('exams') }}</span>
                    <span class="info-box-number">{{ App\Exam::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        @endif
        <!-- /.col -->
  
 
       
  
        <!-- /.col -->
    </div>
    <div class="row">
        
        @if (Auth::user()->type == 'student')
        <div class="col-lg-12 col-md-12 col-sm-12">
            
            <div class="shadow w3-round box">
                <div class="box-header with-border">
                    <h3 class="box-title font">{{ __('exams') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button> 
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="padding: 5px!important" >
                    <div id="chart_div3" style="width: 90%" ></div> 
                </div>
                <!-- ./box-body -->
                <div class="box-footer"> 
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div> 
            
            <!-- /.box -->
        </div>
        @endif
        
        
        @if (Auth::user()->type == 'doctor' || Auth::user()->type == 'admin')
        <div class="col-lg-12 col-md-12 col-sm-12">
            
            <div class="shadow w3-round box">
                <div class="box-header with-border">
                    <h3 class="box-title font">{{ __('exams') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button> 
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="padding: 5px!important" >
                    <div id="chart_class" style="width: 90%" ></div> 
                </div>
                <!-- ./box-body -->
                <div class="box-footer"> 
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div> 
            
            <!-- /.box -->
        </div> 
        @endif
        
        
       
    </div>
    <br>
    <br>
    <br>
    <!-- /.row -->

</section>
<script src="{{ url('/') }}/js/Chart.min.js"></script>        
        @if (Auth::user()->type == 'student')
<script type="text/javascript">

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages': ['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', '{{ __("exam") }}');
        data.addColumn('number', '{{ __("grade") }}');
        data.addRows([ 
            @foreach(Auth::user()->toStudent()->studentExams()->get() as $item) 
            ['{{ optional($item->exam)->name }}', {{ $item->grade }}], 
            @endforeach 
        ]);

        // Set chart options
        var options = {'title': "{{ __('exams') }}", 
          is3D: true,
            'height': 400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.AreaChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
    }
    
</script>        
@endif
        @if (Auth::user()->type == 'doctor')
<script type="text/javascript">

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages': ['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', '{{ __("exam") }}');
        data.addColumn('number', '{{ __("grade") }}');
        data.addRows([ 
            @foreach(Auth::user()->toDoctor()->exams()->get() as $item) 
            ['{{ $item->name }}', {{ $item->total }}], 
            @endforeach 
        ]);

        // Set chart options
        var options = {'title': "{{ __('exams') }}", 
          is3D: true,
            'height': 400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.AreaChart(document.getElementById('chart_class'));
        chart.draw(data, options);
    }
    
</script>
@endif
        @if (Auth::user()->type == 'admin')
<script type="text/javascript">

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages': ['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', '{{ __("exam") }}');
        data.addColumn('number', '{{ __("grade") }}');
        data.addRows([ 
            @foreach(App\Exam::all() as $item) 
            ['{{ $item->name }}-{{ optional($item->doctor)->name }}', {{ $item->total }}], 
            @endforeach 
        ]);

        // Set chart options
        var options = {'title': "{{ __('exams') }}", 
          is3D: true,
            'height': 400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.AreaChart(document.getElementById('chart_class'));
        chart.draw(data, options);
    }
    
</script>
@endif