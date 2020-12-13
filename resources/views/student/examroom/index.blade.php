@extends("dashboard.layout.app")

@section("title")
{{ __('exams room') }}
@endsection   

@section("content")  

<div class="w3-block" style="" >
    @if ($exam->required_password)
    @if ((request()->password != $exam->password))
    <div  class="w3-center" >
        <label>{{ __('enter_exam_password') }}</label>
        <input type="password" class="form-control input-sm password" >
        <br>
        <button type="button" onclick="checkOnPassword()" class="w3-center btn btn-primary exam-form-btn" >{{ __('submit') }}</button>
    </div>
    @endif
    @endif
    @if (((request()->password == $exam->password) && $exam->required_password) || !$exam->required_password)
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
    </table> 
    <br>
    <div class="text-center" >
        {{ $exam->header_text }}
    </div>
    
    @foreach($exam->getQuestions() as $category) 
    <div class="w3-large" >
        {{ $loop->iteration }}) {{ $category->name }}
    </div>
    <br>
    <div class="w3-block" style="padding: 7px;border-bottom: 2px dashed gray" >
        @foreach($category->questions as $item)
        {!! $item->getView($loop->iteration) !!} 
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
        <button type="button" onclick="performSendExam()" class="w3-center btn btn-primary exam-form-btn" >{{ __('submit') }}</button>
    </div>
    
    @endif
</div>  

@endsection
 

@section("js") 

@if ($exam->required_password)
<script>
    $('.floatbtn-place').remove();
    
    @if (request()->password)
        @if (request()->password != $exam->password) 
            error('{{ __("passwords_not_match") }}');
        @endif
    @endif
    function checkOnPassword() {
        showPage('exam-room?exam_id={{ $exam->id }}&password='+$('.password').val()); 
    }
</script>
@endif

@if (((request()->password == $exam->password) && $exam->required_password) || !$exam->required_password)
<script>
    var totalMinutes = {{ $exam->minutes }};
    var minutes = 0;
    var seconds = 0;
    var interval = null;
    var isStopped = false;
    
    function timer() {
        interval = setInterval(function(){
            if (isStopped)
                return;
            seconds += 1;
            minutes = parseInt(seconds / 60);
            var remindSeconds = seconds % 60;
            
            if (seconds < 60)
                remindSeconds = seconds;
            
            $('#minutesDiv').html(parseInt(minutes) + ":" + remindSeconds);
            
            if (minutes > (totalMinutes / 2))
                $('#minutesDiv').addClass('w3-text-red');
             
                
            
            if (minutes > totalMinutes) {
                isStopped = true;
                clearInterval(interval);
                sendExam();
            }
        }, 1000);
    }
    
    function getResource() {
        var resource = {
            exam_id: '{{ $exam->id }}',
            questions: []
        };
        $('.question-div').each(function(){
            var item = {
                question_id: $(this).find('.question_id').val(),
                answer: $(this).find('.answer_id').val()
            };
            
            resource.questions.push(item);
        }); 
        
        return resource;
    }
    
    function sendExam() { 
        var btn = $('.exam-form-btn')[0];
        var html = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = "<i class='fa fa-spin fa-spinner' ></i>";
        
        var url = "{{ url('exam-room/store') }}";
        var resource = getResource();
        $.post(url, "_token={{ csrf_token() }}&resource="+JSON.stringify(resource), function(r){
            if (r.status == 1) {
                success(r.message);
                showPage('exam-room/end?exam_id='+resource.exam_id);
                clearInterval(interval);
                isStopped = true;
            } else {
                error(r.message);
            }
            
            btn.disabled = false;
            btn.innerHTML =  html;
        });
    }
    
    function performSendExam() {
        swal({
            title: "😧 هل انت متاكد?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function (willDelete) {
            if (willDelete) {
                sendExam();
            } else {
            }
        });
    }
    
    $(document).ready(function () {
        $('.floatbtn-place').remove();
        timer();
    });
</script>
@endif
@endsection
