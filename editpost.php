<?php
session_start();
//signup.php
include 'connect.php';
include 'main.html';

$yyy= $_SESSION['body2'];


if($_SERVER['REQUEST_METHOD'] != 'POST')
{

    echo "
    <br/>
	<span class = 'main'><input class ='crtbtn' action='action' onclick='window.history.go(-1); return false;' type='button' value='Back' /> </span>
	
    <h1 class='main' style = 'color: white; margin-top: -20px; margin-bottom:-70px;'>Edit Post</h1>
    <form method='post' action='' class='main'>
    <textarea type='text' name='new_post' rows = '30' cols = '150'>".$yyy."</textarea><br/>
    <br/>
    <input class ='crtbtn' type='submit' value='Submit' />
     </form>";
}
else
{

        $body=  $_POST['new_post'];
		$update = $_SESSION['post_id'];
		if( $body == $yyy || !isset($body) ){
			echo 'You have to make at least one change to the post or not leave the space blank.';
		}
		else{
        
        $sql = "UPDATE discussions SET body = '$body' WHERE post_id = '$update'";
        
                         
        if ($conn->query($sql) === TRUE) {
			
        
			echo "<p class = 'container'>New post added successfully</p>";
			echo "<p class = 'container'><a href='board.php'><button>Go Home</button></a></p>";
			/*$sql = "SELECT username, email FROM users2";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<br> Username: ". $row["username"]. " - Email: ". $row["email"]. " " ;
				}
			} else {
				echo "0 results";
			}*/
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
       
    }
}

?>
