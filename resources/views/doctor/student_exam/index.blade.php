@extends("dashboard.layout.app")

@section("title")
{{ __('student_exams') }}
@endsection


@section("content")
<div id="filter" >
    <div class="row" >
        <div class="col-lg-3 col-md-3 col-sm-6" >
            <label>{{ __('course') }}</label>
            
            @if (Auth::user()->type == 'doctor')
            <select class="form-control" name="course_id" v-model="search.course_id" >
                <option value="" >{{ __('select al') }}</option>
                @foreach(Auth::user()->toDoctor()->doctorCourses()->get() as $item)
                <option value="{{ $item->course_id }}" >{{ $item->name }}</option>
                @endforeach
            </select>
            @else
            <select class="form-control" name="course_id" v-model="search.course_id" >
                <option value="" >{{ __('select al') }}</option>
                @foreach(App\Course::all() as $item)
                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6" >
            <label>{{ __('level') }}</label>
            <select class="form-control" v-model="search.level_id" >
                <option value="" >{{ __('select al') }}</option>
                @foreach(App\Level::all() as $item)
                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6" >
            <label>{{ __('department') }}</label>
            <select class="form-control"  v-model="search.department_id" >
                <option value="" >{{ __('select al') }}</option>
                @foreach(App\Department::all() as $item)
                <option value="{{ $item->id }}" v-if="search.level_id == '{{ $item->level_id }}'" >{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6" >
            <label>{{ __('exams') }}</label>
            @if (Auth::user()->type == 'admin')
            <select class="form-control select2"  v-model="search.exam_id" >
                <option value="" >{{ __('select al') }}</option>
                @foreach(App\Exam::all() as $item)
                <option value="{{ $item->id }}" >{{ $item->name }} - {{ optional($item->course)->name }}</option>
                @endforeach
            </select>
            @else
            <select class="form-control select2"  v-model="search.exam_id" >
                <option value="" >{{ __('select al') }}</option>
                @foreach(Auth::user()->toDoctor()->exams()->get() as $item)
                <option value="{{ $item->id }}" >{{ $item->name }} - {{ optional($item->course)->name }}</option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6" >
            <label></label> 
            <br>
            <button class="btn btn-primary"  onclick="search()" >{{ __('search') }}</button>
        </div>
    </div>
</div>

<br>
<table class="table table-bordered" id="table" >
    <thead>
        <tr>
            <th>{{ __('student') }}</th> 
            <th>{{ __('code') }}</th> 
            <th>{{ __('level') }}</th> 
            <th>{{ __('department') }}</th> 
            <th>{{ __('exam') }}</th> 
            <th>{{ __('grade') }}</th> 
            <th>{{ __('start_time') }}</th> 
            <th>{{ __('end_time') }}</th> 
            <th></th>
        </tr>
    </thead> 
    <tbody>
        
    </tbody>
</table>

@endsection

@section("additional") 
@endsection

@section("js") 
 
<script> 
    $('.floatbtn-place').remove();
    var table = null;
    
    function search() {
        var url = "{{ url('/student-exam/data') }}?" + $.param(app.search);
        table.ajax.url(url);
        table.ajax.reload();
    }
    
    var app = new Vue({
        el: '#filter',
        data: {
            search: {}
        },
        methods: {
        }
    });
    
    $(document).ready(function() {
        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ url('/student-exam/data') }}",
            "columns":[   
                { "data": "student" },
                { "data": "code" },
                { "data": "level" },
                { "data": "department" },
                { "data": "exam" },
                { "data": "grade" },
                { "data": "start_time" },
                { "data": "end_time" },
                { "data": "action" },
            ]
         });
         
         $('.select2').select2();

         formAjax(); 

    }); 
</script>
@endsection
