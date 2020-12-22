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
    <form method="post" class="form" action="{{ url('/') }}/exam/update/{{ $exam->id }}" id="form" autocomplete="off" >   
        @csrf

        <div class="slide slide-1 " style="display: block">
            <table class="table" >
                <tr>
                    <td>{{ __('exam name') }} *</td>
                    <td>
                        <input name="name" required="" class="form-control" value="{{ $exam->name }}" placeholder="{{ __('exam name') }}"  >
                    </td>
                </tr>
                <tr>
                    <td>{{ __('start_time') }} *</td>
                    <td>
                        <input name="start_time" type="datetime" required="" class="form-control" id="startDate" data-date-format="yyyy-mm-dd hh:ii:ss" value="{{ $exam->start_time }}"  >
                    </td>
                </tr>
                <tr>
                    <td>{{ __('end_time') }} *</td>
                    <td>
                        <input name="end_time" type="datetime" required="" class="form-control" id="endDate" data-date-format="yyyy-mm-dd hh:ii:ss"  value="{{ $exam->end_time }}"  >
                    </td>
                </tr>
                <tr>
                    <td>{{ __('minutes') }} *</td>
                    <td>
                        <input name="minutes" type="number" required="" class="form-control" value="{{ $exam->minutes }}"   >
                    </td>
                </tr>
                <tr>
                    <td>{{ __('exam_total') }} *</td>
                    <td>
                        <input name="total" type="number" readonly="" class="form-control exam_total"   value="{{ $exam->total }}"   >
                    </td>
                </tr>
                <tr>
                    <td>{{ __('question_number') }} *</td>
                    <td>
                        <input name="question_number" type="number" readonly="" class="form-control exam_questions" value="{{ $exam->question_number }}"   >
                    </td>
                </tr> 
                <tr>
                    <td>{{ __('header_text') }} </td>
                    <td>
                        <textarea name="header_text"  class="form-control" value="{{ $exam->header_text }}" placeholder="{{ __('header_text') }}"  ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('footer_text') }} </td>
                    <td>
                        <textarea name="footer_text"  class="form-control" value="{{ $exam->footer_text }}" placeholder="{{ __('footer_text') }}"  ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('notes') }} </td>
                    <td>
                        <textarea name="notes"  class="form-control" placeholder="{{ __('notes') }}"  >{{ $exam->notes }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('required_password') }} </td>
                    <td>  
                        <div class="material-switch pull-right w3-margin-top">
                            <input 
                                id="requiredPassword"  
                                name="required_password"   
                                value="{{ $exam->required_password }}"
                                {{ $exam->required_password? 'checked' : '' }}
                                onchange="this.checked? this.value = 1 : this.value = 0" 
                                type="checkbox"/>
                            <label for="requiredPassword" onclick="$('.password-field').toggle()" class="label-primary"></label>
                        </div>
                    </td>
                </tr>
                <tr style="display: none" class="password-field" >
                    <td>{{ __('password') }}</td>
                    <td>
                        <input name="password" type="password" value="{{ $exam->password }}"  class="form-control"   >
                    </td>
                </tr> 
                <tr   >
                    <td>{{ __('question_types') }}</td>
                    <td> 
                    </td>
                </tr> 
            </table>  
            <table class="table table-bordered" >
                <tr>
                    <td>#</td>
                    <td>{{ __('name') }}</td>
                    <td>{{ __('question_number') }}</td>
                    <td>{{ __('question_total') }}</td>
                </tr>
                
                @foreach(Auth::user()->toDoctor()->hardLevels()->get() as $item)
                <tr class="question_type_row" >
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ __($item->name) }}
                        <input type="hidden" name="detail_question_type_id[]" value="{{ $item->id }}" >
                    </td>
                    <td>
                        <input type="number" name="detail_number[]" 
                               value="{{ optional($exam->details()->where('question_type_id', $item->id)->first())->number }}"
                               onchange="calculateExamQuestions()" 
                               class="form-control input-sm question_number" >
                    </td>
                    <td>
                        <input type="number" name="detail_total[]" 
                               onchange="calculateExamTotal()" 
                               value="{{ optional($exam->details()->where('question_type_id', $item->id)->first())->grade }}"
                               class="form-control input-sm question_total" >
                    </td>
                </tr>
                @endforeach
            </table>




            <br>
            <center>
                <button onclick="showSlide(2)" type="button" class="btn btn-success btn-flat margin" >{{ __('next') }}</button> 
            </center>
        </div>
        <div class="slide slide-2" > 

            <div>
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <label>{{ __('search about question') }}</label>
                            <input class="form-control" onkeyup="search(this.value, null, null, null)" placeholder="{{ __('search about question') }}" >
                        </td>
                        <td>
                            <label>{{ __('categories') }}</label>
                            <select class="form-control select2 w3-block" onchange="search(null, this.value, null, null)"  >
                                <option value="" >{{ __('select all') }}</option>
                                @foreach(Auth::user()->categories()->get() as $item)
                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                @endforeach
                            </select> 
                        </td>
                        <td>
                            <label>{{ __('hardlevels') }}</label>
                            <select class="form-control select2 w3-block" onchange="search(null, null, null, this.value)"  >
                                <option value="" >{{ __('select all') }}</option>
                                @foreach(Auth::user()->toDoctor()->hardLevels()->get() as $item)
                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                @endforeach
                            </select> 
                        </td>
                        <td>
                            <label>{{ __('question_types') }}</label>
                            <select class="form-control select2 w3-block" onchange="search(null, null, this.value, null)"  >
                                <option value="" >{{ __('select all') }}</option>
                                @foreach(App\QuestionType::all() as $item)
                                <option value="{{ $item->id }}" >{{ __($item->name) }}</option>
                                @endforeach
                            </select> 
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered" >
                    <tr class="text-right" >
                        <th class="text-right" >{{ __('question') }}</th> 
                        <th class="text-right" > 
                            {{ __('is selected') }}
                        </th>
                    </tr> 
                    <tr class="text-right" >
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

                    @foreach(Auth::user()->questions()->get() as $item)
                    <tr 
                        
                        data-search="{{ $item->text }}-{{ optional($item->category)->name }}"
                        data-category="{{ $item->category_id }}" 
                        data-hardlevel="{{ $item->hard_level_id }}" 
                        data-course="{{ $item->course_id }}" 
                        data-type="{{ $item->question_type_id }}"
                        style="display: none"
                        class="question-tr">
                        <td>
                            {{ $item->text }}
                            <input type="hidden" name="question_id[]" value="{{ $item->id }}" >
                        </td> 
                        <td>
                            <div class="material-switch pull-right w3-margin-top">
                                <input 
                                    id="questionNumber{{$item->id}}"  
                                    name="is_selected[]"   
                                    value="{{ $exam->hasQuestion($item->id) }}"
                                    {{ $exam->hasQuestion($item->id)? 'checked' : '' }}
                                    onchange="this.checked ? this.value = 1 : this.value = 0" 
                                    type="checkbox"/>
                                <label for="questionNumber{{$item->id}}"  class="question-label label-primary"></label>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </table>
            </div>

            <center> 
                <button type="submit" class="btn btn-primary btn-flat margin" >{{ __('save exam') }}</button> 
                <button onclick="showSlide(1)" type="button" class="btn btn-success btn-flat margin" >{{ __('previous') }}</button>
            </center>
        </div>  

        <br>
        <br> 
    </form>   
</div>

@endsection 

@section("js") 

<script>
    var course = {{ $exam->course_id }};
    function filterWithCourse() {
        var course = {{ $exam->course_id }};
        $(".question-tr").hide();
        $(".question-tr").removeClass('question-row');
        $(".question-tr[data-course=" + course + "]").each(function(){
            $(this).addClass('question-row').show();
        });
    }
    
    function calculateExamTotal() {
        var total = 0;
        
        $('.question_total').each(function(){
            if (this.value)
            total += parseFloat(this.value);
        });
        
        $('.exam_total').val(total);
    }
    
    function calculateExamQuestions() {
        var numbers = 0;
        
        $('.question_number').each(function(){
            if (this.value)
            numbers += parseInt(this.value);
        });
        
        $('.exam_questions').val(numbers);
    }
    
    function validOnQuestionTypes() {
        var valid = true;
        
        $('.question_type_row').each(function(){
            var number = $(this).find('.question_number').val();
            var total = $(this).find('.question_total').val();
            
            if ( ((number > 0) && (total <= 0))) {
                error('{{ __("please write the total of questions") }}');
                valid = false;
            }
            
            if (((number <= 0) && (total > 0)) ) {
                error('{{ __("please write the number of questions") }}');
                valid = false;
            }
        });
          
        
        return valid;
    }
    
    
    function selectAll() {
        $('.question-row').each(function(){
            if ($(this).css("display") != "none") {
                $(this).find(".question-label").click();
            }
        });
    }
    
    function search(key, category, type, hardlevel) {
        if (key) {
            $(".question-row").hide();
            $(".question-row").each(function () {
                if ($(this).attr('data-search').indexOf(key) >= 0) {
                    $(this).show();
                }
            });
        }
        else if (category) {
            $(".question-row").hide();
            $(".question-row[data-category=" + category + "]").show();
        }
        else if (hardlevel) {
            $(".question-row").hide();
            $(".question-row[data-hardlevel=" + hardlevel + "]").show();
        }
        else if (type) {
            $(".question-row").hide();
            $(".question-row[data-type=" + type + "]").show();
        }
        else {
            $(".question-row").show();
        }
        
        
        //filterWithCourse();
    }

    function showSlide(slide) {  
        if (slide == 2) { 
            if (!validOnQuestionTypes())
                return;
        }
        $(".slide").hide();
        $(".slide-" + slide).show();
    }
    
    var app = new Vue({
        el: '#questionCreateContainer',
        data: {
            course_id: null,
            counter: 1,
            type: null,
            multiChoiceNumber: null
        },
        methods: {
        }
    });

    $(document).ready(function () {
        $(".floatbtn-place").remove();
        $(".select2").select2();
        $('#startDate').datetimepicker();
        $('#endDate').datetimepicker();

        formAjax(false, function (r) {
            if (r.status == 1)
            showPage('exam');
        });

        filterWithCourse();
    });
</script>
@endsection
