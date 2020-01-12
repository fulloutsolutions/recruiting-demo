<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once('database.php');
require_once('functions.php');


require_once('header.php');

//TODO: GET CURRENT USER INFO
//$_SESSION['profilepic'] = "images/nopic.svg";


if (isset($_POST['SubmitProfilePic'])) {

		$target_dir = "images/profiles/";
		$target_file = $target_dir . basename($_FILES["profilepic"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
    $check = getimagesize($_FILES["profilepic"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }	
	

		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		} else {
		    if (move_uploaded_file($_FILES["profilepic"]["tmp_name"], $target_file)) {
		    	
		    	$imageSaved = saveProfilePic($_SESSION['userid'], $target_file);
		    	$_SESSION['profilepic'] = $target_file;
		    	
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}	
	

}


?>
<h4 class="uk-text-center">Edit Profile</h4>
<hr>
<div class="uk-section uk-section-default">
	<div class="uk-container uk-container-medium">
		<div>
			<img class="uk-border-pill uk-box-shadow-large" src="<?php echo $_SESSION['profilepic']; ?>" width="200" height="200" alt="Profile Pic">
		</div>	
		<form class="uk-form-stacked" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
			<div class="uk-margin" uk-margin>
				Select Profile Picture:<br>
				<div uk-form-custom="target: true">
					<input type="file" name="profilepic">
					<input class="uk-input uk-form-width-medium" type="text" placeholder="Select image file" disabled>
				</div>
				<button class="uk-button uk-button-default" value="submit" name="SubmitProfilePic">Submit</button>
			</div>				
		</form>

	</div>
</div>

<?php
require_once('footer.php');
?>
