<div class="w3-block w3-display-container  question-div" style="padding-bottom: 5px" >
    <div class="w3- " > 
        {{ $counter }} )
        {{ $question->text }}
        <input type="hidden" name="question_id[]" class="question_id" value="{{ $question->id }}" >
        <input type="hidden" name="answer_id[]" class="answer_id"  id="questionChoiceNumber{{ $question->id }}" >
    </div>
    <br>
    
    <div class="w3-display-topleft" >
        <table class='w3-table' >
            <tr>
                @foreach($question->questionChoices()->get() as $item)
                <td>
                    {{ $item->text }}  
                    <input type="radio" 
                           value="{{ $item->text }}" 
                           name="checked-number-{{ $question->id }}" 
                            @if (isset($showAnswer) && isset($studentExam))
                            {{ $item->isAnswerForStudentExam($studentExam)? 'checked' : '' }}
                            {{ 'disabled' }}
                            @endif 
                           class="w3-check" 
                           onclick="$('#questionChoiceNumber{{ $question->id }}').val(this.value)"  >
                </td> 
                @endforeach
            </tr> 
        </table>
    </div>
</div>