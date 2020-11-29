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
    @include("dashboard.question.truefalse", ["question" => App\Question::find(3), "counter" => 1])  
    
    @include("dashboard.question.multichoice", ["question" => App\Question::find(7), "counter" => 2])  
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>

@endsection 

@section("js") 

<script>
 
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
             
        });

    });
</script>
@endsection
