<?php 
require 'includes/init.inc';
 $errorMessage = NULL;
 $infoMessage = NULL;
 $operation_type = 'Ново Устройство';

  if($_REQUEST){ 
  	$id = (int)$_REQUEST['id'];
  } else { 
  	$id = NULL; 
  } 
  
  if($_POST){
 	$operation_type = 'Редактиране на устройство';
	$id = $mysqli->escape_string(trim($_POST['id']));
	$name = $mysqli->escape_string(trim($_POST['name']));
	$device_kind_id = $mysqli->escape_string($_POST['device_kind_id']); 
	$brand = $mysqli->escape_string(trim($_POST['brand']));
	$price = $mysqli->escape_string((int)trim($_POST['price']));
	$info = $mysqli->escape_string(trim($_POST['info']));
	$picture = $mysqli->escape_string(trim($_POST['picture']));

    if(!$_POST['name'] || !$_POST['picture']){
    	$errorMessage = 'Някои полета са задължителни!';
	} else {	
		$picture=$picture.'.jpg';
  		if($id){
  			$query = "UPDATE devices SET "
					." name= ".($name?"'".$name."'":"NULL").", "
					." device_kind_id= ".($device_kind_id?"'".$device_kind_id."'":"NULL").", "
					." brand= ".($brand?"'".$brand."'":"NULL").", "
					." price= ".($price?"'".$price."'":"NULL").", "
					." picture= ".($picture?"'".$picture."'":"NULL").", "
					." info= ".($info?"'".$info."'":"NULL")
					." WHERE device_id=".$id." AND device_id>5";
  		} else { 
			$query = "INSERT INTO devices(name, device_kind_id, brand, price, picture, info) VALUES ("
					.($name?"'".$name."'":"NULL").", "
					.($device_kind_id?"'".$device_kind_id."'":"NULL").", "
					.($brand?"'".$brand."'":"NULL").", "
					.($price?"'".$price."'":"NULL").", "
					.($picture?"'".$picture."'":"NULL").", "
					.($info?"'".$info."'":"NULL")
					.")";	
		}
		$mysqli->query($query);
		$id = $id?$id:$mysqli->insert_id;
		$infoMessage = 'Операцията успешна!';
	}
  } else {} 
  
  	if($id) {
	  $query = "SELECT * FROM devices WHERE device_id=".$id;
	  $result = $mysqli->query($query);
	  if($row = $result->fetch_assoc()){
	  	$operation_type = 'Редактиране на Устройство';
	  	$name = $row['name'];
		$device_kind_id = $row['device_kind_id'];
		$brand = $row['brand'];
		$price = $row['price'];
		$info = $row['info'];
		$picture = $row['picture'];
	  }
	}

  $nav_path = ' / <a href="devices_edit.php">Устройства</a>'.' / '.$operation_type;
  $page_title = $operation_type.' - DeviceX';

require 'includes/header.inc';

print' <div align="center">';
    if($errorMessage){
		print'<div class="errorBlock">'.$errorMessage.'</div>';
	} 
	if($infoMessage){
		print'<div class="infoBlock">'.$infoMessage.'</div>';
	} 	

	if($_POST || $_REQUEST){  
	print'<form method="post" name="f" action="'.$_SERVER['PHP_SELF'].'" class="form">
		<input type="hidden" name="id" value="'.$id.'">
		<input type="hidden" name="picture" value="'.$picture.'">'; 
	       $small_pic = $device_pictires_dir.$device_pictires_small_prefix.$picture;
		   $small_pic_exists = file_exists($small_pic);
		   print $small_pic_exists?'<div class="form-row" style="text-align:center"><img src="'.$small_pic.'" title="" alt=""></div>':'';
	print'<div class="form-row">
	        <label for="name">* Име</label>
	        <input type="text" maxlength="64" name="name" id="name" value="'.htmlspecialchars(stripslashes($name)).'">
	    </div>
	    <div class="form-row">
	        <label for="device_kind_id">* Тип</label>
	        <select name="device_kind_id" id="device_kind_id">';
		          $query = 'SELECT * FROM device_kinds ORDER BY kind';
		          $result = $mysqli->query($query);
		          while($row = $result->fetch_assoc()){	
					$sel=''; 
					if($row['device_kind_id']==$device_kind_id){$sel=' selected';}
		             print'<option value="'.$row['device_kind_id'].'"'.$sel.'>'.htmlspecialchars(stripslashes($row["kind"])).'</option>';
		          }
	      	print'</select>
	    </div>
	    <div class="form-row">
	        <label for="brand">Марка</label>
	        <input type="text" maxlength="32" name="brand" id="brand" value="'.htmlspecialchars(stripslashes($brand)).'">
	    </div>
	    <div class="form-row">
	        <label for="price">Цена</label>
	        <input type="text" maxlength="4" name="price" id="price" value="'.htmlspecialchars(stripslashes($price)).'"> $
	    </div>';
		$picture=str_replace('.jpg','',$picture);
		print'<div class="form-row">
	        <label for="picture">* Снимка</label>
	        <input type="text" maxlength="64" name="picture" id="picture" value="'.htmlspecialchars(stripslashes($picture)).'"> .jpg
	    </div>		
	    <div class="form-row">	    
	    	<label for="info">Описание</label>   
	    </div>
	    <div class="form-row">
	        <textarea name="info" id="info">'.htmlspecialchars(stripslashes($info)).'</textarea>
	    </div>
	    <div class="form-row">
	        <input type="submit" name="submit" value="Запис">
	    </div>    
	</form>';
	} else {
	print'<form method="post" name="new" action="'.$_SERVER['PHP_SELF'].'" class="form">
		<input type="hidden" name="id" value="">
	    <div class="form-title">'.$operation_type.'</div>
	    <div class="form-row">
	        <label for="name">* Име</label>
	        <input type="text" maxlength="64" name="name" id="name" value="">
	    </div>
	    <div class="form-row">
	        <label for="device_kind_id">* Тип</label>
	        <select name="device_kind_id" id="device_kind_id">';
		          $query = 'SELECT * FROM device_kinds ORDER BY device_kind_id';
		          $result = $mysqli->query($query);
		          while($row = $result->fetch_assoc()){
		            print'<option value="'.$row['device_kind_id'].'">'.htmlspecialchars(stripslashes($row["kind"])).'</option>';
		          }
	      	print'</select>
	    </div>
	    <div class="form-row">
	        <label for="brand">Марка</label>
	        <input type="text" maxlength="32" name="brand" id="brand" value="Apple">
	    </div>
	    <div class="form-row">
	        <label for="price">Цена</label>
	        <input type="text" maxlength="4" name="price" id="price" value=""> $
	    </div>
		<div class="form-row">
	        <label for="picture">* Снимка</label>
	        <input type="text" maxlength="64" name="picture" id="picture" value="test"> .jpg
	    </div>
	    <div class="form-row">	    
	    	<label for="info">Описание</label>   
	    </div>
	    <div class="form-row">
	        <textarea name="info" id="info">Има готова снимка на iPhone 11 Pro.</textarea>
	    </div>
	    <div class="form-row">
	        <input type="submit" name="submit" value="Запис">
	    </div>    
		</form>';
	}
print'</div>';
require 'includes/footer.inc'; 
?>