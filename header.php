<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!isset($_SESSION['loggedin'])) { $_SESSION['loggedin']=FALSE; }
if (!isset($_SESSION['newmail'])) { $_SESSION['newmail']=FALSE; }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Full Out Recruiting</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/uikit.min.css" />
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>

    </head>
    <body>

<!--  Navigation -->
      <div id="offcanvas-nav-primary" uk-offcanvas="overlay: true">
          <div class="uk-offcanvas-bar uk-flex uk-flex-column">

              <ul class="uk-nav-primary uk-nav-left uk-margin-auto-vertical">
              	<!-- MOBILE NAVIGATION -->
                <!-- Show Different Menu Items when logged in or not -->
                <?php if ($_SESSION["loggedin"] == TRUE) { ?>
                  <!-- Logged In, show actual menu -->

                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/home.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="home.php">Home</a>
                  </li>
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/profile.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="profile.php" style="">Profile</a>
                    <ul>
                    	<li class=""><a href="editprofile.php">Edit Profile</a></li> 
                    </ul>
                  </li>
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/members.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="members.php" style="">Members</a>
                  </li>
                   <?php $menuitem = ($_SERVER['PHP_SELF'] == '/messages.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="messages.php" style=""><span class="uk-icon uk-margin-small-right" uk-icon="icon: mail"></span>Messages</a>
                  </li>
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/registration.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="logout.php" style="">Logout</a>
                  </li>

                <?php }else{ ?>
                  <!-- Logged Out, show demo menu -->
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/index.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="index.php">Home</a>
                  </li>
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/profiledemo.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="profiledemo.php" style="">Profile</a>
                  </li>
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/membersdemo.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="membersdemo.php" style="">Members</a>
                  </li>
                   <?php $menuitem = ($_SERVER['PHP_SELF'] == '/messages.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="messagesdemo.php" style=""><span class="uk-icon uk-margin-small-right" uk-icon="icon: mail" <?php echo $_SESSION['newmail']; ?>></span>Messages</a>
                  </li>
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/registration.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="index.php" style="">Login / Register</a>
                  </li>
                <?php } ?>
              </ul>

          </div>
      </div>
      <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky">
        <nav class="uk-navbar-container uk-navbar" style="box-shadow: 3px 3px 22px 2px rgba(0,0,0,0.75);">

              <a class="uk-navbar-item uk-logo" href="#" style="font-size:1.8em;font-weight:bold;"><img class="uk-responsive-width" src="images/forecruit.png"></a>

            <div class="uk-navbar-right">

              <ul class="uk-navbar-nav uk-visible@m">
              	<!-- DESKTOP NAVIGATION -->
                <!-- Show Different Menu Items when logged in or not -->
                <?php if ($_SESSION["loggedin"] == TRUE) { ?>
                  <!-- Logged In, show actual menu -->

                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/home.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="home.php">Home</a>
                  </li>
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/profile.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="profile.php" style="">Profile</a>
											<div uk-dropdown>
									    	<ul class="uk-nav uk-dropdown-nav">
									        <li class=""><a href="editprofile.php">Edit Profile</a></li>   
									      </ul>
									    </div>                 
                  </li>
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/members.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="members.php" style="">Members</a>
                  </li>
                   <?php $menuitem = ($_SERVER['PHP_SELF'] == '/messages.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="messages.php" style=""><span class="uk-icon uk-margin-small-right" uk-icon="icon: mail" <?php echo $_SESSION['newmail']; ?>></span>Messages</a>
                  </li>
                  <li class="">
                    <a class="" href="logout.php" style="">Logout</a>
                  </li>

                <?php }else{ ?>
                  <!-- Logged Out, show demo menu -->
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/index.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="index.php">Home</a>
                  </li>
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/profiledemo.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="profiledemo.php" style="">Profile</a>
                  </li>
                  <?php $menuitem = ($_SERVER['PHP_SELF'] == '/membersdemo.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="membersdemo.php" style="">Members</a>
                  </li>
                   <?php $menuitem = ($_SERVER['PHP_SELF'] == '/messages.php')?'<li class="uk-active">' :'<li class="">'; echo $menuitem;?>
                    <a class="" href="messagesdemo.php" style=""><span class="uk-icon uk-margin-small-right" uk-icon="icon: mail" ></span>Messages</a>
                  </li>
                  <li class="">
                    <a class="" href="index.php" style="">Login / Register</a>
                  </li>
                <?php } ?>
              </ul>

              <button uk-toggle="target: #offcanvas-nav-primary" class="uk-button uk-button-default uk-hidden@m" type="button"><span class="" uk-icon="menu"></span></button>
            </div>

        </nav>
      </div>
<!-- End of Navigation -->
