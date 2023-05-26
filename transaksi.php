<!DOCTYPE html>
<html>
    
    <?php 
        include "koneksi.php";
        include "library.php";

        $kategori = mysqli_query($conn, "select id_kategori, kategori from kategori");

        // $uid = $_GET['uid'];

        // $data_rekap = mysqli_query($conn, "SELECT * FROM view_rekapitulasi WHERE uid='$uid'");
        // $datarekap = mysqli_fetch_array($data_rekap);
    ?>
    
    <head>
        <!-- TABLE -->
        <script type="text/javascript">
            $(document).ready(function () {
                $('#example').DataTable();
            }); 
        </script>
        <!-- UID DEVICE -->
        <script>
        $(document).ready(function () {
            setInterval(function(){
                $("#cekkartu").load('popupMon.php')
            }, 0);

        });
        </script>
        <body>
            <div class="container-fluid">
                <center><br>
                
                </center><br>
                <?php
                    $uid = isset($_GET['uid']) ? $_GET['uid']:"";

                    $data_rekap = mysqli_query($conn, "SELECT * FROM registrasi WHERE uid='$uid'");
                    $datarekap = mysqli_fetch_array($data_rekap);

                    //$id_brand = $datarekap['id_brand'];
                    $mac = mysqli_query($conn, "SELECT device FROM rfid_data WHERE uid='$uid'");
                    $datamac = mysqli_fetch_array($mac);
                  
                    // $brand = mysqli_query($conn, "select id_brand, brand from brand"); 
                    // $type_brand = mysqli_query($conn, "select id_type, type_brand from type_brand");
                ?>
                
                <div class="card shadow mb-4">
                    <div class="card-header py-1" style="background-color:#000000;"></div>
                        <div class="card-body" style="height:60rem; width:auto; ">
                        <div class="row">

                            <div class="col-lg-2">
                                <div style="font-weight:bold;">UID</div>
                                <div style="font-weight:bold;">Item Number</div>
                                <div style="font-weight:bold;">Item Name</div>
                                <div style="font-weight:bold;">Unit</div>
                            </div>
                            <div class="col-lg-8 col-sm-1">
                                <div>: <b class="badge badge-danger badge-sm" style="font-size:12px;"><?php echo $datarekap['uid']; ?></b></div>
                                <div>: <?php echo $datarekap['item_number'];?></div>
                                <div>: <?php echo $datarekap['item_name'];?></div>
                                <div>: <?php echo $datarekap['unit'];?></div>
                            </div>
                            <!-- TANGGAL -->
                            <div class="col-sm-2" style="text-align:center; font-size:16px;"><?php 
                            date_default_timezone_set("Asia/Jakarta");

                            $waktu_lengkap = date('N j/n/Y H:i:s');
                            function tanggal_indonesia($waktu_lengkap){
                                $nama_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
                                $nama_bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September',
                                'Oktober','November','Desember');
                            
                                $pisah_waktu = explode(" ",$waktu_lengkap);
                                $hari = $pisah_waktu[0];
                                $tanggal = $pisah_waktu[1];
                                $jam = $pisah_waktu[2];
                            
                                $hari_baru = $nama_hari[$hari];
                                $pisah_tanggal = explode("/",$tanggal);
                                $tanggal_baru = $pisah_tanggal[0]." ".$nama_bulan[$pisah_tanggal[1]]." ".$pisah_tanggal[2];
                            
                                return $hari_baru.", ".$tanggal_baru;
                            
                            }
                            echo tanggal_indonesia($waktu_lengkap);?></div>

                        </div><hr>
                        
                            <div class="row">
                                <div class="col-lg-7 col-md-6">
                                    <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add">Monitoring</button> -->
                                </div>
                                <div class="col-lg-5 col-md-6" style="text-align: right;">
                                    <a href="rekapitulasidata.php" class="btn btn-danger btn-sm">Kembali</a>
                                </div> 
                            </div><br>
                            <!-- POP UP REGISTER  -->
                <!-- <center>
                <div class="modal fade" id="add" tabindex="-1" role="add" aria-labelledby="addLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addLabel">Add Monitoring</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                    <form  method="POST" action="simpanmonitoring.php" enctype="multipart/form-data">
                        <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div id="cekkartu"></div>
                                        <div class="form-group">
                                            <?php
                                                include "koneksi.php";
                                                $loc = mysqli_query($conn, "select id_lokasi, lokasi from m_lokasi");
                                                $result = mysqli_query($conn, "SELECT * from item_code");  
                                            ?>                                            
                                            <div class="form-group">
                                                <label style="font-weight:bold;">Lokasi</label>
                                                <select name="id_lokasi" id="id_lokasi"  class="form-control" style="width: 200px">
                                                    <option value="">.:: Pilih Lokasi ::.</option>
                                                    <?php  
                                                    while($data = mysqli_fetch_array($loc)) { ?>
                                                    <option value=<?= $data['id_lokasi']?>><?= $data['lokasi']?> </option> 
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <div class="form-group">
                                            <label style="font-weight:bold;">QTY</label>
                                            <input class="form-control" name="qty" id="qty" placeholder
                                            =".::Masukkan QTY::." class="form-control" style="width: 200px"
                                            required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold;">QTY Konfersi</label>
                                            <input class="form-control" name="qty_konfersi" id="qty_konfersi" placeholder
                                            =".::QTY Konfersi::." class="form-control" style="width: 200px"
                                            required>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-weight:bold;" for="">Upload image</label>
                                            <input type="file" class="form-control" name="my_image" id="my_image" style="width: 200px">
                                        </div>
                                        
                                    <div class="form-group">
                                        <label style="font-weight:bold;">Note</label>
                                        <textarea class="form-control" name="note" id="note" placeholder
                                        ="Text Here...." class="form-control" style="width: 200px"
                                        required></textarea>
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
                            </div>
                            </form>
                            <hr>
                            <div class="button">
                                <input type="submit" name="save" class="btn btn-success btn-sm" value="save" style="width: 100px">
                                <a href="transaksi.php?uid=<?php echo $datarekap['uid']; ?>" value="" type="submit" class="btn btn-danger btn-sm" style="width: 100px">kembali</a>
                            </div>
                        </div>
                                    </div>
                        </form>
                </div>  
                </center> -->
                            <div class="table-responsive" style="height:20rem width:35rem; ">
                                <table id="example" class="table" style="height:50rem width:100%" >
                                    <thead>
                                        <tr style="background-color:#FFFFFF;">
                                            <!-- <th style="text-align: center" >No.</th> -->
                                            <!-- <th style=" text-align: center; font-size: 15px;" >id</th> -->
                                            <th style=" text-align: center; font-size: 15px;" >UID</th>
                                            <th style=" text-align: center; font-size: 15px;" >Nama Device</th>
                                            <th style=" text-align: center; font-size: 15px;" >User</th>
                                            <th style=" text-align: center; font-size: 15px;" >QTY</th>
                                            <th style=" text-align: center; font-size: 15px;" >Tanggal</th>
                                            <th style=" text-align: center; font-size: 15px;" >Note</th>
                                            <th style=" text-align: center; font-size: 15px;" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                                //filter berdasarkan tanggal saat ini
                                                $sql = mysqli_query($conn, "select * from log_activity where uid='$uid'");
                                               
                                                $no = 0;
                                                while($data = mysqli_fetch_array($sql))
                                                {
                                                    $no++;
                                                    
                                                
                                                $data_user = mysqli_query($conn, "SELECT nama_user FROM user WHERE id_user='$data[3]'");
                                                $datauser = mysqli_fetch_array($data_user);
                                            ?>
                                        <tr>
                                            
                                            <!-- KOLOM DATA -->
                                            <!-- <td class="text-center" style="font-size: 14px;"><?php echo $data['id']; ?> </td> -->
                                            <td class="text-center" style="font-size: 14px;"> <?php echo $data['uid']; ?> </td>  
                                            <!-- <td class="text-center"><a class="badge badge-info badge-sm" style="cursor: pointer;" data-toggle="modal" title="Detail Image" data-target="#view_image<?php echo $data['uid']; ?>"><b style="font-size: 12px; color: white;"><?php echo $data['brand']; ?></b></a></td> -->
                                            <td class="text-center" style="font-size: 14px;"><?php echo $data['device']; ?></td>
                                            <td class="text-center" style="font-size: 14px;"><?php echo $datauser[0]; ?></td>
                                            <td class="text-center" style="font-size: 14px;"><?php echo $data['qty']; ?></td>
                                            <td class="text-center" style="font-size: 14px;"> <?php echo date('d M Y', strtotime( $data['tanggal'])); ?> </td>
                                            <td class="text-center" style="font-size: 14px;"><?php echo $data['note']; ?> </td>
                                            <td class="text-center" style="font-size: 18px;"><a href="infoMonitoring.php?id=<?php echo $data['id']; ?>" title="Detail Report" class="badge badge-danger badge-sm"><i class="fa fa-eye"></i></td>
                                        </tr>
                                            <?php } ?>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                </div>
        </body>
    </head>
</html>