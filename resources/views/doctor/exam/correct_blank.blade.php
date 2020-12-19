@extends("dashboard.layout.app")

@section("title")
{{ $exam->name }}
@endsection
@php  

@endphp  

@section("content")    
<div class="w3-block" style="" >
    <table class="w3-table text-center" style="padding: 7px;border-bottom: 2px dashed gray"  >
        <tr>
            <td><b>{{ __('course') }} : </b>{{ optional($exam->course)->name }}</td>
            <td><b>{{ __('total grade') }} : </b>{{ $exam->total }}</td>
        </tr>  
    </table> 
    <br> 

    @foreach($exam->studentExams()->get() as $item)
    <div  style="padding: 7px;border-bottom: 2px dashed gray" class="student_exam" data-id="{{ $item->id }}" >
        <div class="w3-large" >
            {{ $loop->iteration }})  
        </div>
        <br>
        <div class="w3-block"  >
            @foreach($item->getBlankQuestions() as $q)
            {!! $q->getView($loop->iteration, $showAnswer , $item) !!} 
            @endforeach
        </div>
        <br>
    </div>
    @endforeach

    <br>
    <div class="text-center" >
        {{ $exam->footer_text }}
    </div>
    <br>
    <div  class="w3-center" >
        <button type="button" onclick="showPage('exam')" class="w3-center btn btn-default " >{{ __('back') }}</button>

        <button type="button" onclick="correctMultiResult()" class="w3-center btn btn-primary exam-form-btn" >{{ __('correct') }}</button>
    </div>
</div>  
@endsection


@section("js") 

<script>
    function correctMultiResult() {
        var valid = true;
        var resource = {
            "exam_id": '{{ $exam->id }}',
            questions: []
        };

        $('.doctor-blank-question').each(function () {
            if (!this.value)
                valid = false;
 
            if (parseFloat(this.value) > parseFloat($(this).attr('max-grade'))) {
                valid = false;
            }
        });

        $('.student_exam').each(function () {
            var studentExamId = $(this).attr('data-id');
            var self = this;
            $(self).find('.doctor-blank-question').each(function () {
                if (!this.value)
                    valid = false;

                if (this.value > $(this).attr('max-grade')) {
                    valid = false;
                } else {
                    var item = {};
                    item.question_id = $(this).attr('question-id');
                    item.grade = this.value;
                    item.student_exam_id = studentExamId;
                    resource.questions.push(item);
                }
            });
        });


        if (!valid) {
            error('{{ __("grade of question cant be large than total") }}');
            return;
        }

        var url = "{{ url('exam/correct_blank') }}";
        var data = "_token={{ csrf_token() }}&resource=" + JSON.stringify(resource);
        var btn = $('.exam-form-btn')[0];
        var html = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = "<i class='fa fa-spin fa-spinner' ></i>";
        $.post(url, data, function (r) {
            if (r.status == 1) {
                success(r.message);
            } else {
                error(r.message);
            }

            btn.disabled = false;
            btn.innerHTML = html;
        });

        console.log(resource);
    }

    $(document).ready(function () {
        $('.floatbtn-place').remove();
    });
</script>
@endsection
