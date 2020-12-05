<div class="material-switch pull-right student-assign-switch">
    <input 
        id="studentSwitch{{ $student->id }}" 
        {{ $student->hasExam($exam->id)? 'checked' : '' }}
    value="{{$student->hasExam($exam->id)? '1' : '0' }}"
    name="assign[]"  
    onchange="this.checked? this.value = 1 : this.value = 0"
    type="checkbox"/>
    <label for="studentSwitch{{ $student->id }}" class="label-primary student-label"></label>
</div>
<input type="hidden" name="student_id[]" value="{{ $student->id }}"  >
