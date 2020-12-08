@extends("dashboard.layout.app")

@section("title")
{{ __('my exams') }}
@endsection  

@section("content")
<table class="table table-bordered" id="table" >
    <thead>
        <tr> 
            <th>{{ __('exam') }}</th>   
            <th>{{ __('start_time') }}</th>   
            <th>{{ __('end_time') }}</th>   
            <th>{{ __('course') }}</th>   
            <th>{{ __('minutes') }}</th>   
            <th>{{ __('doctor') }}</th>    
            <th>{{ __('total') }}</th>   
            <th>{{ __('grade') }}</th>   
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
$(document).ready(function() {
     $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 5, 
        "ajax": "{{ url('/student/myexam/data') }}",
        "columns":[ 
            { "data": "exam_name" },    
            { "data": "exam_start_time" },    
            { "data": "exam_end_time" },    
            { "data": "course" },      
            { "data": "minutes" },    
            { "data": "doctor" },     
            { "data": "total" },     
            { "data": "grade" },     
            { "data": "action" }
        ]
     });
     
     formAjax(); 
        $('.floatbtn-place').remove();
        
}); 
</script>
@endsection
