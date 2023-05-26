<html>
    <head>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
        </head>
        
    <script type="text/javascript">
    
$(document).ready(function() {
    $('select').select2({ width: '40%', placeholder: "Select an Option", allowClear: true });
//   $(".js-example-basic-single").select2();

  
}); 
</script>

<?php
include "koneksi.php";
$result = mysqli_query($conn, "SELECT * from item_code");
?>

<!-- <select class="select"> -->
  <!-- <option value="AL">Alabama</option>
    ...
  <option value="WY">Wyoming</option> -->
  <div class="form-group">
    <label>Item Number</label>
    <select name="item_number" id="item_number"  style="width: 400px" >
            <option value="" >.:: Pilih Item Number ::.</option>
            <?php  
            while($data = mysqli_fetch_array($result)) { ?>
            <option value=<?= $data['item_number']?>><?= $data['item_number']?> </option> 
            <?php } ?>
       
    </select>
    </div>
<!-- </select> -->
</html>
