@extends("dashboard.layout.app")

@section("title")
{{ __('edit question') }}
@endsection 

@section("content")
<style>
    .slide {
        display: none
    }
</style>
<div id="questionCreateContainer" > 
    <form method="post" class="form" action="{{ url('/') }}/question/update/{{ $question->id }}" id="form" enctype="multipart/form-data" >   
        @csrf

        <div class="slide slide-1" style="display: block" >
            <ul class="w3-ul" >
                <input type="hidden" name="question_type_id" class="question_type_id" value="{{ $question->question_type_id }}"  >
                @foreach(App\QuestionType::all() as $item)
                <li class="doctor-list-item" style="padding: 0px" >
                    <div class="media  w3-block w3-padding w3-display-container" style="border-radius: 2px;" >
                        <div class="media-left">
                            <a href="#" style="padding: 5px" >
                                <button 
                                    type="button" 
                                    class="btn w3-circle {{ $item->icon }} {{ App\helper\Helper::randColor() }}" 
                                    style="width: 40px;height: 40px" ></button>
                            </a>
                        </div> 
                        <div class="media-body">
                            <div class="media-heading font w3-large">{{ __($item->name) }}</div>
                            <div class="w3-text-gray" >{{ __($item->name . '_notes') }}</div>
                            
                            <div class="w3-display-topleft w3-padding" > 
                                <div class="material-switch pull-right w3-margin-top">
                                    <input 
                                        id="questionType_{{ $item->id }}"  
                                        name="type"  
                                        value="{{ $item->id }}"
                                        {{ $question->question_type_id == $item->id? 'checked' : '' }}
                                        onchange="$('.question_type_id').val(this.value)"
                                        type="radio"/>
                                    <label 
                                        for="questionType_{{ $item->id }}" 
                                        onclick="{{ $item->id==2 || $item->id == 5? 'showMultiChoiceDialog()' : 'null' }}" 
                                        class="label-primary"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach 
            </ul>

            <center>
                <button onclick="showSlide(2)" type="button" class="btn btn-success btn-flat margin" >{{ __('next') }}</button> 
            </center>

        </div>  

        <div class="slide slide-2 row">
            <table class="table" >
                <tr>
                    <td>{{ __('text') }} *</td>
                    <td>
                        <textarea name="text" required="" class="form-control" placeholder="{{ __('text') }}"  >{{ $question->text }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('image') }} *</td>
                    <td>
                        <input type="file" name="photo" class="form-control" onchange="loadImage(this, event)" >
                        @if ($question->photo)
                        <img src="{{ $question->photo_url }}" width="40px" >
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ __('course') }} *</td>
                    <td>
                        <select class="form-control select2 w3-block" name="course_id" >
                            @foreach(Auth::user()->doctorCourses()->get() as $item)
                            <option 
                                {{ $question->course_id == $item->course_id? 'selected' : '' }}
                                value="{{ optional($item)->course_id }}" >{{ optional($item)->name }}</option>
                            @endforeach
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td>{{ __('category') }} *</td>
                    <td>
                        <select class="form-control select2 w3-block" name="category_id" >
                            @foreach(Auth::user()->categories()->get() as $item)
                            <option 
                                {{ $question->category_id == $item->id? 'selected' : '' }}
                                value="{{ optional($item)->id }}" >{{ optional($item)->name }}</option>
                            @endforeach
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td>{{ __('active') }} </td>
                    <td>  
                        <div class="material-switch pull-right w3-margin-top">
                            <input 
                                id="questionActive"  
                                name="active"   
                                onchange="this.checked ? this.value = 1 : this.value = 0"
                                value="{{ $question->active }}"
                                {{ $question->active? 'checked' : '' }}
                                type="checkbox"/>
                            <label for="questionActive" class="label-primary"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>{{ __('is_share_notes') }} </td>
                    <td>  
                        <div class="material-switch pull-right w3-margin-top">
                            <input 
                                id="questionSharied"  
                                name="is_sharied"   
                                value="{{ $question->is_sharied }}"
                                {{ $question->is_sharied? 'checked' : '' }}
                                onchange="this.checked ? this.value = 1 : this.value = 0"
                                type="checkbox"/>
                            <label for="questionSharied" class="label-primary"></label>
                        </div>
                    </td>
                </tr>
            </table>


            <div>
                <table class="table table-bordered" >
                    <tr class="text-right" >
                        <th class="text-right" >{{ __('text') }}</th>
                        <th class="text-right" > 
                            {{ __('is answer') }}
                        </th>
                    </tr> 

                    @if ($question->question_type_id == 1)
                    @foreach($question->questionChoices()->get() as $item)
                    <tr class="text-right" v-if="type == 1" >
                        <td>
                            <input type="text" readonly="" name="choice[]" value="{{ __($item->text) }}" class="choice form-control" >
                        </td>
                        <td> 
                            <div class="material-switch pull-right w3-margin-top">
                                <input 
                                    id="choice_{{ $item->id }}_true"  
                                    name="is_answer[]"  
                                    {{ $item->is_answer? 'checked': '' }} 
                                    value="{{ $item->is_answer }}"
                                    onchange="this.checked? this.value = 1 : this.value = 0"
                                    type="radio" />
                                <label for="choice_{{ $item->id }}_true" class="label-primary"></label>
                            </div> 
                        </td>
                    </tr>
                    @endforeach
                    @endif
                     
                    
                    @if ($question->question_type_id == 3)
                    @foreach($question->questionChoices()->get() as $item)
                    <tr class="text-right" v-if="type == 3" >
                        <td>
                            <input type="text" name="choice[]" value="{{ $item->text }}"  class="choice form-control" >
                        </td>
                        <td> 
                            <div class="material-switch pull-right w3-margin-top">
                                <input 
                                    id="choice_1_short_answer"  
                                    name="is_answer[]"   
                                    checked=""
                                    value="1"
                                    type="radio"/>
                                <label for="choice_1_short_answer" class="label-primary"></label>
                            </div> 
                        </td>
                    </tr>
                    @endforeach
                    @endif
                     
                    
                    @if ($question->question_type_id == 2 || $question->question_type_id == 5)
                    @foreach($question->questionChoices()->get() as $item)
                    <tr class="text-right" v-if="type == 2 || type == 5"  >
                        <td>
                            <input type="text"  name="choice[]" value="{{ $item->text }}"  class="choice form-control" >
                        </td>
                        <td> 
                            <div class="material-switch pull-right w3-margin-top">
                                <input 
                                    name="is_answer[]"
                                    class="mulit_choice_answers"
                                    id="choice_item_{{ $item->id }}"  
                                    {{ $item->is_answer? 'checked': '' }} 
                                    value="{{ $item->is_answer }}"
                                    onchange="setAnswer(this)"
                                    type="radio" />
                                <label for="choice_item_{{ $item->id }}" class="label-primary"></label>
                            </div> 
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    
                </table>
            </div>


            <br>
            <center> 
                <button type="submit" class="btn btn-primary btn-flat margin" >{{ __('save question') }}</button>  
            </center>
        </div>
        <br>
        <br> 
    </form>   
</div>

@endsection
@section("additional")
<!-- add modal --> 
<div class="modal fade" tabindex="-1" role="dialog" id="multiChoiceModal" style="width: 100%!important;height: 100%!important" >
    <div class="modal-dialog modal-sm" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <center class="modal-title w3-xlarge">{{ __('add question') }}</center>
      </div>
      <div class="modal-body">
        <div class="form-group w3-padding col-lg-12 col-md-12 col-sm-12">
            <label for="multiChoiceNumbers">{{ __('number of choices') }}</label>
            <input required="" 
                   type="number" 
                   class="form-control " id="multiChoiceNumbers"   placeholder="{{ __('number of choices') }}">
        </div> 
            <center>  
                <button onclick="setMultiChoiceNumber()" type="button" class="btn btn-success btn-flat margin" data-dismiss="modal" >{{ __('ok') }}</button>
            </center>
      </div> 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

 
@endsection

@section("js") 

<script>
    var slide1Valid = true;
    var multiChoiceNumber = {{ $question->questionChoices()->count() }};
     
        
    function setAnswer(input) {
        if (input.checked) {
            $('.mulit_choice_answers').val(0);
            input.value = 1; 
        } else {
            input.value = 0;
        }
    }
    
    function setMultiChoiceNumber() { 
        app.multiChoiceNumber = [];
        for(var i = 0; i < multiChoiceNumber; i ++) {
            app.multiChoiceNumber.push(i + 1);
        }
        showSlide(2);
    }
    
    function showMultiChoiceDialog() {
        $("#multiChoiceModal").modal('show');
    }
    
    function showSlide(slide) {
        if (slide == 2) {
            if (!checkOnType()) 
                return;
        }
        
        $(".slide").hide();
        $(".slide-" + slide).show();
    }
    
    function validateSlide2() {
        if (!checkOnType()) { 
            return false;
        }
    }

    function checkOnType() {
        var type = $(".form")[0].type.value;
        app.type = type;
        slide1Valid = true; 
        
        if (!type) {
            error("{{ __('choice question type') }}");
            slide1Valid = false;
        }
        
        if (type == 2 && !multiChoiceNumber) {  
            showMultiChoiceDialog();
            error("{{ __('enter number of choices') }}");
            slide1Valid = false;
        }
        
        return slide1Valid;
    }

    var app = new Vue({
        el: '#questionCreateContainer',
        data: {
            counter: 1,
            type: null,
            multiChoiceNumber: null
        },
        methods: {
            getId: function () {
                return "id-" + this.counter++;
            }
        }
    });

    $(document).ready(function () {
        $(".floatbtn-place").remove();
        $(".select2").select2();

        formAjax(false, function(r){
            showPage('question');
        });
        
        
        @if ($question->question_type_id == 2 || $question->question_type_id == 5)
            setMultiChoiceNumber();
        @endif
        showSlide(2);

    });
</script>
@endsection
