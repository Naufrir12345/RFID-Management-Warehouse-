<script language='javascript'>
var request = 0;
var request1 = 0;
// $(document).ready(function () {
//     $("#hi button").click(function () {

//         var id = this.id;
//         if(request!=0){
//             clearInterval(request);
//             request1.abort();
//         }
//         request = setInterval(do_it,1000,id);           
//     });
// });
$(document).ready(function () {
    //$("#hi button").click(function () {

       var uid = this.uid;
        if(request!=0){
            clearInterval(request);
            request1.abort();
        }
        request = setInterval(do_it,1000);           
    //});
});

function do_it() {
        request1 = $.ajax({ 
        url: "loginbckup.php?uid=" + uid,
        success: function (result) {
            $("#result").html(result);
            }
        });
}
</script>

<!-- <div class="hi" id="hi">
    <button id="1" ></button>
    <button id="2" ></button>
    </div> -->

<div id="result"></div>

<?php
$word='';
include('koneksi.php');
if($_GET['id'] == '1') {
    $main = '1';

    for($i = 0; $i < 30; $i++) {
        $word .= $main . "<br>";
    }
    echo $word;
}

if($_GET['id'] == '2') {
    $a = 0; 

    while($a != 1) {
        sleep(5);
        $a=1;
    }               
    echo "2";
}
?>