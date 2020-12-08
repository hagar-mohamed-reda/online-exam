@extends("dashboard.layout.app")

@section("title")
{{ __('exams room') }}
@endsection   

@section("content")  
<div class="w3-block" style="" >
    <table class="table table-bordered" >
        <tr>
            <th>{{ __('code') }}</th>
            <td>{{ optional(optional($exam)->student)->code  }}</td>
        </tr>
        <tr>
            <th>{{ __('name') }}</th>
            <td>{{ optional(optional($exam)->student)->name  }}</td>
        </tr>
        <tr>
            <th>{{ __('level') }}</th>
            <td>{{ optional(optional(optional($exam)->student)->level)->name }}</td>
        </tr>
        <tr>
            <th>{{ __('department') }}</th>
            <td>{{ optional(optional(optional($exam)->student)->department)->name }}</td>
        </tr>
        <tr>
            <th>{{ __('exam name') }}</th>
            <td>{{ optional($exam->exam)->name }}</td>
        </tr> 
        <tr>
            <th>{{ __('course') }}</th>
            <td>{{ optional(optional($exam->exam)->course)->name }}</td>
        </tr>
        <tr>
            <th>{{ __('doctor') }}</th>
            <td>{{ optional(optional($exam->exam)->doctor)->name }}</td>
        </tr>
        <tr>
            <th>{{ __('start_time') }}</th>
            <td>{{ $exam->start_time }}</td>
        </tr>
        <tr>
            <th>{{ __('end_time') }}</th>
            <td>{{ $exam->end_time }}</td>
        </tr>
        <tr>
            <th>{{ __('grade') }}</th>
            <td>
                @if ($exam->grade >= (optional($exam->exam))->total / 2)
                <span class="w3-text-green" >{{ $exam->grade }}</span>
                @else
                <span class="w3-text-red" >{{ $exam->grade }}</span>
                @endif 
                / <b>{{ optional($exam->exam)->total }}</b></td>
        </tr>
    </table>
    <br>
    <div  class="w3-center" >
        <button type="button" onclick="showPage('student/exam')" class="w3-center btn btn-default exam-form-btn" >{{ __('back') }}</button>
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
