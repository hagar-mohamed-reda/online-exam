 
<style>
    label {
        color: black!important;
    }
</style>
<br>
<br>
<section class="content-header font">
    <h1 class="font" >
        options 
    </h1>
    <ol class="breadcrumb font">
        <li><a href="{{ url('/') }}/dashboard"><i class="fa fa-dashboard"></i>{{ __('dashboard') }}</a></li> 
        <li class="active">{{ __('settings') }}</li>
    </ol>
</section>


<!-- Main content -->
<section class="content w3-margin" style="direction: ltr">   
    
    <!-- theme section -->
    <div class="w3-white round shadow w3-animate-opacity table-responsive row">   
        <div class="form-group w3-padding col-lg-12 col-md-12 col-sm-12">
            <label class="w3-xlarge" for="email">{{ __('theme') }}</label> 
            <div class="w3-large w3-text-gray" >
                {{ __('reload the page to see the changes') }}
            </div>
            <ul class="w3-ul row" >
                
                <li class=" col-lg-2 col-md-2 col-sm-2 w3-padding text-center" style="float: right" >
                    <img src="{{ url('/image/theme/dark-blue.jpg') }}" width="50px" height="50px" class="w3-circle" />
                    <center>
                        <span class="w3-large" >{{ __('blue sky night') }}</span>
                        <br>
                        <input type="radio" name="theme" onclick="editSetting('id=1&value=skin-blue', this)" >
                    </center>
                </li>
               
                <li class=" col-lg-2 col-md-2 col-sm-2 w3-padding text-center" style="float: right" >
                    <img src="{{ url('/image/theme/light-blue.jpg') }}" width="50px" height="50px" class="w3-circle" />
                    <center>
                        <span class="w3-large" >{{ __('light sky') }}</span>
                        <br>
                        <input type="radio" name="theme" onclick="editSetting('id=1&value=skin-blue-light', this)" >
                    </center>
                </li>
                
                <li class=" col-lg-2 col-md-2 col-sm-2 w3-padding text-center" style="float: right" >
                    <img src="{{ url('/image/theme/light-green.jpg') }}" width="50px" height="50px" class="w3-circle" />
                    <center>
                        <span class="w3-large" >{{ __('nature') }}</span>
                        <br>
                        <input type="radio" name="theme" onclick="editSetting('id=1&value=skin-green-light', this)" >
                    </center>
                </li>
                
                <li class=" col-lg-2 col-md-2 col-sm-2 w3-padding text-center" style="float: right" >
                    <img src="{{ url('/image/theme/colors.jpg') }}" width="50px" height="50px" class="w3-circle" />
                    <center>
                        <span class="w3-large" >{{ __('colorfully') }}</span>
                        <br>
                        <input type="radio" name="theme" onclick="editSetting('id=1&value=skin-dark-light', this)" >
                    </center>
                </li>
            </ul>
            <input type="hidden" id="theme" >
        </div> 
    </div> 
    <br>
   
    
    <!-- title section -->
    <div class="w3-white round shadow w3-animate-opacity table-responsive row">
        <div class="form-group w3-padding col-lg-10 col-md-10 col-sm-10">
            <label class="w3-xlarge" for="title">{{ __('open or block change result of exams for doctors') }}</label>
        </div>   
        <div class="form-group w3-padding col-lg-2 col-md-2 col-sm-2">
             <div class="material-switch pull-right w3-margin-top">
              <input id="courseSwitch1" name="assign[]" onchange="editSetting('id=9&value='+(this.checked ? 1 : 0), this)" value="{{ optional(App\Setting::find(3))->value }}" type="checkbox">
              <label for="courseSwitch1" class="label-primary"></label>
             </div> 
<!--            <button class="btn w3-indigo shadow btn-sm" onclick="editSetting('id=9&value='+$('#sheet_period').val(), this)" >
                <i class="fa fa-check" ></i> {{ __('save') }}
            </button>-->
        </div>
    </div> 
    <br>
     
    
    
    <!-- email section -->
    <div class="w3-white round shadow w3-animate-opacity table-  row"> 
        <div class="form-group w3-padding ">
            <label class="w3-xlarge" for="email">{{ __('translation') }}</label>
            <div class="w3-large w3-text-gray" >
               {{ __('you can translate each word in English or Arabic') }}
            </div>
            <table class="table table-bordered" style="direction: rtl" >
                <tr>
                    <th>{{ __('key') }}</th>
                    <th>{{ __('word in English') }}</th>
                    <th>{{ __('word in Arabic') }}</th>
                </tr>
                @foreach(App\Translation::all() as $item)
                <tr class="dictionary-item" data-id="{{ $item->id }}" >
                    <td>
                        {{ $item->key }}
                    </td>
                    <td> 
                        <input  
                            type="text" 
                            class="w3-input w3-block  word_en"   
                            value="{{ $item->word_en }}"
                            style="width: 200px"
                            placeholder="">
                    </td>
                    <td>
                        <input  
                            type="text" 
                            class="w3-input w3-block  word_ar"   
                            value="{{ $item->word_ar }}"
                            style="width: 200px"
                            placeholder="">
                    </td>
                </tr>
                @endforeach
            </table> 
            <br>
            <div class="form-group w3-padding ">
                <button class="btn w3-indigo shadow btn-sm" onclick="editTranslation(this)" >
                    <i class="fa fa-check" ></i> {{ __('save') }}
                </button>
            </div>
        </div>  
    </div> 
    <br>
    
    <!-- /.row -->
</section>

{{ csrf_field() }}

<script>
    function editSetting(values, button) {
        $(button).html('<i class="fa fa-spin fa-spinner" ></i>');
        $.get('{{ url("/option/update?") }}' + values, function (r) {
            if (r.status == 1) {
                success(r.message);
                $(button).html(' <i class="fa fa-check" ></i> {{ __('save') }}');
            } else {
                error(r.message);
                $(button).html(' <i class="fa fa-check" ></i> {{ __('save') }}');
            }
            
            if (values.indexOf("id=1") >= 0 || values.indexOf("id=1") >= 0)
                window.location.reload();
        });
    }
    
    function editTranslation(button) {
        $(button).attr('disabled', 'disabled');
        $(button).html('<i class="fa fa-spin fa-spinner" ></i>');
        
        var translations = [];
        
        $(".dictionary-item").each(function(){
            var item = {};
            item.id = $(this).attr('data-id');
            item.word_en = $(this).find(".word_en").val();
            item.word_ar = $(this).find(".word_ar").val();
            
            translations.push(item);
        }); 
        
        var data = {
            translations: JSON.stringify(translations),
            _token: '{{ csrf_token() }}'
        };
        
        $.post('{{ url("/translation/update?") }}', $.param(data), function(r){
            if (r.status == 1) {
                success(r.message); 
            } else {
                error(r.message); 
            }
            $(button).removeAttr("disabled");
            $(button).html(' <i class="fa fa-check" ></i> {{ __('save') }}');
        });
    }
</script> 
