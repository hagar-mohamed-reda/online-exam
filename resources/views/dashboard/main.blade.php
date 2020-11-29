
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
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a class="info-box" href="#"  >
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('users') }}</span>
                    <span class="info-box-number">{{ App\User::count() }}<small></small></span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a class="info-box"  href="#"    >
                <span class="info-box-icon bg-red"><i class="fa fa-ticket"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('products') }}</span>
                    <span class="info-box-number">{{ App\Product::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a class="info-box"    >
                <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('categories') }}</span>
                    <span class="info-box-number">{{ App\Category::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
 
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a class="info-box"   >
                <span class="info-box-icon bg-yellow"><i class="fa fa-gift"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('gifts') }}</span>
                    <span class="info-box-number">{{ App\Gift::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div> 

        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a class="info-box" href="#"  >
                <span class="info-box-icon bg-teal"><i class="fa fa-file-excel-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('sheets') }}</span>
                    <span class="info-box-number">{{ App\Sheet::count() }}<small></small></span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a class="info-box"  href="#"     >
                <span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('customers') }}</span>
                    <span class="info-box-number">{{ App\Customer::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a class="info-box"  href="#"     >
                <span class="info-box-icon w3-teal"><i class="fa fa-map-marker"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('areas') }}</span>
                    <span class="info-box-number">{{ App\Area::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a class="info-box"  href="#"     >
                <span class="info-box-icon bg-purple"><i class="fa fa-building"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('cities') }}</span>
                    <span class="info-box-number">{{ App\City::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </a>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
  
        <!-- /.col -->
    </div>
    <div class="row">
        
        <div class="col-lg-6 col-md-6 col-sm-6">
            
            <div class="shadow w3-round box">
                <div class="box-header with-border">
                    <h3 class="box-title font">{{ __('gifts') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button> 
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="padding: 5px!important" >
                    <div id="chart_div3" class="w3-block" ></div> 
                </div>
                <!-- ./box-body -->
                <div class="box-footer"> 
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div> 
            
            <!-- /.box -->
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            
            <div class="shadow w3-round box">
                <div class="box-header with-border">
                    <h3 class="box-title font">{{ __('classes of customers') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button> 
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="padding: 5px!important" >
                    <div id="chart_class" class="w3-block" ></div> 
                </div>
                <!-- ./box-body -->
                <div class="box-footer"> 
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div> 
            
            <!-- /.box -->
        </div> 
        
        
       
    </div>
    <br>
    <br>
    <br>
    <!-- /.row -->

</section>
<script src="{{ url('/') }}/js/Chart.min.js"></script> 
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
        data.addColumn('string', '{{ __("gift") }}');
        data.addColumn('number', '{{ __("amount") }}');
        data.addRows([ 
            @foreach(App\Gift::all() as $item)
            @if ($item->amount >= 0)
            ['{{ $item->name }}', {{ $item->amount }}],
            @endif
            @endforeach 
        ]);

        // Set chart options
        var options = {'title': "{{ __('gifts') }}", 
          is3D: true,
            'height': 400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
    }
    
</script>
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
        data.addColumn('string', '{{ __("class") }}');
        data.addColumn('number', '{{ __("customer count") }}');
        data.addRows([ 
            ['A', {{ App\Customer::where('class', 'A')->count() }}], 
            ['B', {{ App\Customer::where('class', 'B')->count() }}], 
            ['C', {{ App\Customer::where('class', 'C')->count() }}], 
            ['D', {{ App\Customer::where('class', 'D')->count() }}], 
        ]);

        // Set chart options
        var options = {'title': "{{ __('classes of customers') }}", 
          is3D: true,
            'height': 400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_class'));
        chart.draw(data, options);
    }
    
</script>