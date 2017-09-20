<?php

	// ---------------------------------
	// MyTreasure: Dashboard entry point
	// ---------------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	// On entry
	// $dashboard_section = dashboard section by name
	// $dashboard_error   = error message
	
	// Plugins
	require_once(dirname(__FILE__) . '/../ext/nice_table/nice_table.php');

	// Load data from current logged user
	$user_name      = session_getUserName();
	$user_fullname  = session_getUserFullName();
	$user_role      = session_getUserRole();
	
	//
	$dashboard_menu = $dashboard_section;
	
	switch($dashboard_section) {
		case 'database' :
		case 'users'    :
		case 'books'    :
				break;
		case 'authors'  :
		case 'publishers'  :
		case 'genres'  :
		case 'formats'  :
		case 'languages'  :
		case 'locations'  :
				$dashboard_menu = 'more';
				break;
		default         :
				break; // FIXME
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo($CF['app_name']); ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css"-->
		<link rel="stylesheet" href="ext/w3css/w3.css">
		
		<!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway"-->
		<!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"-->
		<link rel="stylesheet" href="ext/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="res/mytreasure.css">
		<style>
			html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
		</style>
	</head>
<body class="w3-light-grey">

	<script src="ext/nice_table/nice_table.js"></script>
	
<!-- Top container -->
<div class="w3-container w3-top w3-black w3-large w3-padding" style="z-index:4">
  <button class="w3-btn w3-hide-large w3-padding-0 w3-hover-text-green" onclick="w3_open();"><i class="fa fa-bars"></i></button>
  <b><?php echo($CF['app_name']); ?></b>
  <span class="w3-right">
  	<a href="#" class="w3-hover-none w3-hover-text-blue w3-show-inline-block" onclick="show_info();">
		<i class="fa fa-question-circle"></i>
	</a>
	&nbsp;
	<a href="index.php?action=logout" class="w3-hover-none w3-hover-text-red w3-show-inline-block">
		<i class="fa fa-power-off"></i>
	</a>
  </span>
</div>

<!-- Sidenav/menu -->
<nav class="w3-sidenav w3-collapse w3-white" style="z-index:3;width:300px;" id="mySidenav"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <!--img src="http://www.w3schools.com/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px"-->
	  <i class="fa fa-user-circle-o w3-xxxlarge w3-margin-right w3-text-green "></i>
    </div>
    <div class="w3-col s8">
      <strong><?php echo($user_fullname); ?></strong>
	  <br>
	  <?php echo($user_role); ?>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5><?php say('Menu'); ?></h5>
  </div>
  <!--a href="#" class="w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a-->
<?php

	// Abreviations for menus and sections
	$dm = $dashboard_menu;
	$ds = $dashboard_section;
	$dc = ' w3-green';

?>
	<a href="index.php?action=database" class="w3-padding<?php if($ds == 'database') echo($dc); ?>">
		<i class="fa fa-database fa-fw"></i> <?php say('Database'); ?>
	</a>
<?php
	// Only Admin users can see Users section /////////////////////////
	if($user_role == 'Admin') {
?>
	<a href="index.php?action=users" class="w3-padding<?php if($ds == 'users') echo($dc); ?>">
		<i class="fa fa-users fa-fw"></i> <?php say('Users'); ?>
	</a>
<?php
	}
	///////////////////////////////////////////////////////////////////
?>
	<a href="index.php?action=books" class="w3-padding<?php if($ds == 'books') echo($dc); ?>">
		<i class="fa fa-book fa-fw"></i> <?php say('Books'); ?>
	</a>
<?php
	// Only Admin users can see More section /////////////////////////
	if($user_role == 'Admin') {
?>	
	<a href="#" class="w3-padding" onclick="show_menu_more()">
		<i class="fa fa-table fa-fw"></i> <?php say('More'); ?><span style="float:right" id="menu_more_symbol"><?php echo($dm == 'more' ? '&laquo;' : '&raquo;');?></span>
	</a>

	<div style="display:<?php echo($dm == 'more' ? 'block' : 'none');?>" id="menu_more">
		<a href="index.php?action=authors" class="w3-padding<?php if($ds == 'authors') echo($dc); ?>">
			&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil fa-fw"></i> <?php say('Authors'); ?>
		</a>
		<a href="index.php?action=publishers" class="w3-padding<?php if($ds == 'publishers') echo($dc); ?>">
			&nbsp;&nbsp;&nbsp;<i class="fa fa-newspaper-o fa-fw"></i> <?php say('Publishers'); ?>
		</a>
		<a href="index.php?action=genres" class="w3-padding<?php if($ds == 'genres') echo($dc); ?>">
			&nbsp;&nbsp;&nbsp;<i class="fa fa-user-secret fa-fw"></i> <?php say('Genres'); ?>
		</a>
		<a href="index.php?action=formats" class="w3-padding<?php if($ds == 'formats') echo($dc); ?>">
			&nbsp;&nbsp;&nbsp;<i class="fa fa-file-o fa-fw"></i> <?php say('Formats'); ?>
		</a>
		<a href="index.php?action=languages" class="w3-padding<?php if($ds == 'languages') echo($dc); ?>">
			&nbsp;&nbsp;&nbsp;<i class="fa fa-language fa-fw"></i> <?php say('Languages'); ?>
		</a>
		<a href="index.php?action=locations" class="w3-padding<?php if($ds == 'locations') echo($dc); ?>">
			&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker fa-fw"></i> <?php say('Locations'); ?>
		</a>
	</div>
<?php
	}
	///////////////////////////////////////////////////////////////////
?>  
  <br>
  <br>
</nav>

<!-- Overlay effect when opening sidenav on small screens -->
<!--div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div-->

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Section -->
  <div class="w3-margin-bottom">
  
<?php
	require_once(dirname(__FILE__) . '/dashboard/'.$dashboard_section.'.php');
?> 
  
	</div>
  

	<!-- ################################################### -->

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-dark-grey">
	<?php echo($CF['app_copyright']); ?> <?php say('AllRightsReserved'); ?>
  </footer>
  
  <!-- ###################### MODAL: ERROR FROM ACTION ############################# -->

<?php
	if(isset($dashboard_error)) {
?>
  <div id="modal_show_error" class="w3-modal" style="display: block">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('modal_show_error').style.display='none'" class="w3-closebtn">&times;</span>
        <h2><?php say('Error'); ?></h2>
      </header>
	  
      <div class="w3-container">
        <div class="w3-section">

		  <p><?php say($dashboard_error); ?></p>
		  
		  <hr>
		
		  <button class="w3-btn w3-green" onclick="document.getElementById('modal_show_error').style.display='none'"><?php say('Continue'); ?></button>
        </div>
      </div>
    </div>
  </div>
<?php
	}
?>

<!-- ###################### MODAL: APP INFORMATION ############################# -->

  <div id="modal_show_info" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('modal_show_info').style.display='none'" class="w3-closebtn">&times;</span>
        <h2><?php say('AboutInfo'); ?></h2>
      </header>
	  
      <div class="w3-container">
        <div class="w3-section">
			<div class="w3-container w3-row">
				 <div class="w3-col s2">
				   <i class="fa fa-money fa-4x" style="color:green; text-shadow: 1px 1px 1px black;"></i>
				 </div>
				 <div class="w3-col s10">
					<strong><?php echo($CF['app_name']); ?></strong> v<?php echo($CF['app_version']); ?>
					<br>
					<?php echo($CF['app_date']); ?>
					<br><br>
				    <?php say('AboutText'); ?>
				    <br><br>
					<a href="http://www.floppysoftware.es" target="_blank">http://www.floppysoftware.es</a>
					<br><br>
					<?php echo($CF['app_copyright']); ?> <?php say('AllRightsReserved'); ?>
				 </div>
			 </div>
		  <hr>
		  <button class="w3-btn w3-green" onclick="document.getElementById('modal_show_info').style.display='none'"><?php say('Continue'); ?></button>
        </div>
      </div>
    </div>
  </div>

  <!-- End page content -->
</div>

<script>
	// Get the Sidenav
	var mySidenav = document.getElementById("mySidenav");

	// Get the DIV with overlay effect
	var overlayBg = document.getElementById("myOverlay");

	// Toggle between showing and hiding the sidenav, and add overlay effect
	function w3_open() {
		if (mySidenav.style.display === 'block') {
			mySidenav.style.display = 'none';
			overlayBg.style.display = "none";
		} else {
			mySidenav.style.display = 'block';
			overlayBg.style.display = "block";
		}
	}

	// Close the sidenav with the close button
	/*
	function w3_close() {
		mySidenav.style.display = "none";
		overlayBg.style.display = "none";
	}
	*/

	// Show - hide the menu more
	function show_menu_more() {
		var sect = document.getElementById("menu_more");
		var symb = document.getElementById("menu_more_symbol");
		
		if(sect.style.display == "none") {
			sect.style.display = "block";
			symb.innerHTML = "&laquo;"
		}
		else {
			sect.style.display = "none";
			symb.innerHTML = "&raquo;"
		}
	}
	
	// Show information modal
	function show_info() {
		document.getElementById("modal_show_info").style.display = 'block';
	}

</script>

</body>
</html>
