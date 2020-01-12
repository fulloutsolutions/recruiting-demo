<?php
	if(session_status() !== PHP_SESSION_ACTIVE) session_start();
	require_once('database.php');
	require_once('functions.php');
	
	$usertype = '';
	
//---------------------------------------------------------------
// PERFORM REGISTRATION
//---------------------------------------------------------------
if (isset($_POST['register'])) {
	$isError = FALSE;
	$errorReason = "";
	$isRegsitered = FALSE;
	$firstname  = htmlspecialchars($_POST['firstname']);
	$lastname   = htmlspecialchars($_POST['lastname']);
	$username   = htmlspecialchars($_POST['username']);
	$email      = htmlspecialchars($_POST['email']);
	$password   = htmlspecialchars($_POST['password']);
	$password2  = htmlspecialchars($_POST['password2']);
	$usertype		= htmlspecialchars($_POST['usertype']);
	

	//Check that passwords match
	if ($password != $password2){
			$isError = TRUE;
			$errorReason .= "Passwords Do Not Match.<br>";
	}
	
	if (strlen($password) < 8){
			$isError = TRUE;
			$errorReason .= "Password is too short (8 char minimum).<br>";
	}
	
	// Check the username isn't already used
	if (usernameInUse($username,$email)) {
	 	 $isError = TRUE;
	 	 $errorReason .= "Username and/or Email is already in use.<br>";
	}
	
	// Remove all illegal characters from email
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);

	// Validate e-mail
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$isError = TRUE;
	    $errorReason .= "Not a Valid Email Format.<br>";
	}
	
	if ($isError == FALSE )
	{
			//Register new user, send verification email.
			$isRegistered = register_user($_POST);

			$msg = "<h4>Thank you for registering with Full Out Recruiting!</h4>" .
			"Please verify your account by clicking on the following link <p>" .
			"<a href='https://del-vecchio.com/websites/fulloutrecruiting/verify.php?id=" .
			$_SESSION['verifycode']."'&user='".$_SESSION['username']."'>Verify Email </a> <p>".
			"Thanks again!";

			$status = sendemail($email, "Full Out Recruiting Registration", "Registration@fulloutrecruiting.com", $msg);

			$emailFailed ="";
			if (!$status){
				$emailFailed .= "Verification Email Failed.";
			}
					
			if ($isRegistered == TRUE){
					// Allow user to login with limited access until verified
					$_SESSION['loggedin'] = TRUE;
					$_SESSION['username'] = $username;
					$_SESSION['status'] = "Pending";
					$_SESSION['firstname'] = $firstname;

					header("Location: index.php?verify=".$emailFailed, true, 301);
					exit();
			}else{
					$isError = TRUE;
					$errorReason = "Registration Failed. <br>";
			}
	}
}


include_once('header.php');
?>

<!--<div class="uk-section uk-section-primary uk-background-fixed" style="background-size: cover;background-image: url(images/cja2.jpg);padding-bottom:100px;">
-->
<div class="uk-section uk-section-primary uk-background-fixed">
	<div class="uk-container uk-container-expand">

		<div class="uk-text-left uk-flex uk-flex-center" >

			<div class="uk-card uk-card-primary" style="background: rgba(0, 0, 0, 0.85);">
				<div class="uk-card-body">
					<h3 class="uk-card-title uk-text-center"><?php if (isset($errorReason)) echo '<span style="color:red;font-size:0.7em;">'.$errorReason.'</span><br>'; ?>Register</h3>
					<form class="uk-form-stacked" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" name="register">
						<div class="uk-flex-center" uk-grid>
							<div>
								<div class="uk-margin">
										<label class="uk-form-label" for="form-stacked-text">First Name</label>								
										<div class="uk-form-controls">
											<input name="firstname"  <?php if (isset($_POST['firstname'])) echo 'value="'.$_POST['firstname'].'"'; ?>  placeholder="First Name" class="uk-input" type="text" required>
										</div>
								</div>
								<div class="uk-margin">
										 <label class="uk-form-label" for="form-stacked-text">Last Name</label>
										 <div class="uk-form-controls">
											<input name="lastname" <?php if (isset($_POST['lastname'])) echo 'value="'.$_POST['lastname'].'"'; ?> placeholder="Last Name" class="uk-input" type="text" required>
										 </div>
								</div>
								<div class="uk-margin">
										 <label class="uk-form-label" for="form-stacked-text">Username</label>
										 <div class="uk-form-controls">
											<input name="username" <?php if (isset($_POST['username'])) echo 'value="'.$_POST['username'].'"'; ?> " placeholder="Username" class="uk-input" type="text" required>
										 </div>
								</div>
							</div>
							<div>
								<div class="uk-margin">
										 <label class="uk-form-label" for="form-stacked-text">Email Address</label>
										 <div class="uk-form-controls">										 
											<input name="email" <?php if (isset($_POST['email'])) echo 'value="'.$_POST['email'].'"'; ?> placeholder="Email" class="uk-input" type="text" required>
										 </div>
								</div>
								<div class="uk-margin">
										 <label class="uk-form-label" for="form-stacked-text">Password <span style="font-size:0.8em;color:gray;">(8 character minimum)</span></label>
										 <div class="uk-form-controls">												 
											<input name="password" <?php if (isset($_POST['password'])) echo 'value="'.$_POST['password'].'"'; ?> placeholder="Password" class="uk-input" type="password" required>
										 </div>
								</div>
								<div class="uk-margin">
										 <label class="uk-form-label" for="form-stacked-text">Repeat Password</label>
										 <div class="uk-form-controls">		
											<input name="password2" <?php if (isset($_POST['password2'])) echo 'value="'.$_POST['password2'].'"'; ?> placeholder="Repeat Password" class="uk-input" type="password" required>
										</div>
								</div>
							</div>
						</div>
							<div class="uk-flex-center" uk-grid>
								<div>
			            <label><input class="uk-radio" type="radio" name="usertype" value="2" <?php if ($usertype==2) echo "checked"; ?>> Athlete</label>
			            <label><input class="uk-radio" type="radio" name="usertype" value="1" <?php if ($usertype==1) echo "checked"; ?>> Coach </label>
								</div>
							</div>
							<div class="uk-flex-center" uk-grid>
								<div>
									<button name="register" value="TRUE" class="uk-button uk-button-default">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>

<?php
include_once('footer.php');
?>
