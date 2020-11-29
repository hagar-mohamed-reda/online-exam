
<!-- jQuery 3 -->
<script src="{{ url('/') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('/') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="{{ url('/') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script src="{{ url('/') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{ url('/') }}/bower_components/fastclick/lib/fastclick.js"></script>
<script src="{{ url('/') }}/bower_components/select2/dist/js/select2.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/') }}/dist/js/demo.js"></script> 
<!-- nicescroll -->
<script src="{{ url('/') }}/js/jquery.nicescroll.min.js"></script>

<!-- chat js -->
<script src="{{ url('/') }}/js/Chart.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- Material Design -->
<script src="{{ url('/') }}/dist/js/material.min.js"></script>
<script src="{{ url('/') }}/dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<!-- time picker -->
<script src="{{ url('/') }}/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- datatable plugins-->
{!! view("dashboard.layout.datatable-plugins"); !!}

<!-- print library --> 
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

<!-- my scripts -->
<script src="{{ url('/') }}/js/iziToast.min.js"></script>
<script src="{{ url('/') }}/js/sweetalert.min.js"></script> 
<script src="{{ url('/') }}/js/formajax.js"></script> 
<script src="{{ url('/') }}/js/vue.js"></script> 
<script src="{{ url('/') }}/js/app.js"></script> 

<script> 
    showPage('dashboard/main');
    
    // load float button sound
    $(".btn-float, .sidebar-menu li").mouseup(function(){
        playSound("click4");
    });
</script>