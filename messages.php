<?php
include_once('header.php');
?>

<div class="uk-section-default" style="padding-top:50px; padding-bottom:50px;">
	<div class="uk-container uk-container-expand">
		
		<div class="uk-flex">
			<div class="uk-width-auto" style="padding-right:30px; text-align:left;">
			    <ul class="uk-nav uk-nav-default">
			        <li class="uk-active"><a href="#">Inbox</a></li>
			        <li><a href="#">Sent</a></li>
			        <li><a href="#">Trash</a></li>
			    </ul>
			</div>

			<div class="uk-width-expand">
			<table class="uk-table uk-table-divider uk-table-striped">
			    <thead>
			        <tr>
			        		<th>Date Received</th>
			            <th>From</th>
			            <th>Subject</th>
			            <th></th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			        		<td>03/13/2019</td>
			            <td>University of Kentucky</td>
			            <td>Setup a time to talk</td>
			            <td>
			            	<a href=""><span uk-tooltip="title: Open" uk-icon="icon: push" style="color:blue;padding-right:15px;"></span></a>
			            	<a href=""><span uk-tooltip="title: Delete" uk-icon="icon: close" style="color:red;padding-right:15px;"></span></a>
			            	<span uk-tooltip="title: New" uk-icon="icon: info" style="color:green;"></span>
			            </td>
			        </tr>
			        <tr>
			        		<td>03/13/2019</td>
			            <td>Ohio U</td>
			            <td>Cheer Team Tryouts</td>
			            <td>
			            	<a href=""><span uk-tooltip="title: Open" uk-icon="icon: push" style="color:blue;padding-right:15px;"></span></a>
			            	<a href=""><span uk-tooltip="title: Delete" uk-icon="icon: close" style="color:red;padding-right:15px;"></span></a>
			            	<span uk-tooltip="title: New" uk-icon="icon: info" style="color:green;"></span>
			            </td>
			        </tr>
			        <tr>
			        		<td>03/12/2019</td>
			            <td>Alabama</td>
			            <td>Tryouts for cheer</td>
			            <td>
			            	<a href=""><span uk-tooltip="title: Open" uk-icon="icon: push" style="color:blue;padding-right:15px;"></span></a>
			            	<a href=""><span uk-tooltip="title: Delete" uk-icon="icon: close" style="color:red;padding-right:15px;"></span></a>
			            </td>
			        </tr>
			        <tr>
			        		<td>03/12/2019</td>
			            <td>Clemson</td>
			            <td>Introduction</td>
			            <td>
			            	<a href=""><span uk-tooltip="title: Open" uk-icon="icon: push" style="color:blue;padding-right:15px;"></span></a>
			            	<a href=""><span uk-tooltip="title: Delete" uk-icon="icon: close" style="color:red;padding-right:15px;"></span></a>
			            </td>
			        </tr>
			        <tr>
			        		<td>03/12/2019</td>
			            <td>Purdue</td>
			            <td>Boiler Up</td>
			            <td>
			            	<a href=""><span uk-tooltip="title: Open" uk-icon="icon: push" style="color:blue;padding-right:15px;"></span></a>
			            	<a href=""><span uk-tooltip="title: Delete" uk-icon="icon: close" style="color:red;padding-right:15px;"></span></a>
			            </td>
			        </tr>
			        <tr>
			        		<td>03/10/2019</td>
			            <td>Notre Dame</td>
			            <td>Introduction</td>
			            <td>
			            	<a href=""><span uk-tooltip="title: Open" uk-icon="icon: push" style="color:blue;padding-right:15px;"></span></a>
			            	<a href=""><span uk-tooltip="title: Delete" uk-icon="icon: close" style="color:red;padding-right:15px;"></span></a>
			            </td>
			        </tr>
			    </tbody>
			</table>
			</div>
		</div>
		
	</div>
</div>


<?php
include_once('footer.php');
?>
