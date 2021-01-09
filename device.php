<?php 
require 'includes/init.inc';

$id = (int)$_REQUEST['id'];
if($id) {
	$query = "SELECT devices.*, device_kinds.kind, DATE_FORMAT(registration_date,'%d.%m.%Y г.') AS date_formated "
	." FROM devices JOIN device_kinds ON devices.device_kind_id=device_kinds.device_kind_id WHERE device_id=".$id;
    $result = $mysqli->query($query);
	$row_device = $result->fetch_assoc();

	$nav_path = ' / <a href="devices.php'.($row_device['device_kind_id']?'?kindID='.$row_device['device_kind_id']:'').'">'.htmlspecialchars(stripcslashes($row_device['kind'])).'</a>'
			.' / <a href="'.$_SERVER['PHP_SELF'].($id?'?id='.$id:'').'">'.htmlspecialchars(stripcslashes($row_device['name'])).'</a>';
	$page_title = 'DeviceX - '.htmlspecialchars(stripcslashes($row_device['name']));
}

require 'includes/header.inc'; 

print' <div style="text-align: left">	
<table class="device-info-table">
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
			<h1>'.htmlspecialchars(stripslashes($row_device['name'])).'</h1>';
			if($row_device["kind"]){
           		print'<div>Тип: '.htmlspecialchars(stripslashes($row_device["kind"])).'</div>';
           	}
			if($row_device["brand"]){
           		print'<div>Марка: '.htmlspecialchars(stripslashes($row_device["brand"])).'</div>';
           	}
        	if($row_device["price"]){
           		print'<div>Цена: '.$row_device["price"].' $</div>';
        	}
        	if($row_device["info"]){
           		print'<div>Описание: '.htmlspecialchars(stripslashes($row_device["info"])).'</div>';
        	}     
        	print'<div>Регистриран: '.$row_device["date_formated"].'</div>		
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>';
			   $object_title = htmlspecialchars(stripslashes($row_device['name'].($row_device['brand']?', '.$row_device['brand']:'')));
			   $pic = $device_pictires_dir.$row_device['picture'];
			   $pic_exists = file_exists($pic);
			print'<img class="img-device" src="'.$pic.'" alt="'.$object_title.'" title="'.$object_title.'">			
		</td>
	</tr>
</table>             
</div>';
require 'includes/footer.inc'; 
 ?>