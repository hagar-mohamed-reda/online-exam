<div style="width: 250px" >
    
    <i class="fa fa-address-book-o w3-text-teal w3-button" onclick="showPage('exam/assign/{{ $exam->id }}')"  > {{ __('assign to students') }} </i>
    
    @if ($exam->hasBlankAnswer())
    <i class="fa fa-refresh w3-text-teal w3-button" onclick="showPage('exam/correct_blank/{{ $exam->id }}')"  > {{ __('correct blank answer') }} </i>
    @endif
    
    
    <i class="fa fa-desktop w3-text-green w3-button" onclick="edit('{{ url('/exam/show') . '/' . $exam->id }}', 'showModal', 'showModalPlace')" > {{ __('show') }} </i>
    
     @if (Auth::user()->type == 'doctor')
    <i class="fa fa-area-chart w3-text-purple w3-button" onclick="showPage('exam/show2/{{ $exam->id }}')"  > {{ __('show analysis') }} </i>
    <i class="fa fa-edit w3-text-orange w3-button" onclick="showPage('exam/edit/{{ $exam->id }}')"  ></i>
    
    @if ($exam->can_delete)
    <i class="fa fa-trash w3-text-red w3-button" onclick="remove('', '{{ url('/exam/remove/') .'/' . $exam->id }}')" ></i>
    @endif
    @endif
    
</div>