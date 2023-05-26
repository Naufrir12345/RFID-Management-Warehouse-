<?php
include "koneksi.php";
$i=0;
$get_sql = "select * from log_activity";
$run = mysqli_query($conn,$get_sql);
while($row = mysqli_fetch_array($run)){
$date = $row['note'];
$i++;
?>
	<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $row['uid']; ?></td> 
	<?php foreach($d as $da) { if($date==$da){?>
	<td><?php echo $row['device']; ?></td>
	<?php }else{ ?>
	<td><?php echo "0";?></td>
	<?php }}?>
	
</tr>
<?php }?>