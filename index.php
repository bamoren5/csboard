<?php
session_start();
//signup.php
include 'connect.php';
include 'initial.html';

//echo "<div class = 'container'><h3><span class='glyphicon glyphicon-user'> Log In</span></h3></div></br>
              //  ";
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
      note that the action="" will cause the form to post to the same page it is on */
    echo '

    <div class="login">
		<div class ="test">
		
			<form method="post" action="">
				<input type="text" name="user_name" placeholder="Username"/><br/><br/>
         <input type="password" name="user_pass" placeholder="Password"><br/><br/>
				<input type="submit" value="Sign In" />
			 </form>
			 <a href="signup.php"><button class="logbtn">Sign Up</button></a>
			 <a href="board.php"><button class="logbtn">Guest</button></a><br/><br/>
			 <a href="forgot.php" class = "loglink">Forgot Your Password/Username?</a>
			 
			 
		 </div>
     </div>
     
     
     ';
}
else
{
		$required = array('user_name', 'user_pass');

		// Loop over field names, make sure each one exists and is not empty
		$error = false;
		foreach($required as $field) {
		  if (empty($_POST[$field])) {
			$error = true;
		  }
		}

		if ($error) {
		  echo '<div class="login">
		<div class ="test">
		All fields are required.<br/>
		<input type="button" class="logbtn" value="Go Back" onClick="location.href=location.href">

		</div>
		</div>';
		  /*echo '<div id="LogIn" class="tabcontent">
			<p>All fields required.</p>
		  </div>';*/
		}
    
    else
    {
        //the form has been posted without, so save it
        //notice the use of mysql_real_escape_string, keep everything safe!
        //also notice the sha1 function which hashes the password
        $user = $_POST['user_name'];
        $pass = $_POST['user_pass'];
        $sql = "SELECT user_id, username, pass, user_type_id FROM users WHERE username = '$user' AND pass = '$pass'";
        $result = $conn->query($sql);
                         
        if ($result->num_rows > 0) {
			//the query was successfully executed, there are 2 possibilities
                //1. the query returned data, the user can be signed in
                //2. the query returned an empty result set, the credentials were wrong
                
                    //set the $_SESSION['signed_in'] variable to TRUE
                    $_SESSION['signed_in'] = true;
                     
                    //we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
                    while($row = $result->fetch_assoc())
                    {
                        $_SESSION['user_id']    = $row['user_id'];
                        $_SESSION['user_name']  = $row['username'];
                        $_SESSION['user_type_id'] = $row['user_type_id'];
                    }
                     
                   // echo 'Welcome, ' . $_SESSION['user_name'] . '. <a href="board.php">Proceed to the forum overview</a>.';
                   echo '<script>window.location.href = "http://www.thecsboard.com/board.php";
</script>';
                
		} else {
			echo '<div class="login">
		<div class ="test">
		User Doesnt Exist<br/> or Wrong Username/Password<br/>
		<input type="button" class="logbtn" value="Go Back" onClick="location.href=location.href">
		<a href="signup.php"><button class="logbtn">Sign Up</button></a>

		</div>
		</div>';
		}
       
    }
}

	//echo "<p class = 'container'><a href='signup.php'><button>Sign Up</button></a></p>";


?>
