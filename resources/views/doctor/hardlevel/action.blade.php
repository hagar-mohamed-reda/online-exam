<div style="width: 120px" >
     
    @if (Auth::user()->type == 'doctor')
    <i class="fa fa-edit w3-text-orange w3-button" onclick="edit('{{ url('/hardlevel/edit') . '/' . $hardlevel->id }}')" ></i>
 
    @if ($hardlevel->can_delete)
    <i class="fa fa-trash w3-text-red w3-button" onclick="remove('', '{{ url('/hardlevel/remove/') .'/' . $hardlevel->id }}')" ></i>
    @endif
    
    @endif
   
</div>