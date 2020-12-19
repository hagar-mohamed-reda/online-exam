@extends("dashboard.layout.app")

@section("title")
{{ __('exams room') }}
@endsection   

@section("content")  

<div class="w3-block" style="" >
    <table class="w3-table text-center" style="padding: 7px;border-bottom: 2px dashed gray"  >
        <tr>
            <td><b>{{ __('course') }} : </b>{{ optional($exam->course)->name }}</td>
            <td><b>{{ __('total grade') }} : </b>{{ $exam->total }}</td>
        </tr> 
        <tr>
            <td><b>{{ __('student') }} : </b>{{ optional($studentExam->student)->name }}</td>
            <td></td>
        </tr> 
    </table> 
    <br>
    <div class="text-center" >
        {{ $exam->header_text }}
    </div>
    
    @foreach($studentExam->getQuestions() as $category) 
    <div class="w3-large" >
        {{ $loop->iteration }}) {{ $category->name }}
    </div>
    <br>
    <div class="w3-block" style="padding: 7px;border-bottom: 2px dashed gray" >
        @foreach($category->questions as $item)
        {!! $item->getView($loop->iteration, $showAnswer , $studentExam) !!} 
        @endforeach
    </div>
    <br>
    @endforeach
    <br>
    <div class="text-center" >
        {{ $exam->footer_text }}
    </div>
    <br>
    <div  class="w3-center" >
        <button type="button" onclick="showPage('student-exam')" class="w3-center btn btn-default " >{{ __('back') }}</button>
        
        <button type="button" onclick="correctResult()" class="w3-center btn btn-primary exam-form-btn" >{{ __('correct') }}</button>
    </div>
</div>  

@endsection
 

@section("js") 

<script>
    function correctResult() {
        var valid = true;
        var resource = {
            "student_exam_id": '{{ $studentExam->id }}',
            questions: []
        };
        
        $('.doctor-blank-question').each(function(){
            if (!this.value)
                valid = false;
            
            if (this.value > $(this).attr('max-grade')) {
                valid = false; 
            } else {
                var item = {};
                item.question_id = $(this).attr('question-id');
                item.grade = this.value;
                resource.questions.push(item);
            }
        });
        
        if (!valid) {
            error('{{ __("grade of question cant be large than total") }}');
            return;
        }
        
        var url = "{{ url('student-exam/correct') }}";
        var data = "_token={{ csrf_token() }}&resource="+JSON.stringify(resource);
        var btn = $('.exam-form-btn')[0];
        var html = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = "<i class='fa fa-spin fa-spinner' ></i>";
        $.post(url, data, function(r){
            if (r.status == 1) {
                success(r.message);
            } else {
                error(r.message);
            }
            
            btn.disabled = false;
            btn.innerHTML =  html;
        });
        
        console.log(resource);
    }
     
    $(document).ready(function () {
        $('.floatbtn-place').remove(); 
    });
</script>

@endsection
