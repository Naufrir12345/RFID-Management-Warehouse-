<?php
include "koneksi.php";
$sql = mysqli_query($conn, "SELECT * from rfid_data");
$data = mysqli_fetch_array($sql);
$uid = isset($data['uid']) ? $data['uid']:"";
?>

<link rel="stylesheet" href="stylelogin.css">
<div class="form-group">
    <br>
    <input type="text" name="uid" id="uid" placeholder
    ="Scan kartu RFID" class="form-control" style="width: 200px" value="<?php
    echo $uid; ?>" readonly>
</div>

<?php
    session_start();

    $sql = "SELECT * FROM user WHERE uid='$uid'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row['nama_user'];
        mysqli_query($conn, "DELETE from rfid_data");
    }
?>

<script>
    function setCookies(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookies(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) {
        return parts.pop().split(";").shift();
    }
    }

    setCookies('log_cookies',document.getElementById('uid').value,new Date());

    if(getCookies('log_cookies')){
        window.location.href = 'http://localhost/rfid/rekapitulasidata.php';
    };
</script>