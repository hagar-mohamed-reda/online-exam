<div style="width: 200px" >
    <i class="fa fa-edit w3-text-orange w3-button" onclick="edit('{{ url('/course/edit') . '/' . $course->id }}')" ></i>
    <i class="fa fa-address-book-o w3-text-pink w3-button" onclick="edit('{{ url('/course/assign') . '/' . $course->id }}', 'assignModal', 'assign-modal-place')" > {{ __('assign_course_to_doctors') }} </i>
    <i class="fa fa-trash w3-text-red w3-button" onclick="remove('', '{{ url('/course/remove/') .'/' . $course->id }}')" ></i>
</div>