<?php
    include "koneksi.php";
    //baca ID data
    $id = isset($_GET['uid']) ? $GET['uid']:'';
    
    //baca data barang berdasarkan ID
    $cari = mysqli_query($conn, "select * from data_rekapitulasi where uid='$id'");
    $hasil = mysqli_fetch_array($cari);

    //save button
    if(isset($_POST['btnSimpan'])){
        $uid = $_POST['uid'];
        $nama_brand = $_POST['nama_brand'];
        $type_brand = $_POST['type_brand'];
        $kapasitas = $_POST['kapasitas'];
        $satuan = $_POST['satuan'];
        $jenis_oli = $_POST['jenis_oli'];
        $history = $_POST['history'];

        echo $nama_brand;
        echo $type_brand;
        echo $kapasitas;
        echo $satuan;
        echo $jenis_oli;
        echo $history;

        $simpan = mysqli_query($conn, "update data_rekapitulasi set 
        uid='$uid',nama_brand='$nama_brand',type_brand='$type_brand',kapasitas='$kapasitas',satuan='$satuan', jenis_oli='$jenis_oli', history='$history'
        where uid = '$hasil[uid]'");
        
        //simpan data
        //$simpan = mysqli_query($conn, "insert into data_master(uid, nama_brand
        //, jenis_brand, kapasitas, satuan, jenis_oli, history)values('$uid', '$nama_brand', '$type_brand', '$kapasitas', '$satuan'
        //,'$jenis_oli, $history')");

        //tersimpan
        if($simpan){
            echo"
                <script>
                    alert('tersimpan');
                    location.replace('rekapitulasidata.php');
                </script>
            ";
        }
        else{
            echo"
                <script>
                    alert('gagal tersimpan');
                    location.replace('rekapitulasidata.php');
                /script>
            ";
        }
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "header.php"; ?>
    <title>Edit Data Barang</title>
<body>
    <?php include "menu.php"; ?>
    <div class="container-fluid">
            <!-- pembacaan kartu RFID otomatis -->
        <script type="text/javascript">
            $(document).ready(function(){
                setInterval(function(){
                $("#uidrfid").load('uid.php')
            }, 0); //pembacaan file uid.php tiap 1dtk (1000)
        });
        </script>
        <h3>Edit Data Barang</h3>
        <form method="POST">
            <div id="uidrfid">
                <div class="form-group">
                    <label>UID</label>
                    <input type="text" name="uid" id="uid" placeholder
                    ="UID Kartu" class="form-control" style="width: 200px">
                
                </div>
            </div>
            
            <div class="form-group">
                <label>Nama Brand</label>
                <input type="text" name="nama_brand" id="nama_brand" placeholder
                ="Nama Brand" class="form-control" style="width: 200px">
                
            </div>
            <div class="form-group">
                <label>Jenis Brand</label>
                <input type="text" name="type_brand" id="type_brand" placeholder
                ="jenis Brand" class="form-control" style="width: 200px">
                
            </div>
            <div class="form-group">
                <label>Kapasitas</label>
                <textarea class="form-control" name="kapasitas" id="kapasitas" placeholder
                ="kapasitas" class="form-control" style="width: 400px"
                value="<?php echo $hasil['kapasitas']; ?>"></textarea>
            </div>
            <div class="form-group">
                <label>Satuan</label>
                <input type="text" name="satuan" id="satuan" placeholder
                ="satuan" class="form-control" style="width: 200px">
                
            </div>
            <div class="form-group">
                <label>Jenis Oli</label>
                <input type="text" name="jenis_oli" id="jenis_oli" placeholder
                ="jenis Oli" class="form-control" style="width: 200px">
                
            </div>
            <div class="form-group">
                <label>History</label>
                <input type="text" name="history" id="history" placeholder
                ="history" class="form-control" style="width: 200px">
            </div>
            <button class="btn-primary" name="btnSimpan" id="btnSimpan">Simpan</button>
        </form>

    </div>
</body>
</head>
</html>