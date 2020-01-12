<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once('database.php');
require_once('functions.php');

// TODO: LOAD USER INFO FROM DATABASE	

include_once('header.php');
?>

<div class="uk-section-primary" style="padding-top:50px; padding-bottom:50px;color:#ffffff;">
	<div class="uk-container uk-container-small">

		<div uk-grid>
			<!-- Profile Pic and Name -->
			<div class="uk-text-center uk-width-1-5@m">
				<img class="uk-border-pill uk-box-shadow-large" src="<?php echo $_SESSION['profilepic']; ?>" width="200" height="200" alt="Profile Pic"><p />
					<span style="font-size:1.2em;"> 
						<?php 
						echo $_SESSION['firstname']." ".$_SESSION['lastname'];
						if ($_SESSION['status']==1){ echo "<br><img src='images/verified.png' width=20>"; }
						?> 
					</span>
				</div>

				<!-- Basic Info -->
				<div class="uk-width-2-5@m">
					<table class="uk-table uk-table-small">
						<tbody>
							<tr>
								<td class="uk-text-primary uk-text-right">USERNAME:</td>
								<td class="uk-text-left"><?php echo $_SESSION['username'];?></td>
							</tr>
							<tr>
								<td class="uk-text-primary uk-text-right">MEMBER SINCE:</td>
								<td class="uk-text-left"><?php echo date("m/d/Y", strtotime($_SESSION['usersince']));?></td>
							</tr>
							<tr>
								<td class="uk-text-primary uk-text-right">CITY:</td>
								<td class="uk-text-left"></td>
							</tr>
							<tr>
								<td class="uk-text-primary uk-text-right">STATE:</td>
								<td class="uk-text-left"></td>
							</tr>
						</tbody>
					</table>
				</div>

				<!-- School Info -->
				<div class="uk-width-2-5@m">
					<table class="uk-table uk-table-small">
						<tbody>
							<tr>
								<td class="uk-text-primary uk-text-right">SCHOOL:</td>
								<td class="uk-text-left"></td>
							</tr>
							<tr>
								<td class="uk-text-primary uk-text-right">GRADUATION:</td>
								<td class="uk-text-left"></td>
							</tr>
							<tr>
								<td class="uk-text-primary uk-text-right">GPA:</td>
								<td class="uk-text-left"></td>
							</tr>
							<tr>
								<td class="uk-text-primary uk-text-right">SAT/ACT:</td>
								<td class="uk-text-left"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>


		<!-- About/Comment Info -->

	</div>
	<div class="uk-section-default"  style="box-shadow: 3px -3px 11px 2px rgba(0,0,0,0.75);min-height:400px;">

		<div class="uk-container uk-container-small" style="padding-top:20px;">
			<div class="uk-container uk-container-center">

				<ul class="uk-tab" data-uk-tab="{connect:'#my-id'}">
					<li><a href="">About</a></li>
					<li><a href="">Skills</a></li>
					<li><a href="">Media</a></li>
				</ul>
				<ul id="my-id" class="uk-switcher uk-margin">
					<li><a href="#" id="autoplayer" data-uk-switcher-item="next"></a>
						My Profile
					</li>
					<li>Skills Listing</li>
					<li>Photos and Video</li>
				</ul>
			</div>
		</div>


	</div>
</div>



<?php
include_once('footer.php');
?>
