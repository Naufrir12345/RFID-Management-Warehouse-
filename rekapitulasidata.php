<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js" defer></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<!--  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" ></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" ></script>
   
    <!-- library -->
    <?php 
        include "library.php";

        session_start();
 
        if (!isset($_SESSION['user'])) {
        header("Location: loginbckup.php");
}
 
?>
<style>
    .flex-container {
    display: flex;
    flex-wrap: nowrap; 
    justify-content: left;
    gap: 10px;
    
    }

    .flex-container > div {
    width: 200px;
    /* margin: 5px; */
    text-align: center;
    line-height: 75px;
    font-size: 30px;
    }
</style>
<!-- Data Table -->
<script type="text/javascript">
$(document).ready(function () {
    $('#example').DataTable();
}); 
</script>

<!-- POP UP -->
<script type="text/javascript">
$(document).ready(function() {
    setInterval(function(){
        $("#cekkartu").load('popup.php')
    }, 1000);
    
});
</script>

<!-- SELECT2 -->
<script type="text/javascript">
$(document).ready(function test() {
    $('#item_number').select2({ width: '100%', placeholder: ".:: Select Item Number ::.", allowClear: true });
//   $(".js-example-basic-single").select2();
}); 
</script>

<!-- LOKASI -->
<script type="text/javascript">
$(document).ready(function test() {
    $('#id_lokasi').select2({ width: '120%', placeholder: ".:: Select Lokasi ::.", allowClear: true });
//   $(".js-example-basic-single").select2();
}); 
</script>

<!-- AUTOFILL -->
 
    <title>Rekapitulasi Data</title>
<body>
    
    
<?php
                    include "koneksi.php";
                    $uid = isset($_GET['uid']) ? $_GET['uid']:"";

                    $kategori = mysqli_query($conn, "select id_kategori, kategori from kategori");
                    $tanggal = mysqli_query($conn, "select tanggal_registrasi from registrasi");
            
                    // POP UP 
                    $item_number = mysqli_query($conn, "select item_number from item_code"); 
                    $item_name = mysqli_query($conn, "select item_name from item_code"); 
                    $unit = mysqli_query($conn, "select unit from item_code"); 
                                      
 ?>
<!-- <?php 
    $sql = mysqli_query($conn, "SELECT * from rfid_data");
    $data = mysqli_fetch_array($sql);
    $uid = isset($data['uid']) ? $data['uid']:""; 
    $mac = isset($data['device']) ? $data['device']:"";
?> -->
 <style>
    .btn-secondary {
    --bs-btn-color: #fff;
    --bs-btn-bg: #0a3256;
    --bs-btn-border-color: #282828;
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: #d54f4f;
    --bs-btn-hover-border-color: #565e64;
    --bs-btn-focus-shadow-rgb: 130,138,145;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: #565e64;
    --bs-btn-active-border-color: #51585e;
    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    --bs-btn-disabled-color: #fff;
    --bs-btn-disabled-bg: #6c757d;
    --bs-btn-disabled-border-color: #6c757d;
    }  
 </style>

    <div class="container-fluid"><br>
    <span style="color:black; font-weight:bold;"><?php echo " <h5>Selamat Datang, " . $_SESSION['user'] ."!". "</h5>"; ?></span>
    
        <center><br>
        <h1>.:: Rekap Data ::.</h1>
        </center><br>

<!-- Filter Berdasarkan Kategori -->
<form class="form-inline" name="" method="GET" action="">
    <div class="navbar-form navbar-left"> 
        <div class="flex-container">
            <select name="id_kategori" id="id_kategori" class="form-control"> 
                <option value="">.:: Pilih Berdasarkan ::.</option>
                <?php  
                     while($data = mysqli_fetch_array($kategori)) { ?>
                <option value="<?= $data ['id_kategori']?> "><?= $data ['kategori'] ?></option>
                <?php } ?>
            </select>
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i></button>
        </div>
    </div>  
</form>    

    <div class="card shadow mb-4">
    <div class="card-header py-1" style="background-color:#000000;"></div>
        <div class="card-body" style="height:45rem; width:auto;">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#registered">Registered Card</button>
                    <a href="monitoring.php" class="btn btn-warning btn-sm" style="color:white">Monitoring Log</a>
                </div>
                <div class="col-lg-5 col-md-6" style="text-align: right;">
                    <a 
                    href="logout.php" class="btn btn-danger btn-sm">Log Out</a>
                </div> 
            </div>
                        
<!-- POP UP REGISTER  -->
 <center>
<div class="modal fade" id="registered" role="dialog" aria-labelledby="registeredLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="registeredLabel">Registered New Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <form  method="POST" action="simpanpop.php" enctype="multipart/form-data">
            <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group" id="cekkartu"></div>
                        <div class="form-group">
                            <?php
                                include "koneksi.php";
                                $loc = mysqli_query($conn, "select id_lokasi, lokasi from m_lokasi");  
                                $result = mysqli_query($conn, "SELECT * from item_code");       
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label> 
                            <input type="text" name="tanggal_registrasi" id="tanggal_registrasi" class="form-control" style="width: 200px" value="<?php echo date('d-m-Y');?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Item Number</label>
                            <select name="item_number" id="item_number"  class="form-control" style="width: 200px" onchange='test()'>
                                <option value="" >.:: Pilih Item Number ::.</option>
                                <?php  
                                    while($data = mysqli_fetch_array($result)) { ?>
                                    <option value=<?= $data['item_number']?>><?= $data['item_number']?> </option> 
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Item Name</label>
                            <input type="text" name="item_name" id="item_name" style="width: 200px" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Unit</label>
                            <input type="text" name="unit" id="unit" class="form-control" style="width: 200px" readonly>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="form-group">
                            <label>Lokasi</label>
                            <select name="id_lokasi" id="id_lokasi"  class="form-control" style="width: 200px">
                                <option value="">.:: Pilih Lokasi ::.</option>
                                <?php  
                                while($data = mysqli_fetch_array($loc)) { ?>
                                <option value=<?= $data['id_lokasi']?>><?= $data['lokasi']?> </option> 
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>QTY</label>
                            <input class="form-control" name="qty" id="qty" placeholder
                            =".::Masukkan QTY::." class="form-control" style="width: 200px"
                            required>
                        </div>
                        <div class="form-group">
                            <label>QTY Konfersi</label>
                            <input class="form-control" name="qty_konfersi" id="qty_konfersi" placeholder
                            =".::QTY Konfersi::." class="form-control" style="width: 200px"
                            required>
                        </div>
                        <div class="form-group">
                            <label for="">Upload image</label>
                            <input type="file" class="form-control" name="my_image" id="my_image" style="width: 200px">
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" name="note" id="note" placeholder
                            ="Text Here...." class="form-control" style="width: 200px"
                            required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>
        <div class="button">
            <input type="submit" name="Simpan" class="btn btn-success btn-sm" value="Simpan" style="width: 100px">
            <a href="rekapitulasidata.php" type="submit" class="btn btn-danger btn-sm" style="width: 100px">kembali</a>
        </div><hr>
    </div>
    </div>
</div>
<script>
    function test(){
        const select = document.getElementById('item_number');
        const value = select.options[select.selectedIndex].value;
        console.log(value);
        detail(value);
    }
    function detail(item_number){
        console.log(item_number)
        $.ajax({
            url: "data.php?item_number=" + item_number,	       
            success: function(response) {
                const list_data = response.split('?');
                const list_data1 = list_data[1].split('  ');
                console.log(list_data1[0]);
                $("#item_name").val(list_data[0]);
                $("#unit").val(list_data1[0]);
                $("#wgunit").val(list_data1[1]);
            }
        });
    }
</script>            
</center>
                        
        <div class="table-responsive" style="height:20rem width:35rem; ">
       
        <table id="example" class="table " style="height:50rem width:100%">
        
            <thead> 
                <br>
                </div>
                <tr style="background-color:#FFFF00;">
                    <!-- <th style="text-align: center" >No.</th> -->
                    <th style=" text-align: center; font-size: 15px;" >UID</th>
                    <th style=" text-align: center; font-size: 15px;" >Item Number</th>
                    <th style=" text-align: center; font-size: 15px;" >Item Name</th>
                    <th style=" text-align: center; font-size: 15px;" >Unit</th>

                    <!-- <th style=" text-align: center; font-size: 15px;" >Note</th>
                    <th style=" text-align: center; font-size: 15px;" >Lokasi</th>
                    <th style=" text-align: center; font-size: 15px;" >Tanggal Registrasi</th> -->
                    <th style=" text-align: center; font-size: 15px;" >Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "koneksi.php";
                    //baca tabel pada nomor kartu rfid untuk tgl hari ini

                    //tanggal
                    date_default_timezone_set('Asia/Jakarta');
                    $tanggal = date('Y-m-d');
                    
                    //filter berdasarkan tanggal saat ini
                    $sql = mysqli_query($conn, "SELECT * FROM view_registrasi");

                    // looping data dari database sesuai query ($sql) diatas
                    $no = 0;
                    while($data = mysqli_fetch_array($sql))
                    {
                        $no++;
                    
                ?>
                <tr>
                    
                    <!-- <td> <?php echo $no; ?> </td> -->
                    <td class="text-center" style="font-size: 12px;">
                    <a href="info.php?uid=<?php echo $data['uid']; ?>" title="Detail Report" class="badge badge-danger badge-sm"><b style="font-size: 13px;"><?php echo $data['uid']; ?></b></a>
                    
                    <!-- KOLOM DATA -->
                    </td>  
                    <!-- <td class="text-center"><a class="badge badge-info badge-sm" style="cursor: pointer;" data-toggle="modal" title="Detail Image" data-target="#view_image<?php echo $data['uid']; ?>"><b style="font-size: 12px; color: white;"><?php echo $data['item_number']; ?></b></a></td> -->
                    <!-- <center><td ><a href="Modalimage.php?uid=<?php echo $data['brand']; ?>" title="Detail Image"><b style="font-size: 12px;"><?php echo $data['brand']; ?></b></a></td></center> -->
                    <!-- <td class="text-center" style="font-size: 14px;"> <?php echo $data['item_number']; ?> </td> -->
                    <td class="text-center" id="txtresult" style="font-size: 14px;"> <?php echo $data['item_number']; ?> </td>
                    <td class="text-center" id="txtresult" style="font-size: 14px;"> <?php echo $data['item_name']; ?> </td>
                    <td class="text-center" id="txtresult" style="font-size: 14px;"> <?php echo $data['unit']; ?> </td>
                    <!-- <td class="text-center" style="font-size: 14px;"> <?php echo $data['note']; ?> </td>
                    <td class="text-center" style="font-size: 14px;"> <?php echo $data['lokasi']; ?> </td>
                    <td class="text-center" style="font-size: 14px;"> <?php echo date('d M Y', strtotime( $data['tanggal_registrasi'])); ?> </td> -->
                    <td class="text-center" style="font-size: 14px;">
                        <a href="update_data.php?uid=<?php echo $data['uid']; ?>" title="Update Report" class="btn btn-success btn-sm"><i style="color:white;" class="fa fa-pencil"></i></a>
                        <a href="hapus.php?uid=<?php echo $data['uid']; ?>" title="Delete Report" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-lg"></i></a>
                        <a href="transaksi.php?uid=<?php echo $data['uid']; ?>" title="UID Log Report" class="btn btn-warning btn-sm"><i style="color:white;" class="fa fa-clock-o"></i></a>
                    </td>
                </tr>
                <div class="modal fade" id="view_image<?php echo $data['uid']; ?>" tabindex="-1" role="dialog" aria-labelledby="imageLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageLabel">View Image</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body" style="text-align:center;">
                                <div id="display-image">
                                    <?php
                                        $image = $data['upload'];
                                        echo "<img src='http://localhost/rfid/uploads/$image' width='300' height='300'>"    
                                    ?>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </tbody>
        </table>
       
        </div>
        
        <br>
        </div>
    </div>
</body>

</head>
</html>
