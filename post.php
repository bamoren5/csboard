<?php
session_start();
//signup.php
include 'connect.php';
include 'main.html';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
      note that the action="" will cause the form to post to the same page it is on */
    echo '
    <h1 class="main" style = "color: white; margin-bottom:-75px;">Create Post</h1>
    <form method="post" action="" class="main">
        <input type="text" name="class" placeholder="Class ID"/><br/> <br/>
        <input type="text" name="user_title" placeholder="Title"/><br/><br/>
        <textarea type="text" name="user_body" rows = "20" cols = "50" placeholder="Body"></textarea><br/>
        <input type="submit" value="Submit" />
     </form>';
}
else
{
   
    
        //the form has been posted without, so save it
        //notice the use of mysql_real_escape_string, keep everything safe!
        //also notice the sha1 function which hashes the password
        $title = $_POST['user_title'];
        $body = $_POST['user_body'];
        $id = $_SESSION['user_name'];
        $class = $_POST['class'];
        $sql = "INSERT INTO discussions VALUES('$title', '$body', '$id', '$class', NULL, NULL)";
        
                         
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
?>


