@extends("dashboard.layout.app")

@section("title")
{{ __('add question') }}
@endsection 

@section("content")
<style>
    .slide {
        display: none
    }
    
    .question-table, .question-table tr, .question-table td, .question-table th {
         padding: 0px!important;
    }
</style>
<div id="questionCreateContainer" > 
    <form method="post" id="questionForm" action="{{ url('/') }}/question/store2"  id="form">   
        @csrf
        <div class="row" >
            <div class="col-lg-4 col-md-4" >
                <select class="form-control type_id"  name="type_id" onchange="checkOnType()" v-model="resource.type_id" >
                    <option>-- {{ __('select type') }} --</option>
                    @foreach(App\QuestionType::all() as $item)
                    <option value="{{ $item->id }}" >{{ __($item->name) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 col-md-4" >
                <select class="form-control category_id"  name="category_id"  v-model="resource.category_id" >
                    <option>-- {{ __('select type') }} --</option>
                    @foreach(Auth::user()->toDoctor()->categories()->get() as $item)
                    <option value="{{ $item->id }}" >{{ __($item->name) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 col-md-4" >
                <select class="form-control select2 w3-block course_id" name="course_id" onclick="app.resource.course_id=this.value" >
                    @foreach(Auth::user()->toDoctor()->doctorCourses()->get() as $item)
                    <option value="{{ optional($item)->course_id }}" >{{ optional($item)->name }}</option>
                    @endforeach
                </select> 
            </div>
        </div>

        <br>
        <table class="table table-bordered question-table" >
            <tr>
                <th>#</th>
                <th>{{ __('text') }}</th> 
                <th  v-if="type == 1" ></th>
                <th  v-if="type == 1" ></th>
                <th v-for="(item, index) in multiChoiceNumber"  v-if="type == 2"  >
                    {{ __('choices') }}
                </th>
            </tr>
            <tr v-for="(item, index) in questions" class="question-row" >
                <td v-html="index + 1" ></td>
                <td>
                    <input type="text"  name="text[]" required=""  class="question-text form-control" >
                </td> 
                <td  v-if="type == 3" class="w3-display-container" >
                    <input type="text"  v-model="item.text"   name="choice[][]" required=""  class="question-choice form-control" >
                    <div class="material-switch w3-display-topleft w3-padding">
                        <input 
                            v-bind:id="'choice_' + index"  
                            name="is_answer[][]"  
                            checked=""
                            class="mulit_choice_answers question-answer"
                            value="1"  required=""
                            type="checkbox"/>
                        <label v-bind:for="'choice_' + index" class="label-primary"></label>
                    </div> 
                </td>
                <td  v-if="type == 1" class="w3-display-container" >
                    <input type="text" readonly=""  required=""   name="choice[][]" value="{{ __('true') }}"  class="question-choice form-control" >
                    <div class="material-switch w3-display-topleft w3-padding">
                        <input 
                            v-bind:id="'1choice_' + index"  
                            name="is_answer[][]" 
                            checked=""
                            class="mulit_choice_answers question-answer"
                            value="1"
                            onchange="selectTrueFalse(this)" 
                            type="checkbox"/>
                        <label v-bind:for="'1choice_' + index" class="label-primary"></label>
                    </div> 
                </td>
                <td  v-if="type == 1" class="w3-display-container" >
                    <input type="text" readonly=""   name="choice[][]" required="" value="{{ __('false') }}"  class="question-choice form-control" >
                    <div class="material-switch w3-display-topleft w3-padding">
                        <input 
                            v-bind:id="'2choice_' + index"  
                            name="is_answer[][]" 
                            class="mulit_choice_answers question-answer"
                            value="0"   
                            onchange="selectTrueFalse(this)"
                            type="checkbox"/>
                        <label v-bind:for="'2choice_' + index" class="label-primary"></label>
                    </div> 
                </td>
                <td  v-for="(row, index2) in multiChoiceNumber" v-if="type == 2"  class="w3-display-container"   >
                    <input type="text"  name="choice[][]" required=""  class="question-choice form-control" >
                    <div class="material-switch w3-display-topleft w3-padding">
                        <input 
                            v-bind:id="'choice_' + index + '-' +  index2"  
                            name="is_answer[][]" 
                            class="mulit_choice_answers question-answer"
                            value="0"   
                            onchange="selectTrueFalse(this)"
                            type="checkbox"/>
                        <label v-bind:for="'choice_' + index + '-' +  index2" class="label-primary"></label>
                    </div> 
                </td>
                <td>
                    <button class="fa fa-trash btn btn-danger" @click="removeItem(index)" ></button>
                </td> 
            </tr>

        </table>
        <button @click="addItem()" class="btn btn-default fa fa-plus" ></button>

        <div  > 

            <center>
                <button  type="submit" class="btn btn-success btn-flat question-form-btn" >{{ __('save') }}</button> 
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
    var multiChoiceNumber = null;

    function setAnswer(input) {
        if (input.checked) {
            $('.mulit_choice_answers').val(0);
            input.value = 1;
        } else {
            input.value = 0;
        }
    }

    function setMultiChoiceNumber() {
        multiChoiceNumber = $("#multiChoiceNumbers").val();
        app.multiChoiceNumber = [];
        for (var i = 0; i < multiChoiceNumber; i++) {
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
    
    function selectTrueFalse(input) {
        if (input.checked) {
            console.log($(input).parent().parent().parent());
            $(input).parent().parent().parent().find('.mulit_choice_answers').each(function(){
                this.checked = false;
                this.value = 0;
            });
            input.checked = true;
            input.value = 1;
        } else 
            input.value = 0;
    }

    function checkOnType() {
        var type = $('.type_id').val();
        app.type = type;
        slide1Valid = true;

        if (!type) {
            error("{{ __('choice question type') }}");
            slide1Valid = false;
        }

        if (type == 2 && !multiChoiceNumber) {
            showMultiChoiceDialog();
            //error("{{ __('enter number of choices') }}");
            slide1Valid = false;
        }
        
        
        
        return slide1Valid;
    }
    
    function getObject() {
        var resource = {};
        var questions = [];
        $('.question-row').each(function(){ 
            var item = {};
            item.text = $(this).find('.question-text').val();
            item.choices = [];
            item.answers = [];
            $(this).find('.question-choice').each(function(){
                item.choices.push(this.value);
            });
            $(this).find('.question-answer').each(function(){
                item.answers.push(this.value);
            });
            
            questions.push(item);
            
        });
        
        resource.course_id = $('.course_id').val();
        resource.category_id = $('.category_id').val();
        resource.type_id = app.resource.type_id;
        resource.questions = questions;
        resource._token = "{{ csrf_token() }}";
        
        return resource;
    }
    
    function saveQuestions() {
        var btn = $('.question-form-btn')[0];
        var html = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = "<i class='fa fa-spin fa-spinner' ></i>";
        
        var resource = getObject(); 
        console.log(resource);
        var action = "{{ url('/') }}/question/store2";
        $.post(action, "data="+JSON.stringify(resource)+"&_token={{ csrf_token() }}", function(r){
            
            if (r.status == 1) {
                success(r.message);
                showPage('question');
            } else {
                error(r.message);
            }
             
            btn.disabled = false;
            btn.innerHTML =  html;
        });
        
        return false;
    }
    


    var app = new Vue({
        el: '#questionCreateContainer',
        data: {
            resource: {},
            counter: 1,
            type: null,
            multiChoiceNumber: null,
            questions: []
        },
        methods: {
            getId: function () {
                return "id-" + this.counter++;
            },
            addItem() {
                this.questions.push({});
            },
            removeItem(index) {
                this.questions.splice(index, index+1)
            }
        }
    });

    $(document).ready(function () {
        $(".floatbtn-place").remove();
        $(".select2").select2();

        $('#questionForm')[0].onsubmit = function(e){
            e.preventDefault();
            return saveQuestions();
        };

    });
</script>
@endsection
