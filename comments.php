<?php
session_start();

include 'connect.php';
	 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
if($_SESSION['signed_in'])
	{
		echo '
			<div id = "tablew">
			<form method="post" action="" class="container">
				
				<h2 style="color:white">Comment:</h2> <textarea type="text" name="user_comment" rows = "10" cols = "99"></textarea><br/>
				<br/>
				<input class = "smallbtn" type="submit" value="Submit" />
				  
			 </form>
			 <br/>';
	}
}

else{
	 $comment = $_POST['user_comment'];
	  $user = $_SESSION['user_name'] ;
	 

	 
	 $sql = "INSERT INTO comments VALUES( '$check', '$comment', '$user', NULL, NULL)";
	 
	                   
        if ($conn->query($sql) === TRUE) {
			echo '<br/>';
			
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	
}
			$test = $_SERVER['QUERY_STRING'];
			 parse_str($test);
			$sql = "SELECT postid, body, username, post_time, comment_id FROM comments WHERE postid = '$post_id'";
			
			$result2 = $conn->query($sql);

			if ($result2->num_rows > 0) {
				//$_SESSION['comment_id'] = $row['comment_id'];
				//$_SESSION['comment_body'] = $row['body'];
				echo '<table border="1" id = "tablew">';
				echo '<br/><tr><td><h3>Comments</h3></td></tr>';
					  
				while($row = $result2->fetch_assoc()) {
					/*echo '  <div class = "container">
							<br> Title: '. $row["title"]. ' 
							<br> Class: '. $row["class_id"]. ' 
							<br> Date Created: '. $row["timestamp"]. ' 
							</div>
						';*/
					
					//$_SESSION["favcolor"] = $check ;
					$commentid = $row['comment_id'];
					echo '<tr>';
						echo '<td>';
							echo $row['username'];
							
							echo '<br/>';
							echo  "<h5> " . $row['body']. "</h5>";
							echo '<br/>';
							echo'     ';
							echo $row['post_time'];
														echo '<br/>';
							if($_SESSION['signed_in'])
	{
							if  ($row['username'] == $_SESSION['user_name'] || $_SESSION['user_name'] == "admin" ){
								echo "<h5 class = 'container'><a href='editcomment.php?comment_id=".$commentid."' class = 'smallbtn'>Edit Comment</a></h5>";
							}
						}
						echo '</td>';
					echo '</tr>';
				}
			} else {
				echo "<p class = 'container'>0 Comments</p>";
			}
?>
