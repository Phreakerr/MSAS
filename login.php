<?php 
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password=""; // Mysql password
	$encryptedPassword="";
	$db_name="msas_schema"; // Database name 
	$tbl_name="users"; // Table name 

	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");
	
	$myusername=$_POST['username']; 
	$mypassword=$_POST['password'];
	
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	$encryptedPassword=md5($mypassword);
	$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$encryptedPassword'";
	$result=mysql_query($sql);
	
	$count=mysql_num_rows($result);
	
	if($count==1)
	{
		session_start();
		$row = mysql_fetch_array($result);
		$_SESSION['loggedIn']=true;
		$_SESSION['username']=$row['username'];
		$_SESSION['userType']=$row['type'];
		$_SESSION['userID']=$row['ID'];
		header("location:home.php");		
	}
	else
	{
		header("location:index.php?status=0");
	}
?>