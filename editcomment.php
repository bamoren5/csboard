<?php
session_start();
//signup.php
include 'connect.php';
include 'main.html';

$comment_id = htmlspecialchars($_GET["comment_id"]);


if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	$getcomment = "SELECT body FROM comments WHERE comment_id = '$comment_id'";
	$result = $conn->query($getcomment);

	while($row = $result->fetch_assoc()) {
		$comment_body = $row['body'];
    /*the form hasn't been posted yet, display it
      note that the action="" will cause the form to post to the same page it is on */
    echo "
    <br/>
    	<span class = 'main'><input class ='crtbtn' action='action' onclick='window.history.go(-1); return false;' type='button' value='Back' /> </span>

        <h1 class='main' style = 'color: white; margin-top: -20px; margin-bottom:-70px;'>Edit Comment</h1>

    <form class='main' method='post' action='' >
    <textarea type='text' name='new_comment' rows = '10' cols = '99'>".$comment_body."</textarea><br/>
    <br/>
    <input class ='crtbtn' type='submit' value='Submit' />
     </form>";
 
 }
}
else
{
   
    
        //the form has been posted without, so save it
        //notice the use of mysql_real_escape_string, keep everything safe!
        //also notice the sha1 function which hashes the password
        $body=  $_POST['new_comment'];
		$update = $_SESSION['comment_id'];
		if( $body == $yyy || !isset($body) ){
			echo 'You have to make at least one change to the post or not leave the space blank.';
		}
		else{
        
        $sql = "UPDATE comments SET body = '$body' WHERE comment_id = '$comment_id'";
        
                         
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
