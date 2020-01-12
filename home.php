<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
	require_once('database.php');
	require_once('functions.php');
	
//---------------------------------------------------------------
// IF NOT LOGGED IN, GO AWAY
//---------------------------------------------------------------
if(!$_SESSION['loggedin']){
					session_destroy();
					header("Location: index.php", 301);
					exit();	
}
	loadUserImages($_SESSION['userid']);
	
	//TODO: Check to see if the password reset is active.  If so, force user to change it

  //TODO: Check for new mail and set Session Var for $Navbar	
  $_SESSION['newmail'] = "style='color:red'"; // New Mail
   

require_once('header.php');   
?>
<div class="uk-section uk-section-primary">
	<div class="uk-container uk-container-large">
		<div><img class="uk-border-pill uk-box-shadow-large" src="<?php echo $_SESSION['profilepic']; ?>" width="200" height="200" alt="Profile Pic"></div>
		<div class="uk-text-left"><?php echo $_SESSION['username']; ?></div>
	</div>

	<h3 class="uk-text-center">This will be the landing page</h3>



</div>

<?php
require_once('footer.php');
?>
