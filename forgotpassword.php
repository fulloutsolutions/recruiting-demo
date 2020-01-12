<?php
require_once('database.php');
require_once('functions.php');


if (isset($_POST['submit'])) {
	$submitted=TRUE;
	$emailaddr = htmlspecialchars($_POST['emailaddr']);
		
	if (emailExists($emailaddr)){
		
			$emailError 	= FALSE;
			$newpassword 	= randomPassword();
			$username 		= getUsernameByEmail($emailaddr);
			$updateStatus = resetPassword($username,$newpassword);
			$resetFailed 	= FALSE;
			
			if ($updateStatus){

					$msg = "<h4>Full Out Recruiting Password Reset</h4>" .
								 "<p>Your username is : " . $username . "</p>".
								 "<p>Your Temporary Password is : ". $newpassword . "</p>".
								 "<p>You will be required to change your password uponn logging in. </p>".
								 "<p>Thank you. </p>";

					$status = sendemail($emailaddr, "Full Out Recruiting Password Reset", "Info@fulloutrecruiting.com", $msg);
					
					if (!$status){
						$resetFailed=TRUE;
					}
			}else{
					$resetFailed=TRUE;
			}
	}
	else{	
		$emailError = TRUE;
	}

}

require_once('header.php');


?>

<div class="uk-section uk-section-primary">
		<div class="uk-text-center">
			<?php if ($submitted == TRUE && $resetFailed != TRUE){
				echo "<h3>You should receive an email with your temporary password.</h3>";
			}
			else{
				
			?>
    				<h4>Forgot Username / Password</h4>
    				<?php
    					if($emailError) echo '<p><span style="color:black;">The email address was not found.</span></p>';
    					if($resetFailed) echo '<p><span style="color:black;">There was an error resetting your password.</span></p>';
    				?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" id="login">
                <div class="uk-margin">
                    <div class="uk-inline">
                        <label class="uk-form-label" for="form-stacked-text">What is your email address?</label>	
                        <input name="emailaddr" placeholder="Email" class="uk-input" type="text" required>
                    </div>
                </div>    	
                <button name="submit" class="uk-button uk-button-default">Submit</button>
            </form>    	
            
    	<?php } ?>
		</div>
</div>


<?php
require_once('footer.php');
?>
