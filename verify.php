<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once('database.php');

if (isset($_GET['id']) && isset($_GET['user'])) {
	
		$verifycode = $_GET['id'];
		$username 	= $_GET['user'];
		
		$status = verifyCode($verifycode,$username);
		
	
}else{
		// If there's no id and user variable, you shouldn't be here
		session_destroy(); 
		header("location:index.php");
		exit();	
}

require_once('header.php');


if ($status){
	
	if($_SESSION['loggedin']==1){
		 $_SESSION['status']=1;
	}
?>
<div class="uk-section uk-section-primary">
		<div class="uk-text-center">
			<h4>Thank you!  You are now a verified member! Please login if you haven't already</h4>
		</div>
</div>

<?php

}else{
?>	
	
<div class="uk-section uk-section-primary">
		<div class="uk-text-center">
			<h4>We're Sorry.  That is not a valid verification code. Please request another validation email. </h4>
		</div>
</div>	
	
<?php	
}

require_once('footer.php');
?>
