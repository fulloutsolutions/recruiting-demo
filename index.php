<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
	require_once('database.php');
	require_once('functions.php');
	
$emailVerifyFailed = FALSE;
if (!empty($_GET['verify'])) {
	$emailVerifyFailed = TRUE;
}

//---------------------------------------------------------------
// PERFORM LOGIN
//---------------------------------------------------------------
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
  $_SESSION['loggedin'] = FALSE;
  $_SESSION['newmail']  = '';
  $_SESSION['username'] = trim($_POST["username"]);
  $_SESSION['password'] = trim($_POST["password"]);
  
	$loginFailed = FALSE;
	
  checkLogin($_SESSION['username'],$_SESSION['password']);

  if ($_SESSION['loggedin']){
					header("Location: home.php", 301);
					exit();	
  }else{
  		$loginFailed = TRUE;
  		$loginFailedReason = "Username/Password Incorrect";
  }
  

}

//---------------------------------------------------------------
// RESEND VERIFICATION EMAIL
//---------------------------------------------------------------
$emailstatus="Not Sent";

if (isset($_POST['resendverification'])){

			$msg = "<h4>Thank you for registering with Full Out Recruiting!</h4>" .
			"Please verify your account by clicking on the following link <p>" .
			"<a href='https://del-vecchio.com/websites/fulloutrecruiting/verify.php?id=" .
			$_SESSION['verifycode']."'>Verify Email </a> <p>".
			"Thanks again!";

			$emailVerifyFailed = FALSE;
			$status = sendemail($email, "Full Out Recruiting Registration", "Registration@fulloutrecruiting.com", $msg);

			if (!$status) $emailVerifyFailed = TRUE;

}


include_once('header.php');
?>
<div class="uk-section uk-section-primary uk-background-fixed">

<!--<div class="uk-section uk-section-primary uk-background-fixed" style="background-image: url(images/cja2.jpg);padding-bottom:150px;background-size: cover;">
-->    
	<div class="uk-container uk-container-expand">

      <div class="uk-child-width-expand@m uk-text-center" uk-grid>
           <?php
             if ($_SESSION["loggedin"]==FALSE){
           ?>
          <div class="uk-card uk-card-primary uk-card-body uk-margin-left" style="background: rgba(0, 0, 0, 0.85);">
            <h3 class="uk-card-title">Why Full Out Recruiting</h3>
            <p class="uk-text-left">For years, other athletes in other sports have been recruited by colleges, so why
            not cheer and dance? Our goal is to change that. Rather than colleges waiting to see
            who shows up for tryouts, we give them the opportunity to find talent around the country,
            and to reach out an invite them to the tryouts directly. We also give the athletes the
            opportunity to build a profile to showcase your skills, and to notify colleges that you're
            interested in their program.</p>
          </div>
					<?php } ?>
          <div class="uk-card uk-card-primary uk-card-body uk-margin-left" style="background: rgba(0, 0, 0, 0.85);">
            <?php
              if ($_SESSION["loggedin"]==TRUE){
            ?>
                <h3 class="uk-card-title"> <?php echo $_SESSION["firstname"]; ?>, you are logged in. </h3>
                <p class="uk-text-center">
                  Create or Update your Profile.
                  Then share your profile with college coaches!
                </p>
                <?php if ($_SESSION['status']=='Pending'){ 
                	if ($emailVerifyFailed){ ?>
                <p class="uk-text-left">The attempt to send a verification to your email address has failed.</p>
                <?php		
                	}	
                ?>
                
                <p class="uk-text-left">
                	Until you verify your email address, your access and functionality will be limited. Press the button
                	below to resend the verification email.
                </p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="resend">
                	<button name="resendverification" class="uk-button uk-button-default">Resend Email</button>
              	</form>
              	<p><?php if ($emailstatus != "Not Sent") echo $emailstatus; ?></p>
              <?php } ?>
            <?php
              }else{
            ?>
            <h3 class="uk-card-title">Login</h3>
						<?php
						if ($loginFailed){ ?>
							<p style="color:red;">Login Failed.<br><?php echo $loginFailedReason;?></p>
						<?php }?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="login">
                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                        <input name="username" placeholder="Username" class="uk-input" type="text" required>
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon uk-form-icon" uk-icon="icon: lock"></span>
                        <input name="password" placeholder="Password" class="uk-input" type="password" required>
                    </div>
                </div>
                <button name="login" class="uk-button uk-button-default">Submit</button>
            </form>

            <p> Or <a href="registration.php">Register</a> </p>
            <p><a href="forgotpassword.php"><span style="color:grey;font-size:.8em;">Forgot Username and/or Password</span></a></p>
            <?php } ?>
          </div>

      </div>

    </div>
</div>



<?php
include_once('footer.php');
?>
