<?php
    include "koneksi.php";
    //baca isi table rfid_data
    $sql = mysqli_query($conn, "SELECT * from data_rekapitulasi");
    $data = mysqli_fetch_array($sql);

    //baca no kartu
    $uid = $data['uid'];
    //$uid = isset($data['uid']) ? $data['uid']:"";
?>

<div class="form-group">
    <label>UID</label>
    <input type="text" name="uid" id="uid" placeholder
    ="Scan kartu RFID" class="form-control" style="width: 200px" value="<?php
    echo $uid; ?>">
</div>