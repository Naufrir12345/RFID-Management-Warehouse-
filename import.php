<?php
    include "koneksi.php";
    if(isset($_POST["import"])){
        $filename = $_FILES["file"]["tmp_name"];

        if($_FILES["file"]["size"] > 0){
            $file = fopen($filename, "r");

            while(($column = fgetcsv($file)) !== FALSE){
                $item_number = str_replace('   ', '', $column[0]);
                $item_name = str_replace('   ', '', $column[1]);
                $unit = str_replace('   ', '', $column[2]);
                $unitwgt = str_replace('   ', '', $column[3]);

                $sqlInsert = "INSERT into item_code (item_number, item_name, unit, unitwgt) VALUES ('$item_number', '$item_name', '?$unit', '$unitwgt')";
                $result = mysqli_query($conn, $sqlInsert);
                
                if(!empty($result)){
                    echo "CSV data Imported into the database";
                }else{
                    echo "Problem in importing csv";
                }
            }
        }
    }

?>

<form class="form-horizontal" action="" method="post" name="uploadCsv" enctype="multipart/form-data">
    <div>
        <label for="">Choose cvs file</label>
        <input type="file" name="file" accept=".csv">
        <button type="submit" name="import">Import</button>
    </div>

</form>