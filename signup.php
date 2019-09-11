<?php
session_start();
//signup.php
include 'connect.php';
include 'initial.html';

//echo "<div class = 'container'><h3><span class='glyphicon glyphicon-user'>Register</span></h3></div></br>";
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
      note that the action="" will cause the form to post to the same page it is on */
    echo '
     <div class="login">
		<div class ="test"><br/><br/><br/><br/><br/><br/><br/><br/>
    <form method="post" action="" class="container">
        <input type="text" name="user_name" placeholder="Username"/><br/><br/>
         <input type="password" name="user_pass" placeholder="Password"><br/><br/>
        <input type="password" name="user_pass_check" placeholder="Password Again"><br/><br/>
        <input type="text" name="user_firstname" placeholder="First Name"/><br/><br/>
        <input type="text" name="user_lastname" placeholder="Last Name"/><br/><br/>
        <input type="text" name="user_email" placeholder="Email"><br/><br/>
        <input type="text" name="user_dob" placeholder="DOB(yyyy-mm-dd)"><br/><br/>
        <input type="submit" value="Submit" />
     </form>
     </div>
     </div>
     
     ';
}
else
{
    $required = array('user_name', 'user_pass', 'user_pass_check', 'user_firstname', 'user_lastname', 'user_email', 'user_dob');

		// Loop over field names, make sure each one exists and is not empty
		$error = false;
		foreach($required as $field) {
		  if (empty($_POST[$field])) {
			$error = true;
		  }
		  else if ($user_pass != $user_pass_check){
			$error = true;
			echo 'Hello';
		  }
		}

		if ($error) {
		  echo "All fields are required.";
		}
   

    else
    {
        //the form has been posted without, so save it
        //notice the use of mysql_real_escape_string, keep everything safe!
        //also notice the sha1 function which hashes the password
        $user = $_POST['user_name'];
        $pass = $_POST['user_pass'];
        $firstname = $_POST['user_firstname'];
        $lastname = $_POST['user_lastname'];
        $email = $_POST['user_email'];
        $dob = $_POST['user_dob'];
        
        
        $sql = "INSERT INTO users VALUES(NULL, 1, '$user', '$pass', '$firstname', '$lastname', '$email', CURDATE(), '$dob')";
        //$results = $conn->query($sql);
                         
        if ($conn->query($sql) === TRUE) {
			echo "New user added successfully";
			echo 'Welcome, ' . $_POST['user_name'] . '. <a href="index.php">Proceed to the sign in page</a>.';
			/*$sql = "SELECT username, email FROM users";
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
