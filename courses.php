<?php
session_start();
//signup.php
include 'connect.php';
include 'main.html';
	
	
	//	if($_SESSION['signed_in'])
	//	{
			echo '<div class = "main">';
			echo '<h1 style ="color: white">Courses</h1>';
			
			
			$sql = "SELECT class_id, class_name, description FROM courses";
		
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo '
					<table  border="1">
					  <tr>
					    <th>Class Name</th>
						<th id = "tablew" >Description</th>
					  </tr>'
					  ;
					  
				while($row = $result->fetch_assoc()) {
					$check = $row['class_id'];
					echo '<tr>';
						echo '<td>';
							echo '<h3><a href="filter.php?class_id='.$check.'">' . $row['class_name'] . '</a></h3>' . $row['class_id'];
						echo '</td>';
					   
						echo '<td>';
									echo $row['description'] ;
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


