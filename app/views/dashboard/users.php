<?php
  
	// -----------------------
	// MyTreasure: Users Table
	// -----------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.

	// Dependencies
	require_once(dirname(__FILE__) . '/../../actions/get_users.php');
	
	require_once(dirname(__FILE__) . '/../../libs/populate_roles.php');
	
	$table_cfg = array(
		'id' => 'users',
		'columns' => array(
			array('title' => tr('Id'), 'sortBy' => 'id'),
			array('title' => tr('Username'), 'sortBy' => 'name'),
			array('title' => tr('Fullname'), 'sortBy' => 'fullname'),
			array('title' => tr('Role'), 'sortBy' => 'role'),
			array('title' => tr('Actions'))
		),
		'rows' => array(
		)
	);
	
	// Create table
	$table = new NiceTable($table_cfg);
	
	$table->setGetParams(array('action' => 'users'));
	
	// Get page length
	$page_length = $table->getPageLength();
	
	if($table->getSortBy() == '') {
		$table->setSortBy('id');
		$table->setSortOrder('asc');
	}
	
	// Read records
	$records = get_users($table->getPage(), $page_length, $table->getSortBy(), $table->getSortOrder());
	
	$total_recs = $records['total_recs'];
	$paged_recs = $records['paged_recs'];
	$recs       = $records['recs'];

	// Set # of pages in table
	$table->setPages(floor(($total_recs + $page_length - 1) / $page_length));
	
	// Build rows for table
	$rows = array();
	
	for($i = 0; $i < count($recs); ++$i) {
		$rows[$i] = array($recs[$i]['id'], $recs[$i]['name'], $recs[$i]['fullname'], $recs[$i]['role'],		
				NiceTable::drawIcon(NiceTable::ICON_INFO,   'rec_info(recs['.$i.'])').
				NiceTable::drawIcon(NiceTable::ICON_EDIT,   'rec_edit(recs['.$i.'])').
				NiceTable::drawIcon(NiceTable::ICON_DELETE, 'rec_delete(recs['.$i.'])'));
	}
	
	// Set rows in table
	$table->setRows($rows);

	// Build array of records for JavaScript modals  -- FIXME -- función PHP???
?>
<script>
	var recs = <?php echo(json_encode($recs)); ?>;
</script>

  <header class="w3-container">
    <h5><b><i class="fa fa-users fa-fw"></i> <?php say('Users'); ?></b></h5>
	<hr class="w3-border-gray">
  </header>

  <div class="w3-container">
	<div class="w3-right">
		<button class="w3-btn w3-small w3-green" onclick="document.getElementById('modal_add').style.display='block'">
			<i class="fa fa-plus-square w3-text-black"></i>&nbsp;&nbsp;<?php say('Add'); ?>
		</button>
	</div>
	
	<br><br>
  
<?php
	$table->draw();
?>
	

  </div>
  
  <!-- ###################### MODAL: RECORD INFO ############################# -->
  
  <div id="modal_info" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('modal_info').style.display='none'" class="w3-closebtn">&times;</span>
        <h2><?php say('UserInfo'); ?> &nbsp;|&nbsp; <span id="modal_info_id"></span></h2>
      </header>
	  
      <form class="w3-container" method="post" action="">
        <div class="w3-section">
		  <label><b><?php say('Username'); ?></b></label>
          <input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_info_name" disabled>
		  <label><b><?php say('Fullname'); ?></b></label>
          <input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_info_fullname" disabled>
		  <label><b><?php say('Role'); ?></b></label>
		  <input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_info_role" disabled>
		  <hr>
		  <button class="w3-btn w3-green" type="button" onclick="document.getElementById('modal_info').style.display='none'"><?php say('Continue'); ?></button>
        </div>
      </form>
    </div>
  </div>
  
  <!-- ###################### MODAL: ADD RECORD ############################# -->
  
  <div id="modal_add" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('modal_add').style.display='none'" class="w3-closebtn">&times;</span>
        <h2><?php say('AddUser'); ?></h2>
      </header>
	  
      <form class="w3-container" method="post" action="index.php?action=add_user">
        <div class="w3-section">
          <label><b><?php say('Username'); ?></b></label>
          <input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" name="user_name" required>
          <label><b><?php say('Password'); ?></b></label>
          <input class="w3-input w3-margin-bottom w3-border" type="password" placeholder="" name="user_password" required>
		  <label><b><?php say('Fullname'); ?></b></label>
          <input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" name="user_fullname" required>
		  <label><b><?php say('Role'); ?></b></label>
		  <select class="w3-select w3-margin-bottom w3-border" name="user_role_id" required>
				<?php populate_roles(); ?>
		  </select>
		  <hr>
          <button class="w3-btn w3-green" type="submit"><?php say('Save'); ?></button>
		  <button class="w3-btn w3-green" type="button" onclick="document.getElementById('modal_add').style.display='none'"><?php say('Cancel'); ?></button>
        </div>
      </form>
    </div>
  </div>
  
  <!-- ###################### MODAL: EDIT RECORD ############################# -->
  
  <div id="modal_edit" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('modal_edit').style.display='none'" class="w3-closebtn">&times;</span>
        <h2><?php say('EditUser'); ?> &nbsp;|&nbsp; <span id="modal_edit_id"></span></h2>
      </header>
	  
      <form class="w3-container" method="post" action="index.php?action=edit_user">
        <div class="w3-section">
		  <input class="" type="hidden" id="modal_edit_id_hidden" name="user_id" value="">
		
          <label><b><?php say('Username'); ?></b></label>
          <input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_edit_name" name="user_name" value="">
          <label><b><?php say('Password'); ?></b></label>
          <input class="w3-input w3-margin-bottom w3-border" type="password" placeholder="" id="modal_edit_password" name="user_password" value="">
		  <label><b><?php say('Fullname'); ?></b></label>
          <input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_edit_fullname" name="user_fullname" value="" required>
		  <label><b><?php say('Role'); ?></b></label>
		  <select class="w3-select w3-margin-bottom w3-border" id="modal_edit_role_id" name="user_role_id" required>
				<?php populate_roles(); ?>
		  </select>
		  <hr>
          <button class="w3-btn w3-green" type="submit"><?php say('Update'); ?></button>
		  <button class="w3-btn w3-green" type="button" onclick="document.getElementById('modal_edit').style.display='none'"><?php say('Cancel'); ?></button>
        </div>
      </form>
    </div>
  </div>
  
   <!-- ###################### MODAL: DELETE RECORD ############################# -->
  
  <div id="modal_delete" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('modal_delete').style.display='none'" class="w3-closebtn">&times;</span>
        <h2><?php say('DeleteUser'); ?> &nbsp;|&nbsp; <span id="modal_delete_id"></span></h2>
      </header>
	  
      <form class="w3-container" method="post" action="index.php?action=delete_user">
        <div class="w3-section">
			<input class="" type="hidden" id="modal_delete_id_hidden" name="user_id" value="">
			<p>
				<?php echo str_replace('*','<b><span id="modal_delete_show">?</span></b>', tr('AskDeleteUser')); ?>
			</p> 
			<hr>
          <button class="w3-btn w3-green" type="submit"><?php say('Delete'); ?></button>
		  <button class="w3-btn w3-green" type="button" onclick="document.getElementById('modal_delete').style.display='none'"><?php say('Cancel'); ?></button>
        </div>
      </form>

	  </div>
  </div>


<script>
	// Record info
	function rec_info(rec) {
		document.getElementById("modal_info_id").innerHTML  = rec.id;
		document.getElementById("modal_info_name").value    = rec.name;
		document.getElementById("modal_info_fullname").value    = rec.fullname;
		document.getElementById("modal_info_role").value = rec.role;
		document.getElementById('modal_info').style.display = 'block';
	}
	
	// Edit record
	function rec_edit(rec) {
		document.getElementById("modal_edit_id").innerHTML    = rec.id;
		document.getElementById("modal_edit_id_hidden").value = rec.id;
		document.getElementById("modal_edit_name").value      = rec.name;
		document.getElementById("modal_edit_password").value  = rec.password;
		document.getElementById("modal_edit_fullname").value      = rec.fullname;
		document.getElementById("modal_edit_role_id").value = rec.role_id;
		document.getElementById('modal_edit').style.display = 'block';
	}
	
	// Delete record
	function rec_delete(rec) {
		document.getElementById("modal_delete_id").innerHTML       = rec.id;
		document.getElementById("modal_delete_id_hidden").value = rec.id;
		document.getElementById("modal_delete_show").innerHTML = rec.name;
		document.getElementById('modal_delete').style.display  = 'block';
	}
</script>