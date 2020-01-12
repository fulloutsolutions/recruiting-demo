<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

//---------------------------------------------------------------
// CONNECT TO DATABASE
//---------------------------------------------------------------
function connect_to_db(){
  //$conn = mysqli_connect("localhost", "delvecc_FOR", "dOy7xKmLL(RP", "delvecc_forecruiting");

  $conn = mysqli_connect("del-vecchio.com", "delvecc_FOR", "dOy7xKmLL(RP", "delvecc_forecruiting");
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  return $conn;
}

//---------------------------------------------------------------
// CLOSE CONNECTION TO DATABASE
//---------------------------------------------------------------
function close_connection($connection){
	mysqli_close($connection);
}


//---------------------------------------------------------------
// REGISTER NEW USER
//---------------------------------------------------------------
function register_user($data){

	$conn = connect_to_db();

	$firstname  = htmlspecialchars($data['firstname']);
	$lastname   = htmlspecialchars($data['lastname']);
	$username   = htmlspecialchars($data['username']);
	$emailaddr  = htmlspecialchars($data['email']);
	$password   = sha1($data['password']);
	$usertype   = htmlspecialchars($data['usertype']);
	$verifycode = sha1($username);
	$_SESSION['verifycode'] = $verifycode;

	$sql = "INSERT INTO `USER` ".
	"(`firstname`, `lastname`, `username`, `password`, `emailaddr`,`status`,`usertype`,`createdate`, `verifycode`) ".
	"values ('$firstname','$lastname','$username','$password','$emailaddr',0, $usertype, now(), '$verifycode')";


	if (!mysqli_query($conn, $sql)) {
			echo("Error description: " . mysqli_error($conn));
			return FALSE;
	}else{

			close_connection($conn);
			return TRUE;
	}
}

//---------------------------------------------------------------
// CHECK IF USERNAME OR EMAIL ALREADY EXISTS
//---------------------------------------------------------------
function usernameInUse($username, $emailaddr){

	$conn = connect_to_db();

	$sql = "SELECT * FROM `USER` WHERE `username`='".$username."' OR `emailaddr`='".$emailaddr."';";

	$result = mysqli_query($conn, $sql);

	if ($result && mysqli_num_rows($result) > 0){
		return TRUE;
	}

	close_connection($conn);
	return FALSE;
}

//---------------------------------------------------------------
// LOAD IMAGES
//---------------------------------------------------------------

function loadUserImages($userid){

	$conn = connect_to_db();

	$sql = "SELECT * from `IMAGES` where `userid`=".$userid.";";

	$result = mysqli_query($conn, $sql);

	if ($result && mysqli_num_rows($result) < 1){

		$_SESSION['profilepic'] = "images/nopic.svg";

	}else{

		$row = mysqli_fetch_assoc($result);
		$_SESSION['profilepic'] 	= $row['profilepic'];
		$_SESSION['image1'] = $row['image1'];
		$_SESSION['image2'] = $row['image2'];
		$_SESSION['image3'] = $row['image3'];
		$_SESSION['image4'] = $row['image4'];
		$_SESSION['image5'] = $row['image5'];

	}

	close_connection($conn);
}

//---------------------------------------------------------------
// CHECK LOGIN INFORMATION
//---------------------------------------------------------------

function checkLogin($username, $password){

	$pwd = sha1($password);

	$conn = connect_to_db();

	$sql = "SELECT * from `USER` where `username`='".$username."' AND `password`='".$pwd."';";
	$result = mysqli_query($conn, $sql);

	if ($result && mysqli_num_rows($result) < 1){

		$_SESSION['loggedin'] = FALSE;

	}else{

		$row = mysqli_fetch_assoc($result);
		$_SESSION['userid'] 	= $row['userid'];
		$_SESSION['status'] 	= $row['status'];
		$_SESSION['usertype'] = $row['usertype'];
		$_SESSION['usersince'] = $row['createdate'];
		$_SESSION['firstname'] = $row['firstname'];
		$_SESSION['lastname'] = $row['lastname'];

    $_SESSION['loggedin'] = TRUE;

	}

	close_connection($conn);

}

//---------------------------------------------------------------
// CHECK EMAILADDRESS EXISTS
//---------------------------------------------------------------

function emailExists($emailaddr){

	$conn = connect_to_db();

	$sql = "SELECT * FROM `USER` WHERE `emailaddr`='".$emailaddr."';";

	$result = mysqli_query($conn, $sql);

	if ($result && mysqli_num_rows($result) > 0){
		close_connection($conn);
		return TRUE;
	}

	close_connection($conn);
	return FALSE;

}

//---------------------------------------------------------------
// GET USERNAME FROM EMAIL
//---------------------------------------------------------------

function getUsernameByEmail($emailaddr){

	$conn = connect_to_db();

	$sql = "SELECT `username` FROM `USER` WHERE `emailaddr`='".$emailaddr."';";

	$result = mysqli_query($conn, $sql);

	if ($result && mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);

			close_connection($conn);

			return $row['username'];
	}else{

			close_connection($conn);

			return "<NOT FOUND>";
	}

}


//---------------------------------------------------------------
// UPDATE PASSWORD
//---------------------------------------------------------------

function resetPassword($username,$newpassword){

	$conn = connect_to_db();

	$sql = "UPDATE `USER` SET `password`='".$newpassword."', `resetpassword`=1 WHERE `username`='".$username."';";

	$result = mysqli_query($conn, $sql);

	if(mysqli_affected_rows($conn) > 0 ){
		close_connection($conn);
		return TRUE;
	}else{
		close_connection($conn);
		return FALSE;
	}

}


//---------------------------------------------------------------
// VERIFY EMAIL CODE
//---------------------------------------------------------------

function verifyCode($verifycode,$username){

	$conn = connect_to_db();

	$sql = "SELECT * from `user` where `username`='".$username."' AND verifycode='".$verifycode."';";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0){

			$sql = "UPDATE `USER` SET `status`= 1 WHERE `username`='".$username."';";

			$result = mysqli_query($conn, $sql);

			close_connection($conn);

			return TRUE;
	}else{
			close_connection($conn);
			return FALSE;
	}
}


//---------------------------------------------------------------
// SAVE PROFILE PIC
//---------------------------------------------------------------

function saveProfilePic($userid, $image){

    //error_log("Saving ".$image." as profile for user ".$userid."\n", 3, "error.log");

	$conn = connect_to_db();

	$sql = "SELECT * from `IMAGES` where `userid`=".$userid.";";

	$numrows = 0;
	$result = mysqli_query($conn, $sql);
	$numrows = mysqli_num_rows($result);


	if ($numrows > 0){

		//error_log("Updating pic for user ".$userid."\n", 3, "error.log");
		$updatesql = "UPDATE `IMAGES` SET `profilepic`='".$image."' WHERE `userid`=".$userid.";";

	}else{

	    //error_log("Inserting pic for user ".$userid."\n", 3, "error.log");
		$updatesql = "INSERT INTO `IMAGES` (`userid`, `profilepic`) VALUES ($userid,'$image');";
	}

	$result = mysqli_query($conn, $updatesql);

	close_connection($conn);
	return TRUE;

}

?>
