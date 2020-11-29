 
<style> 
    .report-content {
        padding: 20px;
        margin: auto;
        width: 80%;
    }

    .report-margin, .line {
        margin-left: 2%;
    }

    .report-title {
        color: #367fa9;
        font-family: consolas;
    }

    .consolas {
        font-family: consolas;
    }

    .line {
        border: 1px solid #367fa9;
        width: 90%;
        border-radius: 16px;
    }

    .report-title {
        letter-spacing: 3px; 
        margin-left: 0;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
    }
</style>
<!-- Content Header (Page header) -->
<section class="w3-padding content-header font">
    <h2 class="font" >
        @yield("title")
    </h2>
</section>

<section class="content w3-row" style="direction: rtl" >
    <div>
        @yield("reportOptions")
    </div>

    <div class="w3-display-bottomleft w3-padding" style="padding-bottom: 200px!important" >
        <button class="btn btn-float w3-white" onclick="printJS('report', 'html')">
            <i class="fa fa-print" ></i>
        </button>
    </div>

    <div class="w3-white report-content shadow" style="margin: auto;" id="report" >
        <div class="report-margin w3-border-0 w3-display-container">
            <br>
            <div class="report-title w3-xxlarge text-uppercase" >
                @yield("reportTitle")
            </div>
            <div class="w3-display-topleft w3-padding" >
                <img src="{{ url('image/logo.png') }}" class="w3-circle" height="60px" width="90px" >
                <br>
                <div class="consolas" >YALLO S002</div> 
            </div>
        </div>
        <div class="line" ></div>

        <div class="report-margin  w3-border-0">
            @yield("reportContent")
        </div>
    </div>
</section>
@yield("scripts")

<script> 
    // load float button sound
    $(".btn-float").mouseup(function () {
        playSound("click4");
    });
</script>