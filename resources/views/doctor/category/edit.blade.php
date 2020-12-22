<form method="post" class="form" action="{{ url('/category/update') }}/{{ $category->id }}" id="form">   
    <div class="box-body row">
        @csrf 
        <div class="form-group w3-padding col-lg-12 col-md-12 col-sm-12 ">
            <label for="name">{{ __('name') }}</label>
            <input type="text" required="" class="form-control" id="name" name="name" value="{{ $category->name }}" placeholder="{{ __('name') }}">
        </div>
        <input type="hidden" name="notes" class="name" >
        <div class="form-group col-lg-12 col-md-12 col-sm-12"> 
            <textarea   class="form-control " id="category2" name="category2" placeholder="">{{ $category->notes }}</textarea> 
        </div>  
                  <p class="w3-padding" >{{ __('this will be shown in the paper of student for the title of questions') }}</p>
    </div>
    <br>
    <br>
    <div class="box-footer w3-center">
        <button type="button" class="btn btn-default btn-flat margin" data-dismiss="modal">اغلاق</button>
        <button type="submit" class="btn btn-primary btn-flat margin" onclick="$(this.form).find('.name').val(CKEDITOR.instances['category2'].getData())">حفظ</button>
    </div>  
</form> 
<script>

    CKEDITOR.replace( 'category2' );
</script>