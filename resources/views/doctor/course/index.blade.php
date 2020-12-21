@extends("dashboard.layout.app")

<style>
    .form-group {
        height: 80px
    }
    
    label {
        color: black!important;
    }
    
    .form {
        direction: rtl;
    }
</style>
@section("title")
{{ __('courses') }}
@endsection
@php 
    $builder = (new App\Course)->getViewBuilder(); 
@endphp  

@section("content")
<div class="table-responsive" >
<table class="table table-bordered" id="table" >
    <thead>
        <tr>
            @foreach($builder->cols as $col)
            <th>{{ $col['label'] }}</th>  
            @endforeach
            <th>{{ __('students') }}</th>
            <th>{{ __('departments') }}</th>
            <th></th>
        </tr>
    </thead> 
    <tbody>
        
    </tbody>
</table>
</div>

@endsection

@section("additional")
<!-- add modal --> 
<div class="modal fade" tabindex="-1" role="dialog" id="addModal" style="width: 100%!important;height: 100%!important" >
    <div class="modal-dialog modal-sm" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center class="modal-title w3-xlarge">{{ __('add course') }}</center>
      </div>
      <div class="modal-body"> 
        @include('admin.course.add')
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
        <center class="modal-title w3-xlarge">{{ __('edit course') }}</center>
      </div>
      <div class="modal-body editModalPlace">
         
      </div> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  

<!-- assign modal --> 
<div class="modal fade" tabindex="-1" role="dialog" id="assignModal" style="width: 100%!important;height: 100%!important" >
    <div class="modal-dialog modal-" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center class="modal-title w3-xlarge">{{ __('register students') }}</center>
      </div>
      <div class="modal-body assign-modal-place">
          
      </div> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
@endsection

@section("js") 
 
<script> 
    @if (Auth::user()->type != 'admin')
        $('.floatbtn-place').remove();
    @endif
    
    $(document).ready(function() {
         $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "sorting": [0, 'DESC'],
            "ajax": "{{ url('/doctor-course/data') }}",
            "columns":[
                @foreach($builder->cols as $col)
                { "data": "{{ $col['name'] }}" },     
                @endforeach
                { "data": "students" },
                { "data": "departments" },
                { "data": "action" }
            ]
         });

         formAjax(); 

    }); 
</script>
@endsection
