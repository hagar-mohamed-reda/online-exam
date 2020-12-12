@extends("dashboard.layout.app")

@section("title")
{{ __('exams') }}
@endsection
@php  
@endphp  

@section("content")
<div id="filter" >
    <div class="row" >
        <div class="col-lg-3 col-md-3 col-sm-6" >
            <label>{{ __('course') }}</label>
            
            @if (Auth::user()->type == 'doctor')
            <select class="form-control" name="course_id" v-model="search.course_id" >
                <option value="" >{{ __('select al') }}</option>
                @foreach(Auth::user()->toDoctor()->doctorCourses()->get() as $item)
                <option value="{{ $item->course_id }}" >{{ $item->name }}</option>
                @endforeach
            </select>
            @else
            <select class="form-control" name="course_id" v-model="search.course_id" >
                <option value="" >{{ __('select al') }}</option>
                @foreach(App\Course::all() as $item)
                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                @endforeach
            </select>
            @endif
        </div> 
        <div class="col-lg-3 col-md-3 col-sm-6" >
            <label></label> 
            <br>
            <button class="btn btn-primary"  onclick="search()" >{{ __('search') }}</button>
        </div>
    </div>
</div>
<br>
<br>
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
    var table = null;
    
    function search() {
        var url = "{{ url('/exam/data') }}?" + $.param(app.search);
        table.ajax.url(url);
        table.ajax.reload();
    }
    
    var app = new Vue({
        el: '#filter',
        data: {
            search: {}
        },
        methods: {
        }
    });
    
$(document).ready(function() {
     table = $('#table').DataTable({
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
            @if (Auth::user()->type == 'admin')
            { "data": "doctor_id" },   
	    @endif 
            { "data": "action" }
        ]
     });
     
     formAjax(); 
     
     $(".btn-float").click(function(){
         showPage('exam/create');
     });
        
            @if (Auth::user()->type == 'admin')
		$('.floatbtn-place').remove();
	    @endif
}); 
</script>
@endsection
