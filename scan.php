<!DOCTYPE html>
<html>
<head>
    <?php include "header.php"?>
    <title>Scan Kartu</title>

    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $("#cekkartu").load('bacakartu.php')
            }, 1000);
        });
    </script>
<body>
    <?php include "menu.php"?>

    <div class="container-fluid">
        <div id="cekkartu"></div>
    </div>
    <br>
    
</body>
</head>
</html>