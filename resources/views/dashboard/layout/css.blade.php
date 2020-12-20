
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">


<!-- website title -->
<title>{{ optional(DB::table("settings")->find(5))->value }}</title>

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ url('/') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">

<!-- Material Design
<link rel="stylesheet" href="{{ url('/') }}/css/materialize.min.css">
--> 

<!-- Material Design 
<link rel="stylesheet" href="{{ url('/') }}/dist/css/bootstrap-material-design.min.css">
<link rel="stylesheet" href="{{ url('/') }}/dist/css/ripples.min.css">
-->

<link rel="stylesheet" href="{{ url('/') }}/dist/css/MaterialAdminLTE.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ url('/') }}/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ url('/') }}/bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="{{ url('/') }}/bower_components/select2/dist/css/select2.min.css">
<!-- Theme style -->
@if (Lang::getLang() == 'Ar') 
<link rel="stylesheet" href="{{ url('/') }}/dist/css/AdminLTE_ar.css">
@else
<link rel="stylesheet" href="{{ url('/') }}/dist/css/AdminLTE.css">
@endif
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. --> 
<link rel="stylesheet" href="{{ url('/') }}/dist/css/skins/_all-skins.min.css"> 
<!-- DataTables -->
<link rel="stylesheet" href="{{ url('/') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{ url('/') }}/plugins/timepicker/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="{{ url('/') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<!-- my style -->
<link rel="stylesheet" href="{{ url('/') }}/css/w3.css">
<link rel="stylesheet" href="{{ url('/') }}/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="{{ url('/') }}/css/bootstrap-switch.css">
<link rel="stylesheet" href="{{ url('/') }}/css/switch.css">
<link rel="stylesheet" href="{{ url('/') }}/css/iziToast.css">
<link rel="stylesheet" href="{{ url('/') }}/css/app.css">
<link rel="shortcut icon" href="{{ url('/') }}/image/logo.png" type="image/png">
 
<!-- print library -->  
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">  

<!-- google font -->
<link href="https://fonts.googleapis.com/css?family=Text+Me+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

<!-- jQuery 3 -->
<script src="{{ url('/') }}/js/jquery-3.2.1.min.js"></script>



<!-- commen style -->
<style>
    *, .font, h1, h2, h3, h4, h5, h6 {
        font-family: 'Cairo', sans-serif;
        /*font-family: 'Text Me One', sans-serif*/ 
    } 
    
    .rtl {
        direction: rtl;
    }
    
    body, html {
        direction: ltr;
    }
    
    .shadow-1 {
        box-shadow: 0 1px 2px 0 rgba(0,0,0,0.14), 0 1px 1px -1px rgba(0,0,0,0.12), 0 1px 2px 0 rgba(0,0,0,0.2)!important;
    }
 

    @if (App\Setting::find(1)->value == 'skin-dark-light')
    .treeview a {
        color: inherit!important;
    }
    .main-sidebar {
        background-color: white;
    }
    @endif

    .treeview-menu {
        padding-right: 35px!important;
    }
    
    select {
        padding: 0px!important;
        padding-left: 10px!important;
        padding-right: 10px!important;
    }
    
    .select2 {
        width: 100%!important;
    }
    
    .select2:hover {
        width: 100%!important;
    }
    .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9 {
        float: right!important;
        text-align: right;
    }
    
    .material-switch {
        text-align: left;
        direction: ltr;
    }
    
    .table, tr, th, td {
       text-align: right;
    }
    
    .pull-right {
        float: right!important;
    }
    
    .pull-left {
        float: left!important;
    }
    
    .w3-ul li {
        text-align: right!important
    }
</style>
<style> 

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
</style>

<!-- commen script -->
<script>
    var public_path = '{{ url("/") }}';
    var TITLE = '{{ optional(DB::table("settings")->find(5))->value }}';
</script>

<script>
    // url of the public path
    var url = '{{ url("/") }}';
    // max uploaded file size
    var MAX_UPLOADED_FILE = 5; // 5 MB

    // max uploaded image size
    var MAX_UPLOADED_IMAGE = 3; // 3 MB

    var TITLE = "{{ __('new notfications') }}";
    var BODY = "{{ __('you have {n} notifications') }}";
</script>