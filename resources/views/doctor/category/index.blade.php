@extends("dashboard.layout.app")

@section("title")
{{ __('categories') }}
@endsection
@php 
    $builder = (new App\Category)->getViewBuilder(); 
@endphp  

@section("content")
<table class="table table-bordered" id="table" >
    <thead>
        <tr>
            @foreach($builder->cols as $col)
            <th>{{ $col['label'] }}</th>  
            @endforeach
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
<div class="modal fade" tabindex="-1" role="dialog" id="addModal" style="width: 100%!important;height: 100%!important" >
    <div class="modal-dialog modal-sm" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center class="modal-title w3-xlarge">{{ __('add category') }}</center>
      </div>
      <div class="modal-body">
        {!! $builder->loadAddView() !!} 
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
        <center class="modal-title w3-xlarge">{{ __('edit category') }}</center>
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
        "pageLength": 5,
        "ajax": "{{ url('/category/data') }}",
        "columns":[
            @foreach($builder->cols as $col)
            { "data": "{{ $col['name'] }}" },     
            @endforeach
            @if (Auth::user()->type == 'admin')
            { "data": "doctor_id" },
            @endif
            { "data": "action" },
        ]
     });
     
     formAjax(); 
        
            @if (Auth::user()->type == 'admin')
		$('.floatbtn-place').remove();
	    @endif
}); 
</script>
@endsection
