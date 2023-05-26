<!DOCTYPE html>
<html>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
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
        <!-- POP UP -->
        <script type="text/javascript">
        $(document).ready(function() {
            setInterval(function(){
                $("#cekkartu").load('popupOpsi.php')
            }, 1000); 
        });
        </script>
        <!-- LOKASI -->
        <script type="text/javascript">
            $(document).ready(function test() {
                $('#status').select2({ width: '100%', placeholder: ".:: Pilih Status ::.", allowClear: true });
            //   $(".js-example-basic-single").select2();
            }); 
        </script>
        <body>
            <div class="container-fluid"><br><br>             
                <div class="card shadow mb-4">
                    <div class="card-header py-1" style="background-color:#000000;"></div>
                        <div class="card-body" style="height:45rem; width:auto; ">                        
                            <div class="row">
                                <div class="col-lg-7 col-md-6" style="font-size:18px;">
                                    <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add">Monitoring</button> -->
                                    <?php 
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
                                    echo tanggal_indonesia($waktu_lengkap);?>
                                </div>
                                <div class="col-lg-5 col-md-6" style="text-align: right;">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#opsi">Input Monitoring</button>
                                    <!-- <a href="rekapitulasidata.php" style="width:8rem" class="btn btn-info btn-sm">Opsi Data</a> -->
                                </div> 
                                <!-- POP UP REGISTER  -->
                                <center>
                                <div class="modal fade" id="opsi" role="dialog" aria-labelledby="opsiLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="opsiLabel">Input Monitoring</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                            <form  method="POST" action="monitoring_process.php" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div id="cekkartu"></div>
                                                        <hr style="border: 2px solid grey;">
                                                        <div class="col-lg-10 col-md-10">
                                                            <div class="form-group">
                                                            <label style="font-weight:bold;">Status</label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="" ></option>
                                                                <option value="input">Input Data</option>
                                                                <option value="output">Output Data</option>
                                                            </select>
                                                            </div>
                                                            <div class="form-group">    
                                                                <label style="font-weight:bold;">Jumlah Barang</label>
                                                                <input class="form-control" type="number" name="qty_out" id="qty_out">
                                                                <label style="font-weight:bold;">Deksripsi</label>
                                                                <textarea class="form-control" name="desc_out" id="desc_out" cols="30" rows="5"></textarea>
                                                            </div>
                                                        
                                                    </div> 
                                                </div><hr><br>     
                                                <div class="button">
                                                    <button type="submit" class="btn btn-success btn-sm" style="width: 100px">Simpan</button>
                                                    <a href="monitoring.php" type="submit" class="btn btn-danger btn-sm" style="width: 100px">kembali</a>
                                                </div>
                                            </form>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                                        
                                </center>
                            </div>
                            <span style="color:red; font-size:12px; font-weight:bold;">NOTE : Monitoring rekap data harian,<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; input data, output data</span>
                            <br><br>
                            <!-- POP UP REGISTER  -->
      
                            <div class="table-responsive" style="height:20rem width:35rem; ">
                                <table id="example" class="table" style="height:50rem width:100%" >
                                    <thead>
                                        
                                        <tr style="background-color:#FFFFFF;">
                                            <!-- <th style="text-align: center" >No.</th> -->
                                            <!-- <th style=" text-align: center; font-size: 15px;" >id</th> -->
                                            <th style=" text-align: center; font-size: 15px;" >UID</th>
                                            <th style=" text-align: center; font-size: 15px;" >Nama Device</th>
                                            <th style=" text-align: center; font-size: 15px;" >Status</th>
                                            <th style=" text-align: center; font-size: 15px;" >QTY</th>
                                            <th style=" text-align: center; font-size: 15px;" >Tanggal</th>
                                            <th style=" text-align: center; font-size: 15px;" >Note</th>
                                            <!-- <th style=" text-align: center; font-size: 15px;" >Action</th> -->
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                                //filter berdasarkan tanggal saat ini
                                                $uid = isset($_GET['uid']) ? $_GET['uid']:"";
                                               
                                                $sql = mysqli_query($conn, "SELECT * FROM registrasi");
                                                
                                                // die($sql); 
                                                $no = 0;
                                                while($data = mysqli_fetch_array($sql))
                                                {
                                                    $no++;    
                                            ?>
                                        <tr>
                                            
                                            <!-- KOLOM DATA -->
                                            <!-- <td class="text-center" style="font-size: 14px;"><?php echo $data['id']; ?> </td> -->
                                            <td class="text-center" style="font-size: 14px;" > <?php echo $data['uid']; ?></td>  
                                            <!-- <td class="text-center"><a class="badge badge-info badge-sm" style="cursor: pointer;" data-toggle="modal" title="Detail Image" data-target="#view_image<?php echo $data['uid']; ?>"><b style="font-size: 12px; color: white;"><?php echo $data['brand']; ?></b></a></td> -->
                                            <td class="text-center" style="font-size: 14px;"><?php echo $data['device']; ?></td>
                                            <!-- <a href="info.php?uid=<?php echo $data['mode']; ?>" title="Detail Report" class="badge badge-danger badge-sm"><b style="font-size: 13px;"><?php echo $data['mode']; ?></b></a> -->
                                            <td class="text-center" style="font-size: 14px;">
                                            <?php if($data['mode'] == '1') {?>
                                                <span class="badge badge-success badge-sm" style="font-size: 12px;"> Available </span>
                                            <?php } ?>

                                            <?php if($data['mode'] == '2') {?>
                                                <span class="badge badge-danger badge-sm" style="font-size: 12px;"> Sold Out </span>
                                            <?php } ?>

                                            <?php if($data['mode'] == '3') {?>
                                                <span class="badge badge-info badge-sm" style="font-size: 12px;"> Monitoring </span>
                                            <?php } ?>
                                            <!-- <?php echo $data['status']; ?> -->
                                            </td>
                                            <td class="text-center" style="font-size: 14px;"><?php echo $data['qty']; ?></td>
                                            <td class="text-center" style="font-size: 14px;"> <?php echo date('d M Y', strtotime($data['tanggal_registrasi'])); ?> </td>
                                            <td class="text-center" style="font-size: 14px;"><?php echo $data['note']; ?></td>
                                            <!-- <td class="text-center" style="font-size: 18px;"><a href="infoMonitoring.php?id=<?php echo $data['id']; ?>" title="Detail Report" class="badge badge-danger badge-sm"><i class="fa fa-eye"></i></td> -->
                                        </tr>
                                            <?php } ?>  
                                    </tbody>
                                </table>
                                <br><a href="rekapitulasidata.php" class="btn btn-danger btn-sm">Kembali</a>
                            </div>
                        </div>
                        
                </div>
        </body>
    </head>
</html>