<?php 
	session_start();
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password=""; // Mysql password
	$encryptedPassword="";
	$db_name="msas_schema"; // Database name 
	$tbl_name="users"; // Table name 

	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");
	
	$mytitle=$_POST['title']; 
	$mymessage=$_POST['message'];
	
	$mytitle = stripslashes($mytitle);
	$mymessage = stripslashes($mymessage);
	$mytitle = mysql_real_escape_string($mytitle);
	$mymessage = mysql_real_escape_string($mymessage);

	$nowFormat = date('Y-m-d H:i:s');
	
	$sql= sprintf("INSERT INTO posts (title, message, datetime, Users_ID) VALUES ('%s','%s','%s','%s')", $mytitle, $mymessage, $nowFormat, $_SESSION['userID']);
	mysql_query($sql);

	header("location:home.php");

?>