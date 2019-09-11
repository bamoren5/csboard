<?php
session_start();
include 'connect.php';
include 'main.html';

	echo "</br></br><p id = 'tablew'><input class ='crtbtn' action='action' onclick='window.history.go(-1); return false;' type='button' value='Back' />";
	$post_id = htmlspecialchars($_GET["post_id"]);
	
	$sql = "SELECT title, body, username, class_id, timestamp, post_id FROM discussions WHERE post_id = '$post_id'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
              
		while($row = $result->fetch_assoc()) {			
			
			$check = $row['post_id'];
			$_SESSION['post_id'] = $check;
			$title = $row['title'];
			$userid = $row['username'];
			$_SESSION['userid2'] = $userid;
			$body = $row['body'];
			$_SESSION['body2'] = $row['body'];
			$date = $row['timestamp'];
			$class = $row['class_id'];
			
		
		echo "
			<table id = 'tablew'>
			
				<tr>
    
					<td> <h2>" . $title . "</h2> " . $date . " </br> " . $class . "  </br> " . $userid. "</br></br> </td>
				  </tr>
				<tr>
					
					<td>" . $body . "</td>
		       </tr>
			
			</table>
		";}
		if($_SESSION['signed_in'])
		{
		if  ($userid == $_SESSION['user_name'] || $_SESSION['user_name'] == "admin"){
								
		echo "<p id = 'tablew' ><a href='editpost.php'><button class = 'crtbtn'>Edit Post</button></a></p>";
		}
	}
		
		
	}

?>



		

<?php

include 'comments.php';
?>
