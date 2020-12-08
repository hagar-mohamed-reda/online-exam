 
<div class="w3-block w3-display-container  text-right  question-div" >
    <div class="row text-right" style="padding-bottom: 5px" >
        <div class="col-lg-6 col-md-6 col-sm-12 text-right" style="text-align: right!important"  >
            <div class="w3- " > 
                {{ $counter }} )
                {{ $question->text }}
                <input type="hidden" name="question_id[]" class="question_id" value="{{ $question->id }}" >
                <input type="hidden" name="answer_id[]" class="answer_id"  id="questionChoiceNumber{{ $question->id }}" >
            </div> 
        </div>
        @foreach($question->questionChoices()->get() as $item)
        <div class="col-lg-6 col-md-6 col-sm-12 text-right" style="text-align: right!important" >
            <td class="text-right" style="width: 50%" > 
                <input type="text"   
                       name="checked-number-{{ $question->id }}"  
                       @if (isset($showAnswer) && isset($studentExam)) 
                       value="{{ $item->isAnswerForStudentExam($studentExam)? $question->getStudentAnswer($studentExam) : '' }}"
                       {{ 'readonly' }}
                       @endif 
                       class="form-control input-sm" 
                       onkeyup="$('#questionChoiceNumber{{ $question->id }}').val(this.value)"  >
        </div>
        @endforeach 
    </div>
</div>