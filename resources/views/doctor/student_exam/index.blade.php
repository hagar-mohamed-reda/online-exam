@extends("dashboard.layout.app")

@section("title")
{{ __('student_exams') }}
@endsection


@section("content")
<div id="filter" >
    <div class="row" >
        <div class="col-lg-3 col-md-3 col-sm-6" >
            <select class="form-control" >
                
            </select>
        </div>
    </div>
</div>

<table class="table table-bordered" id="table" >
    <thead>
        <tr>
            <th>{{ __('student') }}</th> 
            <th>{{ __('code') }}</th> 
            <th>{{ __('level') }}</th> 
            <th>{{ __('department') }}</th> 
            <th>{{ __('exam') }}</th> 
            <th>{{ __('grade') }}</th> 
            <th>{{ __('start_time') }}</th> 
            <th>{{ __('end_time') }}</th> 
            <th></th>
        </tr>
    </thead> 
    <tbody>
        
    </tbody>
</table>

@endsection

@section("additional") 
@endsection

@section("js") 
 
<script> 
    
    var app = new Vue({
        el: '#filter',
        data: {
            search: {}
        },
        methods: {
        }
    });
    
$(document).ready(function() {
     $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 5,
        "ajax": "{{ url('/student-exam/data') }}",
        "columns":[   
            { "data": "student" },
            { "data": "code" },
            { "data": "level" },
            { "data": "department" },
            { "data": "exam" },
            { "data": "grade" },
            { "data": "start_time" },
            { "data": "end_time" },
            { "data": "action" },
        ]
     });
     
     formAjax(); 
        
}); 
</script>
@endsection
