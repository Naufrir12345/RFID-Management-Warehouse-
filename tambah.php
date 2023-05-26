<?php
    include "koneksi.php";
    //save button
    if(isset($_POST['btnSimpan'])){
        $uid = $_POST['uid'];
        $nama_brand = $_POST['nama_brand'];
        $type_brand = $_POST['type_brand'];
        $kapasitas = $_POST['kapasitas'];
        $history = $_POST['history'];
        $satuan = $_POST['satuan'];
        $jenis_oli = $_POST['jenis_oli'];

        
        //simpan data
        $simpan = mysqli_query($conn, "insert into data_master(uid, nama_brand
        , type_brand, kapasitas, satuan, jenis_oli, history)values('$uid', '$nama_brand', 
        '$type_brand', '$kapasitas', '$satuan', '$jenis_oli', '$history')");

        //tersimpan
        if($simpan){
            echo"
                <script>
                    alert('tersimpan');
                    location.replace('master.php');
                </script>
            ";
        }
        else{
            echo"
                <script>
                    alert('gagal tersimpan');
                    location.replace('master.php');
                /script>
            ";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "header.php"; ?>
    <title>Tambah Data Barang</title>

    <!-- pembacaan kartu RFID otomatis -->
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function(){
                $("#uidrfid").load('uid.php')
            }, 0); //pembacaan file uid.php tiap 1dtk (1000)
        });
    </script>

<body>
    <?php include "menu.php"; ?>
    <div class="container-fluid">
        <h3>Tambah Data Barang</h3>
        <form method="POST">
            <div id="uidrfid"></div>
            
            <div class="form-group">
                <label>Satuan</label>
                <input type="text" name="satuan" id="satuan" placeholder
                ="Masukkan satuan" class="form-control" style="width: 200px">
            </div>
            <div class="form-group">
                <label>History</label>
                <textarea class="form-control" name="history" id="history" placeholder
                ="Masukkan history" class="form-control" style="width: 400px"></textarea>
            </div>
            <div class="form-group">
                <label>Jenis Oli</label>
                <input type="text" name="jenis_oli" id="jenis_oli" placeholder
                ="Masukkan jenis oli" class="form-control" style="width: 200px">
            </div>
            <button class="btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
        </form>

    </div>
</body>
</head>
</html>


