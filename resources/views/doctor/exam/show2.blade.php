@extends("dashboard.layout.app")

@section("title")
{{ $exam->name }}
@endsection
@php  
@endphp  

@section("content")   
<table class="table text-rigth text-large" >
    <tr>
        <th>
            <span class="fa fa-level-up" style="padding: 5px" ></span>
            {{ __('difficult_question') }}
        </th>
        <td> 
            <a href="#" onclick="edit('{{ url('/question/show') . '/' . optional($exam->difficulteQuestions())->id }}', 'showModal', 'showModalPlace')" >
                {{ optional($exam->difficulteQuestions())->text }}
            </a>
        </td>
    </tr>
    <tr>
        <th>
            <span class="fa fa-level-down" style="padding: 5px" ></span>
            {{ __('easy_question') }}
        </th>
        <td>
            <a href="#" onclick="edit('{{ url('/question/show') . '/' . optional($exam->easyQuestions())->id }}', 'showModal', 'showModalPlace')" >
                {{ optional($exam->easyQuestions())->text }}
            </a> 
        </td>
    </tr>
    <tr>
        <th>
            <span class="fa fa-arrow-circle-up" style="padding: 5px" ></span>
            {{ __('greatest_grade') }}
        </th>
        <td>
            {{ optional($exam->studentExams()->orderBy('grade', 'DESC')->first())->grade }}
        </td>
    </tr>
    <tr>
        <th>
            <span class="fa fa-arrow-circle-down" style="padding: 5px" ></span>
            {{ __('lower_grade') }}
        </th>
        <td>
            {{ optional($exam->studentExams()->orderBy('grade', 'ASC')->first())->grade }}
        </td>
    </tr>
    <tr>
        <th>
            <span class="fa fa-thumbs-up" style="padding: 5px" ></span>
            {{ __('best_student') }}
        </th>
        <td>
            {{ optional(optional($exam->studentExams()->orderBy('grade', 'DESC')->first())->student)->name }}
        </td>
    </tr>
    <tr>
        <th>
            <span class="fa fa-thumbs-down" style="padding: 5px" ></span>
            {{ __('bad_student') }}
        </th>
        <td>
            {{ optional(optional($exam->studentExams()->orderBy('grade', 'ASC')->first())->student)->name }}
        </td>
    </tr>
</table>
 
<div class="row" >
    <div id="chart" class="col-lg-12" ></div>  
</div>

<br>
<div class="w3-center" >
    @if ($exam->show_result != 1)
    <button class="btn btn-success" onclick="approveExamResult()" >{{ __('show_result') }}</button>
    @endif
    
    <button class="btn btn-danger"  onclick="showPage('exam/edit/{{ $exam->id }}')" >{{ __('edit_exam_questions') }}</button>
</div>
 

@endsection
 
@section("additional")
<!-- add modal --> 
<div class="modal fade" tabindex="-1" role="dialog" id="showModal" style="width: 100%!important;height: 100%!important" >
    <div class="modal-dialog modal-sm" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center class="modal-title w3-xlarge">{{ __('show question') }}</center>
      </div>
      <div class="modal-body showModalPlace"> 
      </div> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
@endsection


@section("js") 
 
<script>  
     
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
        data.addColumn('string', '{{ __("student") }}');
        data.addColumn('number', '{{ __("grade") }}');
        data.addRows([ 
            @foreach($exam->studentExams()->get() as $item) 
            ['{{ optional($item->student)->name }}', {{ $item->grade }}], 
            @endforeach 
        ]);

        // Set chart options
        var options = {'title': "{{ __('grade') }}", 
          is3D: true,
            'height': 400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.AreaChart(document.getElementById('chart'));
        chart.draw(data, options);
    }
    
    
        $(".floatbtn-place").remove();
        
    function approveExamResult() {
        var data = {
            "_token": "{{ csrf_token() }}"
        };
        var url = "{{ url('/exam/approveResult/') }}/{{ $exam->id }}";
        $.post(url, $.param(data), function(r){
            if (r.status == 1)
                success(r.message);
        });
    }
</script>
@endsection
