<?php 

 $confirm=NULL;
	if ($_POST) {
		if ($_POST['conf']=='YES') { 
			$nav_path = ' / <a href="devices_edit.php">Устройства</a>'; 
			$confirm='y';
		}
	} 	
	if ($_GET) { 
		$id=$_GET['id']; 
	} else {
		$id=NULL; 
	}

require 'includes/init.inc'; 
if ($confirm==NULL) { $nav_path = ' / <a href="'.$_SERVER['PHP_SELF'].'">Устройства</a>'; } 
$page_title = 'DeviceX';
require 'includes/header.inc'; 

	if ($confirm=='y') {
	 $mysqli->query("DELETE FROM devices WHERE device_id=".(int)$_POST['id']); 
	 $aff_rows = $mysqli->affected_rows;
		if($aff_rows){
			print'<div class="infoBlock">Изтрити Устройства: '.$aff_rows.'</div>';
		}else{
			print'<div class="errorBlock">Няма изтрити</div>';
			$confirm=NULL;
		}
	}	

 if ($id!=NULL) { 
		print'<div class="errorBlock" style="background-color:#ff5959;">
			<table><tr>
			 <td style="color:black;"><b>Потвърждавате ли изтриването? </b></td> 
			 <form method="post" name="conf" action="'.$_SERVER['PHP_SELF'].'" class="form">
			 <input type="hidden" name="id" value="'.$id.'">
			 <td><input type="submit" name="conf" value="Да"></td>
			 <td><input type="submit" name="conf" value="Отмяна"></td>	
			 </form>
			 </tr></table>
			</div>';
	} 

$result = $mysqli->query("SELECT * FROM devices");
if($result->num_rows>0){

	print'<table class="table-list">
		<tr style="background-color: #cb3b3b;">
			<th>Edit</th>
			<th>Image</th>
			<th>Name</th>
			<th>Delete</th>
		</tr>'; 
	while($row = $result->fetch_assoc()){
		$small_pic = $device_pictires_dir.$device_pictires_small_prefix.$row['picture'];
		$small_pic_exists = file_exists($small_pic);
		$name = htmlspecialchars(stripcslashes($row['name']));		
		print'<tr>
			<td><a href="device_edit.php?id='.$row['device_id'].'"><img src="images/icons/edit.png" alt="Edit" title="Edit"></a></td>
			<td>';
			if ($small_pic_exists) { print'<img src="'.$small_pic.'" title="'.$name.'" alt="'.$name.'">';}
		print'</td> 
			<td>'.$row['device_id'].'. '.$name.'</td>
			<td><a href="'.$_SERVER['PHP_SELF'].'?id='.$row['device_id'].'"><img src="images/icons/delete.png" alt="Delete" title="Delete"></a></td>	
		</tr>'; 
	}
	print'</table>';
}
require 'includes/footer.inc'; 
 ?>