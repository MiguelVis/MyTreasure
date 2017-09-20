  <?php
  
	// --------------------
	// MyTreasure: Database
	// --------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.

	// Dependencies
	require_once(dirname(__FILE__) . '/../../actions/get_conf.php');
	require_once(dirname(__FILE__) . '/../../actions/get_num_users.php');
	require_once(dirname(__FILE__) . '/../../actions/get_num_books.php');
	require_once(dirname(__FILE__) . '/../../actions/get_num_authors.php');
	require_once(dirname(__FILE__) . '/../../actions/get_num_publishers.php');
	
	require_once(dirname(__FILE__) . '/../../libs/populate_exlibris.php');

	// Read configuration
	$conf = get_conf();
	
	// Build array of records for JavaScript modals  -- FIXME -- función PHP???
?>

<header class="w3-container">
	<h5><b><i class="fa fa-database fa-fw"></i> <?php say('Database'); ?></b></h5>
	<hr class="w3-border-gray">
</header>


<div class="w3-row-padding">
	<div class="w3-quarter">
	  <div class="w3-container w3-red w3-padding-16">
		<div class="w3-left"><i class="fa fa-book w3-xxxlarge"></i></div>
		<div class="w3-right">
		  <h3><?php echo(get_num_books()); ?></h3>
		</div>
		<div class="w3-clear"></div>
		<h4><?php say('Books'); ?></h4>
	  </div>
	</div>
	<div class="w3-quarter">
	  <div class="w3-container w3-blue w3-padding-16">
		<div class="w3-left"><i class="fa fa-pencil w3-xxxlarge"></i></div>
		<div class="w3-right">
		  <h3><?php echo(get_num_authors()); ?></h3>
		</div>
		<div class="w3-clear"></div>
		<h4><?php say('Authors'); ?></h4>
	  </div>
	</div>
	<div class="w3-quarter">
	  <div class="w3-container w3-teal w3-padding-16">
		<div class="w3-left"><i class="fa fa-newspaper-o w3-xxxlarge"></i></div>
		<div class="w3-right">
		  <h3><?php echo(get_num_publishers()); ?></h3>
		</div>
		<div class="w3-clear"></div>
		<h4><?php say('Publishers'); ?></h4>
	  </div>
	</div>
<?php
	// Only Admin users can see Users section ////////////////////////
	if($user_role == 'Admin') {
?>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?php echo(get_num_users()); ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4><?php say('Users'); ?></h4>
      </div>
    </div>
<?php
	}
	//////////////////////////////////////////////////////////////////
?>

 </div>
 
 <div class="w3-container">
	<hr class="w3-border-gray">
	<div class="w3-right">
<?php
	// Only Admin users can configure the database ///////////////////
	if($user_role == 'Admin') {
?>
		<button class="w3-btn w3-small w3-green" onclick="document.getElementById('modal_edit').style.display='block'">
			<i class="fa fa-cogs w3-text-black"></i>&nbsp;&nbsp;<?php say('Configure'); ?>
		</button>
<?php
	}
	//////////////////////////////////////////////////////////////////
?>		
	</div>
	<br><br>
</div>

<!-- ###################### MODAL: EDIT CONFIGURATION ############################# -->
  
  <div id="modal_edit" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('modal_edit').style.display='none'" class="w3-closebtn">&times;</span>
        <h2><?php say('EditConf'); ?></h2>
      </header>
	  
      <form class="w3-container" method="post" action="index.php?action=edit_conf">
        <div class="w3-section">
			<label><b><?php say('Title'); ?></b></label>
			<input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" name="conf_title" value="<?php echo($conf['title']); ?>">
			<label><b><?php say('Owner'); ?></b></label>
			<input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" name="conf_owner" value="<?php echo($conf['owner']); ?>">
			<label><b><?php say('Exlibris'); ?></b></label>
			<select class="w3-select w3-margin-bottom w3-border" name="conf_exlibris" value="<?php echo($conf['exlibris']); ?>">
				<?php populate_exlibris($conf['exlibris']); ?>
			</select>
			<hr>
			<button class="w3-btn w3-green" type="submit"><?php say('Update'); ?></button>
			<button class="w3-btn w3-green" type="button" onclick="document.getElementById('modal_edit').style.display='none'"><?php say('Cancel'); ?></button>
        </div>
      </form>
    </div>
  </div>

  