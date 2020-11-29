@if(isset($_GET["msg"]))
    @if($_GET["status"] == 1)
        <script>
            success('{{ $_GET["msg"] }}'); 
        </script>
    @else
        <script>
            error('{{ $_GET["msg"] }}');
        </script>
    @endif
@endif 