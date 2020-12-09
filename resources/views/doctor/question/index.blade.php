@extends("dashboard.layout.app")

@section("title")
{{ __('questions') }}
@endsection
@php  
@endphp  

@section("content")
<div>
    @if (Auth::user()->type == 'doctor')
    <button class="btn btn-primary" onclick="showPage('question/create2')" >{{ __('add multi questions') }}</button>
    @endif
</div>
<br>

<table class="table table-bordered" id="table" >
    <thead>
        <tr> 
            <th>{{ __('text') }}</th>   
            <th>{{ __('course') }}</th>   
            <th>{{ __('type') }}</th>   
            <th>{{ __('active') }}</th>   
            <th>{{ __('category') }}</th>   
            <th>{{ __('is_sharied') }}</th>
            <th>{{ __('photo') }}</th>
    @if (Auth::user()->type == 'admin')    
            <th>{{ __('doctor') }}</th> 
            @endif
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


<!-- edit modal --> 
<div class="modal fade" tabindex="-1" role="dialog" id="editModal" style="width: 100%!important;height: 100%!important" >
    <div class="modal-dialog modal-sm" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center class="modal-title w3-xlarge">{{ __('edit question') }}</center>
      </div>
      <div class="modal-body editModalPlace">
         
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
        "pageLength": 10,
        "ajax": "{{ url('/question/data') }}",
        "columns":[ 
            { "data": "text" },   
            { "data": "course_id" },   
            { "data": "question_type_id" },   
            { "data": "active" },   
            { "data": "category_id" },   
            { "data": "is_sharied" },   
            { "data": "photo" },   
    @if (Auth::user()->type == 'admin') 
            { "data": "doctor_id" },  
            @endif
            { "data": "action" }
        ]
     });
     
     formAjax(); 
     
     $(".btn-float").click(function(){
         showPage('question/create');
     });
        
}); 
</script>
@endsection
