<!DOCTYPE html>
<?php session_start();
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password=""; // Mysql password

	$linkcon = mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("msas_schema", $linkcon)or die("cannot select DB1"); ?>
	
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
	<?php
		if(empty($_SESSION))
		{
			header("location:index.php");
		}
	?>
		<div align = "center">
			<div align = "center">
				<h1><a href="home.php" target="_blank"> <img src="Untitled.png"></a></h1>
			</div>

			<?php
			$getPostsQuery = sprintf('SELECT * FROM users_has_posts WHERE Users_ID = %s', $_SESSION['userID']);
			$linkresult=mysql_query($getPostsQuery);
			
			if (!$linkresult)
			{
				die('Invalid query: ' . mysql_error());
			}
			else
			{
				while($row = mysql_fetch_array($linkresult))
				{
					$getSingleQuery = sprintf('SELECT * FROM posts WHERE ID = %s', $row['Posts_ID']);
					$singleresult=mysql_query($getSingleQuery);
					$singlerow = mysql_fetch_array($singleresult);
					echo '<div id ="newBox">';
					echo sprintf('<p class = "title">%s</p> <p class = "replies">replies</p><br><br><br> <p class = "message">%s</p>', $singlerow['Title'], $singlerow['Message']);
					echo "</div>";
				}
			}
			?>
		</div>
	</body>
</html>