<?php
    include "koneksi.php";
    session_start();
session_destroy();
 
header("Location: loginbckup.php");


?>