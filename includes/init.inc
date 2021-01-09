<?php 
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'devices'); 

$mysqli->set_charset('utf8'); 

$device_pictires_dir = 'images/';
$device_pictires_small_prefix = 'small_';
?>