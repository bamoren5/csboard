<?php
session_start();
//signup.php
include 'connect.php';
include 'main.html';
	
	
	//	if($_SESSION['signed_in'])
	//	{
			echo '<div class = "main">';
			echo '<h1 style ="color: white">Discussion Board</h1>';
			if($_SESSION['signed_in'])
		{
			echo "<p ><a href='post.php'><button class = 'crtbtn'>Create Post</button></a></p>";
			}
			
			$sql = "SELECT title, class_id, timestamp, post_id FROM discussions";
		
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo '
					<table  border="1">
					  <tr>
						<th id = "tablew" >Title</th>
						<th>Date Created</th>
					  </tr>'
					  ;
					  
				while($row = $result->fetch_assoc()) {
					/*echo '  <div class = "container">
							<br> Title: '. $row["title"]. ' 
							<br> Class: '. $row["class_id"]. ' 
							<br> Date Created: '. $row["timestamp"]. ' 
							</div>
						';*/
					
					$check = $row['post_id'];
					//$_SESSION["favcolor"] = $check ;
					echo '<tr>';
						echo '<td>';
							echo '<h3><a href="userpost.php?post_id='.$check.'">' . $row['title'] . '</a></h3>' . $row['class_id'];
						echo '</td>';
					   
						echo '<td>';
									echo $row['timestamp'] ;
						echo '</td>';
					echo '</tr>';
				}
			} else {
				echo "0 results";
			}
		
			//	}
				//else
				//{
					//echo '<a href="index.php">Sign in</a> or  <a href="signup.php">create an account</a>.';
				//}
		
?>

