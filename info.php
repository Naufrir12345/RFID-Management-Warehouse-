<?php 
    include "koneksi.php";

    $uid = $_GET['uid'];
	$data_rekap1 = mysqli_query($conn, "SELECT * FROM view_registrasi WHERE uid='$uid'");
    $datarekap1 = mysqli_fetch_array($data_rekap1);
	$image = $datarekap1['upload'];

    // $data_rekap = mysqli_query($conn, "SELECT * FROM view_rekapitulasi WHERE uid='$uid'");
    // $datarekap = mysqli_fetch_array($data_rekap);
    // $id_brand = $datarekap['id_brand'];
    // $id_oli = $datarekap['id_oli'];
    // $id_typeoli = $datarekap['id_typeoli'];
    // $id_lokasi = $datarekap['id_lokasi'];
    
    // $nama_brand = mysqli_query($conn, "SELECT * FROM brand WHERE id_brand=$id_brand");
    // $namabrand = mysqli_fetch_array($nama_brand);

    // $nama_oli =  mysqli_query($conn, "SELECT * FROM nama_oli WHERE id_oli=$id_oli");
    // $namaoli = mysqli_fetch_array($nama_oli);
    // $type_oli =  mysqli_query($conn, "SELECT * FROM type_oli WHERE id_typeoli=$id_typeoli");
    // $typeoli = mysqli_fetch_array($type_oli);
    // $m_lokasi =  mysqli_query($conn, "SELECT * FROM m_lokasi WHERE id_lokasi=$id_lokasi");
    // $lokasi = mysqli_fetch_array($m_lokasi);
	
?>
<!DOCTYPE html>
<html>
    <head>
        <center>
            <h1> .:: Detail Report ::.</h1>
        </center>
        <hr >
		<center>
        <body>
            <?php include "header.php"?>
           
            <form method="GET" >
            	<div class="card-body" style="height:35rem; width:130rem;">
					<ul class="list-group list-group-flush" style="width:130rem; height:100rem;">
							<li class="list-group-item" style="text-align: left; font-weight: bold;">UID :<input type="text" class="form-control" id="username" name="username" style="font-weight: normal;" value="<?= $datarekap1['uid']; ?>" readonly></li>
							<li class="list-group-item" style="text-align: left; font-weight: bold;">DEVICE :<input type="text" class="form-control" id="username" name="username" style="font-weight: normal;" value="<?= $datarekap1['device']; ?>" readonly></li>
							<li class="list-group-item" style="text-align: left; font-weight: bold;">ITEM NAME :<input type="text" class="form-control" id="username" name="username" style="font-weight: normal;" value="<?= $datarekap1['item_name']; ?>" readonly></li>
							<li class="list-group-item" style="text-align: left; font-weight: bold;">ITEM NUMBER :<input type="text" class="form-control" id="username" name="username" style="font-weight: normal;" value="<?= $datarekap1['item_number']; ?>" readonly></li>
							<li class="list-group-item" style="text-align: left; font-weight: bold;">UNIT :<input type="text" class="form-control" id="username" name="username" style="font-weight: normal;" value="<?= $datarekap1['unit']; ?>" readonly></li>
							<li class="list-group-item" style="text-align: left; font-weight: bold;">QTY :<input type="text" class="form-control" id="username" name="username" style="font-weight: normal;" value="<?= $datarekap1['qty']; ?>" readonly></li>
                            <li class="list-group-item" style="text-align: left; font-weight: bold;">NOTE :<input type="text" class="form-control" id="username" name="username" style="font-weight: normal;" value="<?= $datarekap1['note']; ?>" readonly></li>
                            <li class="list-group-item" style="text-align: left; font-weight: bold;">LOKASI :<input type="text" class="form-control" id="username" name="username" style="font-weight: normal;" value="<?= $datarekap1['lokasi']; ?>" readonly></li>
							<li class="list-group-item" style="text-align: left; font-weight: bold;">TANGGAL :<input type="text" class="form-control" id="username" name="username" style="font-weight: normal;" value="<?= date('l, d M Y', strtotime($datarekap1['tanggal_registrasi'])) ?>" readonly></li>
							<li class="list-group-item" style="text-align: left; font-weight: bold;">GAMBAR : <br><?php echo "<img src='http://localhost/rfid/uploads/$image' width='250' height='250'>"?></li><br>
							<a href="rekapitulasidata.php" class="btn btn-warning btn-sm" style="text-align: left;">Kembali</a>
					</ul>

                    <!-- TANGGAL -->
                    <div class="col-sm-2" style="text-align:center; font-size:16px;"></div>
            	</div>
            </form>
			
        </body>
		</center>
    </head>
</html>