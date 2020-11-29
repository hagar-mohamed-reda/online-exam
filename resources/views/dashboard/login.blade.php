<!doctype html>
<html lang="">
    <head>
        <!-- load css files -->
        {!! view("dashboard.layout.css") !!}

        <style>
            body {
                background-image: url('{{ url("/image/chatback.jpg")  }}')!important; 
                background-size: auto;!important;
            }
            
        </style>
    </head>
    <body class="hold-transition login-page w3-light-gray" style="overflow: hidden">

        <div id="root" > 

            <!-- Content Wrapper. Contains page content --> 
            <div class="login-box w3-animate-top " >
                <div class="login-logo">
                    <a href="#"><b> MOBILE </a>
                </div>
                <!-- /.login-logo -->
                <div class="login-box-body w3-card">
                    <p class="login-box-msg">{{ __('login to your dashboard control') }}</p>

                    <form action="{{ url('/') }}/sign" method="post">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                            <input type="text" name="username" class="form-control" placeholder="{{ __('username') }}">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" name="password" class="form-control" placeholder="{{ __('password') }}">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <br>
                        <div class=""> 
                            <!-- /.col -->
                            <div class="form-group">
                                <button type="submit" class="btn w3-blue btn-block btn-flat">{{ __('login') }}</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form> 

                </div>
                <!-- /.login-box-body -->
            </div>

        </div>

        <!-- load js files -->
        {!! view("dashboard.layout.js") !!}  
        
        <!-- message scripts -->
        {!! view("dashboard.layout.msg") !!}  
    </body>
</html>


