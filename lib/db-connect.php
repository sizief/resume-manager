<?php
  	$link = new MySQLi($db_host, $db_username, $db_password, $db_database);
  	mysqli_set_charset($link, "utf8");


	 if (mysqli_connect_errno()){
      	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	 }
?>