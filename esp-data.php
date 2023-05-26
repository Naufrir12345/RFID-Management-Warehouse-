<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<head>

	<title></title>
</head>
<body>
<div class="form-group">
                                        <?php
                                            include "koneksi.php";
                                            //$query = mysqli_query($conn, "SELECT * from item_code order by item_number esc");  
                                            $result = mysqli_query($conn, "SELECT * from item_code");       
                                        ?>
                                        <label>Item Number</label>
                                        <select name="tes" id="tes"  style="width: 200px" onchange="test()">
                                            <?php  
                                            while($data = mysqli_fetch_array($result)) { ?>
                                            <option name="item_number" value=<?= $data['item_number']?>><?= $data['item_number']?> </option> 
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Item Name</label>
                                            <!-- <select name="item_name" id="item_name" class="form-control" style="width: 200px"> -->
                                            <input type="text" name="item_name" id="item_name" readonly>
                                            <!-- <option value="">.:: Pilih Item Name ::.</option> -->
                                        </div>
                                        <div class="form-group">
                                            <label for="">Unit</label>
                                            <input type="text" name="unit" id="unit" readonly>
                                        </div>
                                 
                                        <!-- <div class="form-group">
                                            <label for="">Upload image</label>
                                            <input type="file" class="form-control" name="my_image" id="my_image" style="width: 200px">
                                        </div> -->
                                
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<script>
    //function detail(){
        // var id = $("#item_number").val();
        // $.ajax({
        //     url :"data.php",
        //     data :{id:id},
        //     dataType :"json",
        //     success:function(data){
        //         $('#item_name').val(data.item_name);
        //         $('#unit').val(data.unit);
        //     }
        // });
        function test(){
            const select = document.getElementById('tes');
            const value = select.options[select.selectedIndex].value;
            console.log(value);
            detail(value);
        }

        function detail(item_number){
            console.log(item_number)
            $.ajax({
                url: "data.php?item_number=" + item_number,	       
                success: function(response) {
                    const list_data = response.split('\n');
                    
                    $("#item_name").val(list_data[0]);
                    $("#unit").val(list_data[1]);

                }
            });
        }
    //}

    
</script>
</body>
</html>