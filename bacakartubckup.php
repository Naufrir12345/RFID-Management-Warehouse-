<?php
    include "koneksi.php";
    //baca tabel status
    $sql = mysqli_query($conn, "select * from status_data");
    $data = mysqli_fetch_array($sql);
    $mode_data = isset($data['mode']) ? $data['mode']:'';
   // $baca_kartu = mysqli_query($conn, "select * from rfid_data");
    //$data_kartu = mysqli_fetch_array($baca_kartu);
    //uji mode
    $mode = "";
    if($mode_data==1)
        $mode = "Cek Sparepart";
    else if($mode_data==2)
        $mode = "Cek Oli Mesin";
    else if($mode_data==3)
        $mode = "Cek Terakhir Servis";
    //baca tabel rfid_data
    
    $baca_kartu = mysqli_query($conn, "select * from rfid_data");
    $data_kartu = mysqli_fetch_array($baca_kartu);
    $uid = isset($data_kartu['uid']) ? $data_kartu['uid']:'';
?>
<br>
<div class="container-fluid" style="text-align: center";>
    <?php if($uid==""){?>
    <h3>Mode : <?php echo $mode?></h3>
    <h3>Silahkan Tempelkan Kartu Anda</h3>
    <img src="images/rfid.png" style="width: 200px">
   <?php } else {
        //cek kartu rfid apakah terdaftar
        $cari_data = mysqli_query($conn, "select * from data_master
            where uid='$uid'");
        $jumlah_data = mysqli_num_rows($cari_data);

        if($jumlah_data==0)
            echo "<h1>Maaf Kartu tidak dikenali</h1>";
        else
        {
            //ambil nama data
            $data_barang = mysqli_fetch_array($cari_data);
            $nama = $data_barang['nama'];

            //tanggal dan jam hariini
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');
                

            //cek tabel apakah nomor kartu sesuai tanggal saat in
            $cari_barang = mysqli_query($conn, "select * from data_rekapitulasi
                where uid='$uid' and tanggal='$tanggal'");
            
            //hitung jumlah data
            $jumlah_data = mysqli_num_rows($cari_barang);
            if($jumlah_data == 0)
            {
                echo "<h1>Selamat DAtaang <br> $nama</h1>";
                mysqli_query($conn, "insert into data_rekapitulasi(uid, tanggal
                )values('$uid', '$tanggal')");
            }
            else if($mode_data == 2){
                echo "<h1>Selamat istirahat <br> $nama</h1>";
                mysqli_query($conn, "update data_rekapitulasi set waktu
                = CURRENT_TIME() where uid='$uid' and tanggal='$tanggal'");
            }
        }
        //kosongkan tabel rfid_data
        mysqli_query($conn, "delete from rfid_data");
   } ?>
</div>