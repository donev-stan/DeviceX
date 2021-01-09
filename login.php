<?php 
require 'includes/init.inc';
	$errorMessage = NULL;
	$page_title = 'DeviceX - Вход';
	$nav_path = ' / <a href="'.$_SERVER['PHP_SELF'].'">Вход</a>';
	
	if($_POST){
	  $_POST['username'] = $mysqli->escape_string(trim($_POST['username']));
	  $_POST['pass'] = $mysqli->escape_string(trim($_POST['pass']));
	  $query = "SELECT * FROM users WHERE username='".$_POST['username']."' AND pass='".$_POST['pass']."'";
	  $result = $mysqli->query($query);
	  if($row = $result->fetch_assoc() ) {
		 $_SESSION['user_type'] = $row['user_type'];		
	  	 header("Location: index.php");
		 exit;
	  } else {  
	  $errorMessage = 'Грешно име или парола!';
	  }
	}	
	
	require 'includes/header.inc';	

print'<div align="center">';
	
	if($errorMessage!=NULL){
		print'<div class="errorBlock">'.$errorMessage.'</div>';
	}

	print'<form method="post" action="'.$_SERVER['PHP_SELF'].'" class="form">
	    <div class="form-title">Вход</div>
	    <div class="form-row">
	        <label for="usernameid">Username</label>
	        <input type="text" maxlength="16" name="username" id="usernameid" value="admin">
	    </div>
	    <div class="form-row">
	        <label for="passid">Password</label>
	        <input type="password" maxlength="16" name="pass" id="passid" value="admin">
	    </div>
	    <div class="form-row">
	        <input type="submit" name="submit" value="Вход">
	    </div>    
	</form>

</div>';
require 'includes/footer.inc'; 
?> 