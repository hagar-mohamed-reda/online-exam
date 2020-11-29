@extends("dashboard.layout.page")

@section("reportTitle")
تقرير الطلبات
@endsection

@section("reportOptions")
<!--<form action="" method="get" >
    <div class="w3-row box shadow w3-round" style="width: 70%;margin: auto;padding: 10px" >
        <div class="box-title" >
            select orders between two dates
        </div>
        <div class="box-body" >
            <div class="input-field w3-col l6 m6 s12">
                <i class="material-icons prefix fa fa-calendar"></i>
                <input id="datefrom" type="date" class="vali" name="datefrom" >
                <label for="datefrom">date from</label>
            </div>
            <div class="input-field w3-col l6 m6 s12">
                <i class="material-icons prefix fa fa-calendar"></i>
                <input id="dateto" type="date" class="vali" name="dateto" >
                <label for="dateto">date to</label>
            </div>
        </div>
        <div class="box-footer" >
            <button class="waves-effect waves-light btn w3-blue">search</button> 
        </div>
    </div>
</form>-->
<br>
<br>
@endsection

@section("reportContent") 
<!--Div that will hold the pie chart-->
<div  class="row" >
    <div id="chart_div" class="w3-block" ></div>
</div>
<div class="w3-text-green" >
    <span class="w3-jumbo" >{{ $ordersTotal }}</span><span>$</span>
    <span> اجمالى الطلبات </span>
</div>
<br>
<br>
<div class="row" > 
    <table class="table table-bordered dataTable" id="table" >  
        <thead>
            <tr>
                <th>الكود</th>
                <th>المستخدم</th>
                <th>الاجمالى</th>
                <th>تاريخ الانشاء</th> 
            </tr>
        </thead>
        <tbody> 
            <?php $counter = 1; ?>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->getTotal() }}</td>
                <td>{{ $order->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table> 
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
                                            data.addColumn('string', 'Topping');
                                            data.addColumn('number', 'Slices');
                                            data.addRows([
                                                    @foreach($orders as $order)
                                                    ['{{ $order->created_at }}', {{ $order->getTotal() }}],
                                                    @endforeach
                                            ]);
                                            // Set chart options
                                            var options = {'title': 'orders total',
                                                    'height': 300};
                                            // Instantiate and draw our chart, passing in some options.
                                            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                                            chart.draw(data, options);
                                    }
</script> 
@endsection
