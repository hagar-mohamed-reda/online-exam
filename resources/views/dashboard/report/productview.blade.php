@extends("dashboard.layout.page")

@section("reportTitle")
    تقرير احصائيات المنتجات
@endsection

@section("reportContent") 
    <!--Div that will hold the pie chart-->
    <div id="chart_div" class="w3-block" ></div>
    <br>
    <br>
    <div class="row" >
        <div class="col l6 m6 s12" >
            <div id="chart_div2" class="w3-block" ></div>
        </div>
        <div class="col l6 m6 s12" >
            <table class="table table-bordered dataTable" id="table" >  
                <thead>
                    <tr>
                        <th>الكود</th>
                        <th>المنتج</th>
                        <th>المشاهدات</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php $counter = 1;  ?>
                    @foreach($productViews as $pp)
                    <tr>
                        <td>{{ $counter ++ }}</td>
                        <td>{{ App\Product::find($pp->p)->name_ar }}</td>
                        <td>{{ $pp->count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section("scripts")
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        data.addColumn('string', 'product');
        data.addColumn('number', 'views');
        data.addRows([
            @foreach($productViews as $pp)
            ['{{ App\Product::find($pp->p)->name_ar }}', {{ $pp->count }}], 
            @endforeach
        ]);

        // Set chart options
        var options = {'title': 'مشاهدات المنتجات', 
            'height': 300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
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
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            @foreach($productViews as $pp)
            ['{{ App\Product::find($pp->p)->name_ar }}', {{ $pp->count }}], 
            @endforeach
        ]);

        // Set chart options
        var options = {'title': 'مشاهدات المنتجات', 
            'height': 300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
    }
    
</script>
@endsection
