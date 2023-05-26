<?php
// use PhpMyAdmin\Export\Options;
 include('koneksi.php');

 $uid = $_GET['uid'];
 $data_rekap = mysqli_query($conn, "SELECT * FROM view_registrasi WHERE uid='$uid'");
 $datarekap = mysqli_fetch_array($data_rekap);

// print_r($data);
?>
 <?php
                    include "koneksi.php";
                    //baca tabel pada nomor kartu rfid untuk tgl hari ini

                    //tanggal
                    date_default_timezone_set('Asia/Jakarta');
                    $tanggal = date('Y-m-d');
                    
                    //filter berdasarkan tanggal saat ini
                    // $sql = mysqli_query($conn, "select id_brand, brand from brand"); 
                    // $sql1 = mysqli_query($conn, "select id_type, type_brand from type_brand"); 
                    // $sql2 = mysqli_query($conn, "select id_oli, nama_oli from nama_oli"); 
                    // $sql3 = mysqli_query($conn, "select id_typeoli, type_oli from type_oli"); 
                    // $sql4 = mysqli_query($conn, "select id_satuan, satuan from satuan"); 
                    // $sql5 = mysqli_query($conn, "select id_kategori, kategori from kategori");
                    // $sql6 = mysqli_query($conn, "select id_lokasi, lokasi from m_lokasi");
                    $item_number = mysqli_query($conn, "select item_number from item_code"); 
                    $item_name = mysqli_query($conn, "select item_name from item_code"); 
                    $unit = mysqli_query($conn, "select unit from item_code"); 
                    $result = mysqli_query($conn, "SELECT * from item_code");
                    $loc = mysqli_query($conn, "select id_lokasi, lokasi from m_lokasi");
                    $in = mysqli_query($conn, "SELECT item_number FROM view_registrasi WHERE uid='$uid'")
 ?>

<!DOCTYPE html>
<center>
<html>
<head>
    <?php include "header.php"?>
    <?php include "menu.php"?>
    <h3>.:: Update Data Scan ::.</h3>
</head>
<style>
    .flex-container {
    display: flex;
    flex-wrap: nowrap; 
    justify-content: center;
    gap: 50px;
 
    }

    .flex-container > div {
    width: 100px;
    margin: 5px;
    text-align: center;
    line-height: 75px;
    font-size: 30px;
    }
</style>

<hr>
    <body>
        <form method="POST" action="update.php" enctype="multipart/form-data">
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <!--UID-->
                <label>Uid</label>
                <input type="text" name="uid" id="uid"  class="form-control" style="width: 300px" 
                value="<?php echo $datarekap['uid']; ?>" readonly>
            </div>
            <!--BRAND-->
            <div class="form-group">
                <div class="form-group">
                    <label>Item Number</label>
                    <select name="item_number" id="item_number"  class="form-control" style="width: 300px" onchange="test()">
                        <option value="">.:: Pilih Item Number ::.</option>
                        <?php while($data = mysqli_fetch_array($result)) { ?>

                            <?php  if($data['item_number'] == $datarekap['item_number']) {?>
                                <option value="<?= $data['item_number']?>" selected><?= $data['item_number']?></option>
                                    <?php } else { ?>
                                <option value="<?= $data['item_number']?>"><?= $data['item_number']?></option>
                            <?php }?>

                        <?php } ?>
                    </select>
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
                
            <!--TYPE BRAND-->
            <div class="form-group">
                <label for="">Item Name</label>
                <input type="text" name="item_name" id="item_name" style="width: 300px" class="form-control" value="<?php echo $datarekap['item_name']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="">Unit</label>
                <input type="text" name="unit" id="unit" class="form-control" style="width: 300px" value="<?php echo $datarekap['unit']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Area Lokasi</label>
                <select name="id_lokasi" id="id_lokasi"  class="form-control" style="width: 300px">
                    <option value="">.:: Pilih Item Number ::.</option>
                    <?php while($data = mysqli_fetch_array($loc)) { ?>
                        <?php  if($data['id_lokasi'] == $datarekap['id_lokasi']) {?>
                            <option value="<?= $data['id_lokasi']?>" selected><?= $data['lokasi']?></option>
                                <?php } else { ?>
                            <option value="<?= $data['id_lokasi']?>"><?= $data['lokasi']?></option>
                        <?php }?>
                    <?php } ?>
                </select>
            </div>
           
            </div> 
        </div> 
        
        <div class="col-lg-5 col-md-6">
            <div class="form-group">
                <label>QTY</label>
                <input class="form-control" name="qty" id="qty" value
                ="<?php echo $datarekap['qty']; ?>" class="form-control" style="width: 300px"
                required>
            </div>
            <div class="form-group">
                <label>QTY Konfersi</label>
                <input class="form-control" name="qty_konfersi" id="qty_konfersi" value
                ="<?php echo $datarekap['qty_konfersi']; ?>" class="form-control" style="width: 300px"
                required>
            </div>
            <div class="form-group">
                <label for="">Upload Gambar</label>
                <input type="file" class="form-control" name="my_image" id="my_image" style="width: 300px">
            </div>
                                        
            <div class="form-group">
                <label>Note</label>
                <textarea class="form-control" name="note" id="note" placeholder
                ="" class="form-control" style="width: 300px"
                required><?php echo $datarekap['note']; ?></textarea>
            </div>
            
            <div class="btn">
                <input type="submit" class="btn btn-success btn-sm" name="Simpan" value="Simpan" style="width: 100px">
                <a href="rekapitulasidata.php" type="submit" class="btn btn-danger btn-sm" style="width: 100px">Batal</a>

            </div>
        </div>   
        </form>
        
       
    </body>


</html>

</center>
