<div class="w3-block w3-display-container  question-div" style="padding-bottom: 5px" >
    <div class="w3- " > 
        {{ $counter }} )
        {{ $question->text }}
                @if ($question->photo)
                <br>
                <center><img src="{{ $question->photo_url }}" style="width: 60%" ></center>
                @endif
        <input type="hidden" name="question_id[]" class="question_id" value="{{ $question->id }}" >
        <input type="hidden" name="answer_id[]" class="answer_id"  id="questionChoiceNumber{{ $question->id }}" >
    </div> 
    
    <div class="row" >
                @foreach($question->questionChoices()->get() as $item)
                <div class="col-lg-6 col-md-6 col-sm-6" >
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
                </div> 
                @endforeach
    </div>
    
    <br>
</div>