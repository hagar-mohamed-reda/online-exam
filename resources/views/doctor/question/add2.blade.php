@extends("dashboard.layout.app")

@section("title")
{{ __('add question') }}
@endsection 

@section("content")
<style>
    .slide {
        display: none
    }
</style>
<div id="questionCreateContainer" > 
    <form method="post" class="form" action="{{ url('/') }}/question/store2" id="form">   
        @csrf

        <br>
        <table class="table table-bordered" >
            <tr>
                <th>#</th>
                <th>{{ __('text') }}</th>
                <th>{{ __('is_share_notes') }}</th>
                <th>{{ __('choice') }} <span></span></th>
            </tr>
            <tr v-for="item in questions index as i" >
                <td v-html="i + 1" ></td>
                <td>
                    <input type="text"  name="choice[]"  class="choice form-control" >
                </td>
                <td> 
                    <div class="material-switch pull-right w3-margin-top">
                        <input 
                            v-bind:id="'choice_' + item"  
                            name="is_answer[]" 
                            class="mulit_choice_answers"
                            value="0"
                            onchange="setAnswer(this)"
                            type="radio"/>
                        <label v-bind:for="'choice_' + item" class="label-primary"></label>
                    </div> 
                </td>
                <td></td> 
            </tr>

        </table>

        <div class="slide slide-1" style="display: block" > 

            <center>
                <button onclick="showSlide(2)" type="button" class="btn btn-success btn-flat margin" >{{ __('next') }}</button> 
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
            multiChoiceNumber: null,
            questions: []
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

        formAjax(false, function (r) {
            showPage('question/create');
        });

    });
</script>
@endsection
