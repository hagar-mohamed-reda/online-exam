 
<div class="w3-block w3-display-container  text-right  question-div" >
    <div class="row text-right" style="padding-bottom: 5px" >
        <div class="col-lg-6 col-md-6 col-sm-12 text-right" style="text-align: right!important"  >
            <div class="w3- " > 
                {{ $counter }} )
                {{ $question->text }}
                @if ($question->photo)
                <br>
                <center><img src="{{ $question->photo_url }}" style="width: 100%" ></center>
                <br>
                @endif
                <input type="hidden" name="question_id[]" class="question_id" value="{{ $question->id }}" >
                <input type="hidden" name="answer_id[]" class=""  id="questionChoiceNumber{{ $question->id }}" >
            </div> 
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-12 text-right w3-display-container" style="text-align: right!important" > 
            
                @if ($question->photo)
                <br>
                @endif
                <textarea    
                       name="checked-number-{{ $question->id }}" 
                       class="form-control answer_id" 
                       @if (isset($showAnswer) && isset($studentExam))  
                       {{ 'readonly' }}
                       @endif 
                       rows="4"
                       onkeyup="$('#questionChoiceNumber{{ $question->id }}').val(this.value)"  >@if (isset($showAnswer) && isset($studentExam)) {{ $question->getStudentAnswer($studentExam)  }} @endif</textarea> 
        
        @if (Auth::user()->type == 'doctor')
        @if (isset($studentExam))
        @php
            $studentQuestion = $studentExam->studentAnswers()->where('question_id', $question->id)->first(); 
            $grade = $studentQuestion->getQuestionOfExamGrade();
        @endphp
        <div class="w3-display-topleft w3-padding shadow w3-white w3-round" style="left: 10px" >
            <input type="number" 
                   step="width: 100px"
                   style="border: 2px dashed gray"
                   question-id="{{$question->id }}"
                   value="{{ optional($studentQuestion)->grade }}"
                   class="doctor-blank-question w3-round"
                   max-grade="{{ $grade }}"
                   max="{{ $grade }}" >
            / {{ $grade }}
        </div>
        @endif 
        @endif 
        </div> 
    </div>
</div>