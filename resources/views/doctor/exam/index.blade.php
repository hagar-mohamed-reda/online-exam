@extends("dashboard.layout.app")

@section("title")
{{ __('exams') }}
@endsection
@php  
@endphp  

@section("content")
<table class="table table-bordered" id="table" >
    <thead>
        <tr> 
            <th>{{ __('name') }}</th>   
            <th>{{ __('header_text') }}</th>   
            <th>{{ __('footer_text') }}</th>   
            <th>{{ __('start_time') }}</th>   
            <th>{{ __('end_time') }}</th>   
            <th>{{ __('course') }}</th>   
            <th>{{ __('minutes') }}</th>   
            <th>{{ __('total') }}</th>   
            <th>{{ __('question_number') }}</th>    
            <th></th>
        </tr>
    </thead> 
    <tbody>
        
    </tbody>
</table>

@endsection

@section("additional")
<!-- add modal --> 
<div class="modal fade" tabindex="-1" role="dialog" id="showModal" style="width: 100%!important;height: 100%!important" >
    <div class="modal-dialog " role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center class="modal-title w3-xlarge">{{ __('show exam') }}</center>
      </div>
      <div class="modal-body showModalPlace"> 
      </div> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

 
@endsection

@section("js")  
<script> 
$(document).ready(function() {
     $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 5,
        "ajax": "{{ url('/exam/data') }}",
        "columns":[ 
            { "data": "name" },   
            { "data": "header_text" },   
            { "data": "footer_text" },   
            { "data": "start_time" },   
            { "data": "end_time" },   
            { "data": "course_id" },   
            { "data": "minutes" },   
            { "data": "total" },   
            { "data": "question_number" },    
            { "data": "action" }
        ]
     });
     
     formAjax(); 
     
     $(".btn-float").click(function(){
         showPage('exam/create');
     });
        
}); 
</script>
@endsection
