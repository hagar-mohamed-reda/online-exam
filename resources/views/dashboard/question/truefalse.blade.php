<div class="w3-block w3-display-container" >
    <div class="w3-large " > 
        {{ $counter }} )
        {{ $question->text }}
        <input type="hidden" name="question_id[]" value="{{ $question->id }}" >
        <input type="hidden" name="answer_id[]" value="{{ $question->id }}" id="questionChoiceNumber{{ $question->id }}" >
    </div>
    <br>
    
    <div class="w3-display-topleft" >
        <table class='w3-table' >
            <tr>
                @foreach($question->questionChoices()->get() as $item)
                <td>
                    {{ $item->text }}  
                    <input type="radio" 
                           value="{{ $item->id }}" 
                           name="checked-number-{{ $question->id }}" 
                           class="w3-check" 
                           onclick="$('#questionChoiceNumber{{ $question->id }}').val(this.value)"  >
                </td> 
                @endforeach
            </tr> 
        </table>
    </div>
</div>