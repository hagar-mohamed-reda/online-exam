@extends("dashboard.layout.app")

@section("title")
{{ __('edit grades of exam ') }} {{ $exam->name }}
@endsection   

@section("content")  

<div class="w3-block" style="" >
    <table class="w3-table text-center" style="padding: 7px;border-bottom: 2px dashed gray"  >
        <tr>
            <td><b>{{ __('course') }} : </b>{{ optional($exam->course)->name }}</td>
            <td><b>{{ __('total grade') }} : </b>{{ $exam->total }}</td>
        </tr>  
    </table> 
    <br>
    <table class="table table-bordered" id="table" >
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __("code") }}</th>
                <th>{{ __("student") }}</th>
                <th>{{ __("level") }}</th>
                <th>{{ __("department") }}</th>
                <th>{{ __("exam") }}</th>
                <th>{{ __("exam_total") }}</th>
                <th>{{ __("grade") }}</th>
                <th>{{ __("degreemap") }}</th>
                <th></th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($exam->studentExams()->get() as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ optional($item->student)->code }}</td>
                <td>{{ optional($item->student)->name }}</td>
                <td>{{ optional(optional($item->student)->level)->name }}</td>
                <td>{{ optional(optional($item->student)->department)->name }}</td>
                <td>{{ $exam->name }}</td>
                <td>{{ $exam->total }}</td>
                <td data-sort="{{ $item->grade }}" data-search="{{ $item->grade }}" >
                    <input class="form-control input-sm student_grade" 
                           style="height: 20px" 
                           type="number" 
                           onchange=""
                           data-max="{{ $exam->total }}"
                           data-student-exam="{{ $item->id }}"
                           value="{{ $item->grade }}"  >
                </td>
                <td>{{ optional($item->degree_map)->name }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div  class="w3-center" >
        <button type="button" onclick="showPage('exam')" class="w3-center btn btn-default " >{{ __('back') }}</button>
        
        <button type="button" onclick="recorrectResult()" class="w3-center btn btn-primary exam-form-btn" >{{ __('correct') }}</button>
    </div>
</div>  

@endsection
 

@section("js") 

<script>
    var table = null; 
    
    function recorrectResult() {
        var valid = true;
        var resource = [];
         
        
        $('.student_grade').each(function(){
            if (!this.value)
                valid = false;
            
            if (parseFloat(this.value) > parseFloat($(this).attr('data-max'))) {
                valid = false; 
            } else {
                var item = {};
                item.student_exam_id = $(this).attr('data-student-exam');
                item.grade = this.value;
                resource.push(item);
            }
        });
        
        if (!valid) {
            error('{{ __("grade of exam cant be large than total") }}');
            return;
        }
        
        var url = "{{ url('exam/recorrect') }}";
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
        table = $('#table').DataTable({ 
            "paging": false
         });
     
        $('.floatbtn-place').remove(); 
    });
</script>

@endsection
