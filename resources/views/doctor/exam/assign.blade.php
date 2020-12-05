@extends("dashboard.layout.app")

@section("title")
{{ __('add exam') }}
@endsection 

@section("content")
<style>
    .slide {
        display: none
    }

    .select2 {
        width: 100%!important;
    }

</style>

<div id="questionCreateContainer" > 
    <form method="post" class="form" action="{{ url('/') }}/exam/assign/store/{{ $exam->id }}" id="form" autocomplete="off" >   
        @csrf
        <table class="table table-bordered" >
            <tr>
                <td colspan="2" >
                    <div class="w3-row" > 
                        <div class="w3-col l2 m2 s12 w3-padding" >  
                            <button class="btn btn-success" type="button" onclick="filter()" >{{ __('search') }}</button>
                        </div>
                        <div class="w3-col l3 m3 s12 w3-padding " v-model="search.department_id"  > 
                            <label>{{ __('department') }}</label>
                            <select class="form-control" id="section"   >
                                @foreach(App\Department::all() as $item)
                                <option value="{{ $item->id }}" v-if="search.level_id == '{{ $item->level_id }}'" >{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w3-col l3 m3 s12 w3-padding" > 
                            <label>{{ __('level') }}</label>
                            <select class="form-control" id="level" v-model="search.level_id"   >
                                @foreach(App\Level::all() as $item)
                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </td>
            </tr>
            <tr>
                <th>{{ __('student') }}</th>
                <th></th>
            </tr>
            <tr>
                <th class="text-right" >{{ __('select all') }}</th>
                <th class="text-right" > 
                    <div class="material-switch pull-right w3-margin-top">
                        <input 
                            id="selectAll"    
                            type="checkbox"/>
                        <label for="selectAll" onclick="selectAll()"  class="question-label label-primary"></label>
                    </div>
                </th>
            </tr>


        </table>

        <table class="table table-bordered" id="studentAssignExam" >
            <thead>
                <tr>
                    <th>{{ __('code') }}</th>
                    <th>{{ __('name') }}</th>
                    <th>{{ __('level') }}</th>
                    <th>{{ __('department') }}</th> 
                    <th></th>
                </tr>
            </thead>
            <tbody>  
            </tbody>
        </table>

        <br>
        <br> 

        <center>
            <button class="btn btn-primary" >{{ __('save') }}</button>
            <button class="btn btn-warning" type="button" onclick="showPage('exam')" >{{ __('back') }}</button>
        </center>
    </form>   
</div>

@endsection 

@section("js") 

<script>

    var table = null;

    function selectAll() {
        $('.student-assign-switch').each(function () {
            $(this).find(".student-label").click();
        });
    }

    function search(key, level, section) {
        if (key) {
            $(".student-row").hide();
            $(".student-row").each(function () {
                if ($(this).attr('data-search').toLowerCase().indexOf(key) >= 0) {
                    $(this).show();
                }
            });
        } else if (level) {
            $(".student-row").hide();
            $(".student-row[data-level=" + level + "]").show();
        } else if (section) {
            $(".student-row").hide();
            $(".student-row[data-section=" + section + "]").show();
        } else {
            $(".student-row").show();
        }
    }

    function filter() {
        var url = "{{ url('/student/assign/data') }}?exam_id={{ $exam->id }}&";
        url += $.param(app.search);
        table.ajax.url(url);
        table.ajax.reload();
    }

    var app = new Vue({
        el: '#questionCreateContainer',
        data: {
            search: {}
        },
        methods: {
        }
    });

    $(document).ready(function () {

        table = $('#studentAssignExam').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": "{{ url('/student/assign/data') }}?exam_id={{ $exam->id }}",
            "columns": [
                {"data": "code"},
                {"data": "name"},
                {"data": "level_id"},
                {"data": "department_id"},
                {"data": "action"}
            ]
        });


        $(".floatbtn-place").remove();
        $(".select2").select2();

        formAjax(true, function (r) {
            showPage('exam');
        });

    });
</script>
@endsection
