<?php
include "koneksi.php";

$qty = $_POST['qty_out'];
$desc = $_POST['desc_out'];
$uid = $_POST['uid'];
$device = $_POST['device'];
$status = $_POST['status'];
$mode = 0;

$data_regis = mysqli_query($conn, "SELECT qty, id_lokasi FROM registrasi WHERE uid='$uid'");
$dataregis = mysqli_fetch_array($data_regis);

$data_user = mysqli_query($conn, "SELECT id_user FROM user WHERE uid='$uid'");
$datauser = mysqli_fetch_array($data_user);

if ($status === 'input'){
    $total_input = $dataregis[0] + $qty;
    if($total_input == 0){
        $mode = 2;
    }else {
        $mode = 1;
    }
    $update = mysqli_query($conn, "UPDATE registrasi set qty='$total_input', mode='$mode' WHERE uid='$uid'");

    $qty_konfersi = $qty*12;
    $log_activity = mysqli_query($conn, "INSERT into log_activity (uid, device, id_user, status, qty, qty_konfersi, id_lokasi, note) values ('$uid', '$device', '$datauser[0]', '$status', '$qty', '$qty_konfersi', '$dataregis[1]', '$desc')");
    header("Location: monitoring.php");
}else if($status === 'output'){
    $total_output = abs($dataregis[0] - $qty);

    if($total_output == 0){
        $mode = 2;
    }else {
        $mode = 1;
    }
    $qty_konfersi = $qty*12;
    $update = mysqli_query($conn, "UPDATE registrasi set qty='$total_output', mode='$mode;' WHERE uid='$uid'");
    $log_activity = mysqli_query($conn, "INSERT into log_activity (uid, device, id_user, status, qty, qty_konfersi, id_lokasi, note) values ('$uid', '$device', '$datauser[0]', '$status', '$qty', '$qty_konfersi', '$dataregis[1]', '$desc')");
    header("Location: monitoring.php");
}
?>