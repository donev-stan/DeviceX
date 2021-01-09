<?php 
require 'includes/init.inc'; 

$page_title = 'DeviceX';
$nav_path = NULL;
$kindID=1;

require 'includes/header.inc'; 
   $query = "SELECT devices.*, device_kinds.kind FROM devices 
             JOIN device_kinds ON devices.device_kind_id=device_kinds.device_kind_id "
  		     .($kindID?" WHERE devices.device_kind_id=".$kindID:"")." ORDER BY device_id DESC LIMIT 3";
  $result = $mysqli->query($query);
  $num_results = $result->num_rows;

  if($num_results>0){
	print'<table class="table-view"><tr>';
    $j=0;
    while($row = $result->fetch_assoc()){
	print'<td>';
		    $object_title = htmlspecialchars(stripslashes($row['name'].($row['brand']?', '.$row['brand']:'')));
			$small_pic = $device_pictires_dir.$device_pictires_small_prefix.$row['picture'];
			$small_pic_exists = file_exists($small_pic);
    print'
        <a href="device.php?id='.$row['device_id'].'">
        	<img class="img-device" src="'.$small_pic.'" alt="'.$object_title.'" title="'.$object_title.'">
        </a>              
        <h2 class="device-name">'.htmlspecialchars(stripslashes($row['name'])).'</h2>';
            if($row["brand"]){
			 print'<div class="device-brand">Brand: '.htmlspecialchars(stripslashes($row["brand"])).'</div>';
            }
            if($row["price"]){
           	 print'<div class="device-price">'.$row["price"].' $</div>';
            }
			print'<a href="device.php?id='.$row["device_id"].'" class="more-info">More Info</a>
    </td>';
	  $i=0;
	  if($j==2)
	  {
	    if(($i+1)<$num_results)
	      print '</tr><tr>';
		$j = 0;
	  }
	  else
	    $j++;  
	}
	print'</tr></table>';
 	
  }
require 'includes/footer.inc'; 
?>