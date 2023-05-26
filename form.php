<!DOCTYPE html>
<html>
<head>
    <title>Menampilkan Data pada form berdasarkan pilihan Combo Box di PHP</title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <h4>Menampilkan Data pada form berdasarkan pilihan Combo Box di PHP</h4>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="get">
        <div class="form-group">
            <label for="sel1">Pilih item Number :</label>
            <select class="form-control" name="item_number">
                <?php
                include "koneksi.php";
                //Perintah sql untuk menampilkan semua data pada tabel jurusan
                // $sql="SELECT nik,nama from mahasiswa";
                $sql="SELECT item_number from item_code";

                $hasil=mysqli_query($conn,$sql);
                $no=0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;

                    $ket="";
                    if (isset($_GET['item_number'])) {
                        $nik = trim($_GET['item_number']);

                        if ($nik==$data['item_number'])
                        {
                            $ket="selected";
                        }
                    }
                    ?>
                    <option <?php echo $ket; ?> value="<?php echo $data['item_number'];?>"><?php echo $data['item_number'];?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-info" value="Pilih">
        </div>
    </form>
    <h2>Input Data</h2>

    <?php

    if (isset($_GET['item_number'])) {
        $nik=$_GET["item_number"];

        $sql="SELECT * from item_code where item_number=$nik";
        $hasil=mysqli_query($conn,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }
    ?>

        <div class="form-group">
            <label>item number:</label>
            <input type="text" name="item_number" value="<?php echo $data['item_number']; ?>" class="form-control" required />
        </div>
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="item_name" value="<?php echo $data['item_number']; ?>" class="form-control"  required/>
        </div>
        <div class="form-group">
            <label>unit:</label>
            <input type="text" name="unit" value="<?php echo $data['item_number']; ?>" class="form-control"  required/>
        </div>

        
</div>
</body>
</html>