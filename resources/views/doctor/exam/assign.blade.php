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
                        <div class="w3-col l4 m4 s12 w3-padding" >
                            <input onkeyup="search(this.value, null, null)" type="search" id="searchInput" class="form-control" placeholder="{{ __('search') }}"  >
                        </div>
                        <div class="w3-col l3 m3 s12 w3-padding" > 
                            <select class="form-control" id="level" onchange="search(null, this.value, null)" >
                                @foreach(App\Student::levels() as $item)
                                <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w3-col l3 m3 s12 w3-padding" > 
                            <select class="form-control" id="section" onchange="search(null, null, this.value)" >
                                @foreach(App\Student::sections() as $item)
                                <option value="{{ $item }}" >{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w3-col l2 m2 s12 w3-padding" >  
                            <button class="btn btn-success" type="button" onclick="search(null, null, null)" >{{ __('show all') }}</button>
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

            @foreach(App\Student::all() as $item)
            <tr 
                data-level="{{ $item->level }}"
                data-section="{{ $item->section }}"
                data-search="{{ $item->name }}-{{ $item->phone }}-{{ optional($item->department)->name }}"
                class="student-row"  >
                <td> 
                    {{ $item->name }}
                    <input type="hidden" name="student_id[]" value="{{ $item->id }}"  >
                </td>
                <td> 
                    <div class="material-switch pull-right ">
                        <input 
                            id="studentSwitch{{ $item->id }}" 
                            {{ $item->hasExam($exam->id)? 'checked' : '' }}
                        value="{{$item->hasExam($exam->id)? '1' : '0' }}"
                        name="assign[]"  
                        onchange="this.checked? this.value = 1 : this.value = 0"
                        type="checkbox"/>
                        <label for="studentSwitch{{ $item->id }}" class="label-primary student-label"></label>
                    </div>
                </td>
            </tr>
            @endforeach
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

    function selectAll() {
        $('.student-row').each(function () {
            if ($(this).css("display") != "none") {
                $(this).find(".student-label").click();
            }
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
        }
        else if (level) {
            $(".student-row").hide();
            $(".student-row[data-level=" + level + "]").show();
        }
        else if (section) {
            $(".student-row").hide();
            $(".student-row[data-section=" + section + "]").show();
        }
        else {
            $(".student-row").show();
        } 
    }
    var app = new Vue({
        el: '#questionCreateContainer',
        data: {
        },
        methods: {
        }
    });

    $(document).ready(function () {
        $(".floatbtn-place").remove();
        $(".select2").select2();

        formAjax(true, function (r) {
            showPage('exam');
        });

    });
</script>
@endsection
