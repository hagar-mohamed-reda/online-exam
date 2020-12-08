<div style="width: 120px" >
     
    @if (Auth::user()->type == 'doctor')
    <i class="fa fa-edit w3-text-orange w3-button" onclick="edit('{{ url('/category/edit') . '/' . $category->id }}')" ></i>
 
    @if ($category->can_delete)
    <i class="fa fa-trash w3-text-red w3-button" onclick="remove('', '{{ url('/category/remove/') .'/' . $category->id }}')" ></i>
    @endif
    
    @endif
   
</div>