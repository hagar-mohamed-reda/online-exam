<div style="width: 200px" >
    
    @if (Auth::user()->type == 'doctor') 
    <i class="fa fa-edit w3-text-orange w3-button" onclick="showPage('question/edit/{{ $question->id }}')"  ></i>
    @endif 
    
    <i class="fa fa-desktop w3-text-green w3-button" onclick="edit('{{ url('/question/show') . '/' . $question->id }}', 'showModal', 'showModalPlace')" >{{ __('show') }}</i>
    
    
    @if (Auth::user()->type == 'doctor') 
    @if ($question->can_delete)
    <i class="fa fa-trash w3-text-red w3-button" onclick="remove('', '{{ url('/question/remove/') .'/' . $question->id }}')" ></i>
    @endif
    @endif
</div>