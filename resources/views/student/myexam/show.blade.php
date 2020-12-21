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
            <td><b>{{ __('doctor') }} : </b>{{ optional($exam->doctor)->name }}</td>
            <td><b>{{ __('time') }} : </b> 
                <span class="w3-large" >
                    <span class="w3-text-green" id="minutesDiv" >0</span> / <b>{{ $exam->minutes }}</b> 
                </span>
            </td>
        </tr>
        <tr>
            <td><b>{{ __('exam') }} : </b>{{ $exam->name }}</td>
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
        <button type="button" onclick="showPage('student/myexam')" class="w3-center btn btn-default exam-form-btn" >{{ __('back') }}</button>
    </div>
</div>  

@endsection
 

@section("js") 

<script>
     
    $(document).ready(function () {
        $('.floatbtn-place').remove(); 
    });
</script>

@endsection
