<div style="width: 200px" >
     
    <i class="fa fa-edit w3-text-orange w3-button" onclick="showPage('question/edit/{{ $question->id }}')"  ></i>
    <i class="fa fa-desktop w3-text-green w3-button" onclick="edit('{{ url('/question/show') . '/' . $question->id }}', 'showModal', 'showModalPlace')" ></i>
    <i class="fa fa-trash w3-text-red w3-button" onclick="remove('', '{{ url('/question/remove/') .'/' . $question->id }}')" ></i>
   
</div>