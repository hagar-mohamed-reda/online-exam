<!doctype html>
<html lang="ar">
    <head>
        <!-- load css files -->
        {!! view("dashboard.layout.css") !!}

    </head>
    <body class="layout-top-nav {{ App\Setting::find(1)->value }}"  >

        <div id="root" >
            <!-- include topbar html -->
            {!! view("dashboard.layout.topbar") !!}
 

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper  " style="margin-right: 0px!important"  > 
                <div class="container-fluid" >
                    <div class="frame" style="overflow: auto" ></div>
                </div>
            </div>


            <audio id="soundPlayer" ></audio>
        </div>

    </body>

    <!-- load js files -->
    {!! view("dashboard.layout.js") !!} 

    <!-- datatable files -->
    {!! view("dashboard.layout.datatable-plugins") !!} 

    <!-- message scripts -->
    {!! view("dashboard.layout.msg") !!}  
    
     
    <script>
    
        setInterval(function () {
            $.get(public_path + "/notify", function (r) {
                var data = r.data;
                if (data.length <= 0)
                    return;

                playSound("notification");
                app.notifications.reverse();

                for (var i = 0; i < data.length; i++) {
                    app.notifications.push(data[i]); 
                }

                app.notifications.reverse();
                playSound("notification");
                var html =
                        "<table class='w3-text-black' style='direction: ltr!important' >" +
                        "<tr>" +
                        "<td><span class='fa fa-bell w3-large' ></span></td>" +
                        "<td style='padding:7px' class='w3-large'  ><b class='w3-large' >" + TITLE + "</b><br>" +
                        "<p style='max-width: 200px;margin-top: 5px!important' class='w3-tiny' >" + BODY.replace("{n}", data.length) + "</p>" +
                        "</td>" +
                        "</tr>" +
                        "</table>";
                $instance = iziToast.show({
                    class: 'shadow izitoast',
                    timeout: 10000,
                    position: 'bottomLeft', 
                    message: html,
                });


            });
        }, 15000);


    </script> 
</html>
