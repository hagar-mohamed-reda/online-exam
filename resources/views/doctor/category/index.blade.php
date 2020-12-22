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
<div class="modal fade"  role="dialog" id="addModal" style="width: 100%!important;height: 100%!important" >
    <div class="modal-dialog modal-" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center class="modal-title w3-xlarge">{{ __('add category') }}</center>
      </div>
      <div class="modal-">
          <form method="post" class="form" action="{{ url('/category/store') }}" id="form">   
              <div class="box-body row">
                  @csrf 
                  <div class="form-group w3-padding col-lg-12 col-md-12 col-sm-12 ">
                        <label for="name">{{ __('name') }}</label>
                        <input type="text" required="" class="form-control " id="name" name="name" placeholder="{{ __('name') }}">
                   </div>
                  <input type="hidden" name="notes" class="name1" >
                  <div class="form-group col-lg-12 col-md-12 col-sm-12"> 
                      <textarea   class="form-control" id="category1" name="category1" placeholder=""></textarea> 
                  </div> 
                  <p class="w3-padding" >{{ __('this will be shown in the paper of student for the title of questions') }}</p>
 
              </div>
              <br>
              <br>
              <div class="box-footer w3-center">
                  <button type="button" class="btn btn-default btn-flat margin" data-dismiss="modal">اغلاق</button>
                  <button type="submit" class="btn btn-primary btn-flat margin" onclick="$('.name1').val(CKEDITOR.instances.category1.getData())">حفظ</button>
              </div>  
          </form> 
      </div> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 


<!-- edit modal --> 
<div class="modal fade" role="dialog" id="editModal" style="width: 100%!important;height: 100%!important" >
    <div class="modal-dialog modal-" role="document" >
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
    CKEDITOR.replace( 'category1' );
    
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
