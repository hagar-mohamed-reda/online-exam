@extends("dashboard.layout.app")

@section("title")
{{ __('exams room') }}
@endsection  

@section("content")
<table class="table table-bordered" id="table" >
    <thead>
        <tr> 
            <th>{{ __('name') }}</th>   
            <th>{{ __('start_time') }}</th>   
            <th>{{ __('end_time') }}</th>   
            <th>{{ __('course') }}</th>   
            <th>{{ __('question_number') }}</th>   
            <th>{{ __('minutes') }}</th>   
            <th>{{ __('exam_total') }}</th>   
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
        "ajax": "{{ url('/exam-room/data') }}",
        "columns":[ 
            { "data": "name" },    
            { "data": "start_time" },    
            { "data": "end_time" },    
            { "data": "course_id" },   
            { "data": "question_number" },    
            { "data": "minutes" },    
            { "data": "total" },     
            { "data": "action" }
        ]
     });
     
     formAjax(); 
        $('.floatbtn-place').remove();
        
}); 
</script>
@endsection
