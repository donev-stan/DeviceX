<?php 
print'
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<title>'.$page_title.'</title>
		<link rel="icon" href="images/logo.png">
    	<link href="styles/style.css" type="text/css" rel="stylesheet">
		<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    </head>
    <body>
    	<div align="center">
			<div id="main-box">	
    			<div id="nav-top">
    				<a href="." class="nav-top-a">Начало</a>';				
    					if(!isset($_SESSION['user_type'])){
							print '<span style="padding-left:820px;"><a href="login.php" class="nav-top-a">Вход</a></span>'; 		 		
						} else {
						if($_SESSION['user_type']==1){	
							print '<a href="devices_edit.php" class="nav-top-a">Устройства</a>
								   <a href="device_edit.php" class="nav-top-a">Ново Устройство</a>';						
						}
						print' <span style="padding-left:520px;"><a href="logout.php" class="nav-top-a">Изход</a></span>';
						}		
print'   		
				</div>
    			<div id="nav-side">';
				    $result = $mysqli->query("SELECT * FROM device_kinds");
				    while($row = $result->fetch_assoc()){
						print'<a href="devices.php?kindID='.$row['device_kind_id'].'" 
						   class="nav-side-a">'.htmlspecialchars(stripslashes($row['kind'])).'</a>';
				    } 
print'
    			</div>
    			<div id="content"> 
    				<div id="nav_path">
    					<a href=".">Начало</a>
    					 '.$nav_path.'
    				</div>';
?>