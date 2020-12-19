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
    <form method="post" class="form" action="{{ url('/') }}/exam/store" id="form" autocomplete="off" >   
        @csrf

        <div class="slide slide-1 " style="display: block">
            <table class="table" >
                <tr>
                    <td>{{ __('exam name') }} *</td>
                    <td>
                        <input name="name" required="" class="form-control" placeholder="{{ __('exam name') }}"  >
                    </td>
                </tr>
                <tr>
                    <td>{{ __('start_time') }} *</td>
                    <td>
                        <input name="start_time" type="datetime" required="" class="form-control" id="startDate" data-date-format="yyyy-mm-dd hh:ii:ss" value="{{ date('Y-m-d H:i:s') }}"  >
                    </td>
                </tr>
                <tr>
                    <td>{{ __('end_time') }} *</td>
                    <td>
                        <input name="end_time" type="datetime" required="" class="form-control" id="endDate" data-date-format="yyyy-mm-dd hh:ii:ss"  value="{{ date('Y-m-d H:i:s') }}"  >
                    </td>
                </tr>
                <tr>
                    <td>{{ __('minutes') }} *</td>
                    <td>
                        <input name="minutes" type="number" required="" class="form-control"   >
                    </td>
                </tr>
                <tr>
                    <td>{{ __('exam_total') }} *</td>
                    <td>
                        <input name="total" type="number" readonly="" class="form-control exam_total"   >
                    </td>
                </tr>
                <tr>
                    <td>{{ __('question_number') }} *</td>
                    <td>
                        <input name="question_number" type="number" readonly="" class="form-control exam_questions"   >
                    </td>
                </tr>
                <tr>
                    <td>{{ __('course') }} *</td>
                    <td>
                        <select class="form-control select2  w3-block course-select" required=""  onchange="filterWithCourse();" name="course_id"  >
                            <option   value="" >{{ __('select course') }}</option>
                            @foreach(Auth::user()->doctorCourses()->get() as $item)
                            <option value="{{ optional($item)->course_id }}" >{{ optional($item)->name }}</option>
                            @endforeach
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td>{{ __('header_text') }} </td>
                    <td>
                        <textarea name="header_text"  class="form-control" placeholder="{{ __('header_text') }}"  ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('footer_text') }} </td>
                    <td>
                        <textarea name="footer_text"  class="form-control" placeholder="{{ __('footer_text') }}"  ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('notes') }} </td>
                    <td>
                        <textarea name="notes"  class="form-control" placeholder="{{ __('notes') }}"  ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('required_password') }} </td>
                    <td>  
                        <div class="material-switch pull-right w3-margin-top">
                            <input 
                                id="requiredPassword"  
                                name="required_password"   
                                value="0"
                                onchange="this.checked ? this.value = 1 : this.value = 0" 
                                type="checkbox"/>
                            <label for="requiredPassword" onclick="$('.password-field').toggle()" class="label-primary"></label>
                        </div>
                    </td>
                </tr>
                <tr style="display: none" class="password-field" >
                    <td>{{ __('password') }}</td>
                    <td>
                        <input name="password" type="password"   class="form-control"   >
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
                
                @foreach(App\QuestionType::all() as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ __($item->name) }}
                        <input type="hidden" name="detail_question_type_id[]" value="{{ $item->id }}" >
                    </td>
                    <td>
                        <input type="number" name="detail_number[]" onchange="calculateExamQuestions()" class="form-control input-sm question_number" >
                    </td>
                    <td>
                        <input type="number" name="detail_total[]" onchange="calculateExamTotal()" class="form-control input-sm question_total" >
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
                            <input class="form-control" onkeyup="search(this.value, null, null)" placeholder="{{ __('search about question') }}" >
                        </td>
                        <td>
                            <label>{{ __('categories') }}</label>
                            <select class="form-control select2 w3-block" onchange="search(null, this.value, null)"  >
                                <option value="" >{{ __('select all') }}</option>
                                @foreach(Auth::user()->categories()->get() as $item)
                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                @endforeach
                            </select> 
                        </td>
                        <td>
                            <label>{{ __('question_types') }}</label>
                            <select class="form-control select2 w3-block" onchange="search(null, null, this.value)"  >
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
                                    value="0"
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
    function filterWithCourse() {
        var course = $('.course-select').val();
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
        var total = 0;
        var numbers = 0;
        
        $('.question_total').each(function(){
            total += this.value;
        });
        
        $('.question_number').each(function(){
            numbers += this.value;
        });
        
        if (total <= 0) {
            valid = false;
            error('{{ __("please write the total of grade") }}');
        }
        
        if (numbers <= 0) {
            valid = false;
            error('{{ __("please write the number of questions") }}');
        }
        
        return valid;
    }
    
    function selectAll() {
        $('.question-row').each(function(){
            if ($(this).css("display") != "none") {
                $(this).find(".question-label").click();
            }
        });
    }
    
    function search(key, category, type) {
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
            if (!$('.course-select').val())
                return error('{{ __("select course first") }}');
            
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
            showPage('exam/create');
        });

    });
</script>
@endsection
