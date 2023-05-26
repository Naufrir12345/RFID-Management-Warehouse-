<?php
  include 'library.php';
  include 'koneksi.php'; 

  error_reporting(0);
 
  session_start();
?>

<script type="text/javascript">

  function getCookies(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) {
        return parts.pop().split(";").shift();
    }
    }
    
    // console.log(getCookies('log_cookies') === "");

  $(document).ready(function() {
    let countdown = setInterval(function(){
        $("#ceklogin").load('second.php')
    }, 1000);

    // if(getCookies('log_cookies') !== ""){
    //   console.log('test');
    //   clearInterval(countdown);
    // };
    // $("#ceklogin").load('second.php')  
  });
  
</script>

<link rel="stylesheet" href="stylelogin.css">

<div class="wrapper fadeInDown">
  <div id="formContent">
    <div class="ceklogin" id="ceklogin"></div>

    <div id="formFooter">
      <a class="underlineHover" href="regisUser.php">Register User</a>
    </div>

  </div>
</div>