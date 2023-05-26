<?php
//   include 'library.php';
  include 'koneksi.php'; 

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">

//   function getCookies(name) {
//     var value = "; " + document.cookie;
//     var parts = value.split("; " + name + "=");
//     if (parts.length == 2) {
//         return parts.pop().split(";").shift();
//     }
//     }
    
    // console.log(getCookies('log_cookies') === "");

  $(document).ready(function() {
    let countdown = setInterval(function(){
        $("#cekregister").load('login.php')
    }, 0);

    // if(getCookies('log_cookies') !== ""){
    //   console.log('test');
    //   clearInterval(countdown);
    // };
    // $("#ceklogin").load('second.php')  
  });
  
</script>
<!------ Include the above in your HEAD tag ---------->
<center><br><br><br><br>
<!-- Form Name -->
<form  method="POST" action="simpanRegister.php" enctype="multipart/form-data">
<legend>Register User Card</legend>
<div class="cekregister" id="cekregister"></div>
<!-- NAMA LENGKAP -->
<div class="form-group">
  <label class="col-md-4 control-label" for="user">Nama Lengkap</label>  
  <div class="col-md-4">
  <input style="width: 400px; text-align: center;" id="user" name="user" type="text" placeholder="example : Budi Kurniawan" class="form-control input-md" required="">
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="button">
       <input type="submit" name="save" class="btn btn-success btn-sm" value="save" style="width: 100px">
       <!-- <a type="submit" class="btn btn-success btn-sm" style="width: 150px">Simpan</a> -->
       <a href="loginbckup.php" type="submit" class="btn btn-danger btn-sm" style="width: 100px">kembali</a>
   </div>
</div>
</form>
</center>
