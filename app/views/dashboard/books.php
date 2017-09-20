<?php
  
	// -----------------------
	// MyTreasure: Books Table
	// -----------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.

	// Dependencies
	require_once(dirname(__FILE__) . '/../../actions/get_books.php');
	
	require_once(dirname(__FILE__) . '/../../libs/get_book_filters.php');
	require_once(dirname(__FILE__) . '/../../libs/set_book_filters.php');

	require_once(dirname(__FILE__) . '/../../libs/populate_authors.php');
	require_once(dirname(__FILE__) . '/../../libs/populate_genres.php');
	require_once(dirname(__FILE__) . '/../../libs/populate_publishers.php');
	require_once(dirname(__FILE__) . '/../../libs/populate_formats.php');
	require_once(dirname(__FILE__) . '/../../libs/populate_languages.php');
	require_once(dirname(__FILE__) . '/../../libs/populate_locations.php');
	
	// Filter books
	$filters = get_book_filters();

	//
	$table_cfg = array(
		'id' => 'books',
		'columns' => array(
			array('title' => tr('Id'), 'sortBy' => 'id'),
			array('title' => tr('Title'), 'sortBy' => 'title'),
			array('title' => tr('Author'), 'sortBy' => 'author'),
			array('title' => tr('Genre'), 'sortBy' => 'genre'),
			array('title' => tr('Actions'))
		),
		'rows' => array(
		)
	);

	// Create table
	$table = new NiceTable($table_cfg);
	
	$table->setGetParams(array('action' => 'books'));
	//$table->setPostParams(array('sort_by' => $sort_by, 'sort_order' => $sort_order));
	$table->setPostParams($filters);
	
	// Get page length
	$page_length = $table->getPageLength();
	
	if($table->getSortBy() == '') {
		$table->setSortBy('id');
		$table->setSortOrder('asc');
	}
	
	// Read records
	$records = get_books($table->getPage(), $page_length, $table->getSortBy(), $table->getSortOrder(), $filters);
	
	$total_recs = $records['total_recs'];
	$paged_recs = $records['paged_recs'];
	$recs       = $records['recs'];

	// Set # of pages in table
	$table->setPages(floor(($total_recs + $page_length - 1) / $page_length));
	
	// Build rows for table
	$rows = array();
	
	for($i = 0; $i < count($recs); ++$i) {
		$rows[$i] = array($recs[$i]['id'], $recs[$i]['title'], $recs[$i]['author'], $recs[$i]['genre'],
				NiceTable::drawIcon(NiceTable::ICON_INFO,   'rec_info(recs['.$i.'])').
				($user_role == 'Admin' ? NiceTable::drawIcon(NiceTable::ICON_EDIT,   'rec_edit(recs['.$i.'])') : '').
				NiceTable::drawIcon(NiceTable::ICON_PRINT,  'rec_print(recs['.$i.'].id)').
				($user_role == 'Admin' ? NiceTable::drawIcon(NiceTable::ICON_DELETE, 'rec_delete(recs['.$i.'])') : ''));
	}
	
	// Set rows in table
	$table->setRows($rows);
	
	// Build array of records for JavaScript modals  -- FIXME -- función PHP???
?>
<script>
	var recs = <?php echo(json_encode($recs)); ?>;
</script>

<header class="w3-container">
    <h5><b><i class="fa fa-book fa-fw"></i> <?php say('Books'); ?></b></h5>
	<hr class="w3-border-gray">
</header>


  <div class="w3-container">

	<div class="w3-right">
<?php
	// Only Admin users can see Add button /////////////////////////
	if($user_role == 'Admin') {
?>		
		<button class="w3-btn w3-small w3-green" onclick="document.getElementById('modal_add').style.display='block'">
			<i class="fa fa-plus-square w3-text-black"></i>&nbsp;&nbsp;<?php say('Add'); ?>
		</button>
<?php
	}
	////////////////////////////////////////////////////////////////
?>
		<button class="w3-btn w3-small w3-green" onclick="rec_print('*');">
			<i class="fa fa-print w3-text-black"></i>&nbsp;&nbsp;<?php say('Print'); ?>
		</button>

		<button class="w3-btn w3-small w3-green" onclick="rec_export();">
			<i class="fa fa-file-o w3-text-black"></i>&nbsp;&nbsp;<?php say('Export'); ?>
		</button>
		
		<button class="w3-btn w3-small w3-green" onclick="rec_filter();">
			<i class="fa fa-filter w3-text-black"></i>&nbsp;&nbsp;<?php say('Filter'); ?>
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
        <h2><?php say('BookInfo'); ?> &nbsp;|&nbsp; <span id="modal_info_id"></span></h2>
      </header>
	  
      <form class="w3-container" method="post" action="">
        <div class="w3-section">
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Title'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" id="modal_info_title" disabled>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Genre'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" id="modal_info_genre" disabled>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Author'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" id="modal_info_author" disabled>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Language'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" id="modal_info_language" disabled>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Author2'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" id="modal_info_author2" disabled>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('ISBN'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" id="modal_info_isbn" disabled>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Format'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" id="modal_info_format" disabled>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Location'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" id="modal_info_location" disabled>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Publisher'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" id="modal_info_publisher" disabled>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Borrower'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" id="modal_info_location_ex" disabled>
				</div>
			</div>
			<label><b><?php say('Summary'); ?></b></label>
			<textarea class="w3-input w3-border" rows="2" id="modal_info_summary" disabled></textarea>
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
        <h2><?php say('AddBook'); ?></h2>
      </header>
	  
      <form class="w3-container" method="post" action="index.php?action=add_book">
        <div class="w3-section">
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Title'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_add_title" name="book_title" required>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Genre'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_add_genre_id" name="book_genre_id" required>
						<?php populate_genres(); ?>
					</select>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Author'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_add_author_id" name="book_author_id" required>
						<?php populate_authors(); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Language'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_add_language_id" name="book_language_id" required>
						<?php populate_languages(); ?>
					</select>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Author2'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_add_author_id" name="book_author2_id" required>
						<?php populate_authors(); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('ISBN'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_add_isbn" name="book_isbn">
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Format'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_add_format_id" name="book_format_id" required>
						<?php populate_formats(); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Location'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_add_location_id" name="book_location_id" required>
						<?php populate_locations(); ?>
					</select>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Publisher'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_add_publisher_id" name="book_publisher_id" required>
						<?php populate_publishers(); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Borrower'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_add_location_ex" name="book_location_ex">
				</div>
			</div>
			<label><b><?php say('Summary'); ?></b></label>
			<textarea class="w3-select w3-border" rows="2" id="modal_add_summary" name="book_summary"></textarea>
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
        <h2><?php say('EditBook'); ?> &nbsp;|&nbsp; <span id="modal_edit_id"></span></h2>
      </header>
	  
      <form class="w3-container" method="post" action="index.php?action=edit_book">
        <div class="w3-section">
			<input class="" type="hidden" id="modal_edit_id_hidden" name="book_id" value="">
		  
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Title'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_edit_title" name="book_title" required>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Genre'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_edit_genre_id" name="book_genre_id" required>
						<?php populate_genres(); ?>
					</select>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Author'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_edit_author_id" name="book_author_id" required>
						<?php populate_authors(); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Language'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_edit_language_id" name="book_language_id" required>
						<?php populate_languages(); ?>
					</select>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Author2'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_edit_author2_id" name="book_author2_id" required>
						<?php populate_authors(); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('ISBN'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_edit_isbn" name="book_isbn">
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Format'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_edit_format_id" name="book_format_id" required>
						<?php populate_formats(); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Location'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_edit_location_id" name="book_location_id" required>
						<?php populate_locations(); ?>
					</select>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Publisher'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_edit_publisher_id" name="book_publisher_id" required>
						<?php populate_publishers(); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Borrower'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_edit_location_ex" name="book_location_ex">
				</div>
			</div>
			<label><b><?php say('Summary'); ?></b></label>
			<textarea class="w3-select w3-border" rows="2" id="modal_edit_summary" name="book_summary"></textarea>
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
        <h2><?php say('DeleteBook'); ?> &nbsp;|&nbsp; <span id="modal_delete_id"></span></h2>
      </header>
	  
      <form class="w3-container" method="post" action="index.php?action=delete_book">
        <div class="w3-section">
			<input class="" type="hidden" id="modal_delete_id_hidden" name="book_id" value="">
			<p>
				<?php echo str_replace('*','<b><span id="modal_delete_show">?</span></b>', tr('AskDeleteBook')); ?>
			</p> 
			<hr>
          <button class="w3-btn w3-green" type="submit"><?php say('Delete'); ?></button>
		  <button class="w3-btn w3-green" type="button" onclick="document.getElementById('modal_delete').style.display='none'"><?php say('Cancel'); ?></button>
        </div>
      </form>

	  </div>
  </div>
  
  <!-- ###################### MODAL: PRINT ############################# -->
  
  <div id="modal_print" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('modal_print').style.display='none'" class="w3-closebtn">&times;</span>
        <h2><?php say('PrintBook_s'); ?></h2>
      </header>
	  
      <form class="w3-container" method="post" action="index.php?action=print_books" target="_blank">
        <div class="w3-section">
			<?php set_book_filters($filters); ?>
			
			<input class="" type="hidden" id="modal_print_book_id" name="print_book_id" value="*">
			
			<input class="" type="hidden" id="modal_print_sort_by" name="print_sort_by" value="<?php echo($table->getSortBy()); ?>">
			<input class="" type="hidden" id="modal_print_sort_order" name="print_sort_order" value="<?php echo($table->getSortOrder()); ?>">
		
			<label><b><?php say('SelectPrintFormat'); ?></b></label>
			<select class="w3-select w3-margin-bottom w3-border" id="modal_print_format" name="print_format" required>
				<option value="List"><?php say('SelOptList'); ?></option>
				<option value="Card"><?php say('SelOptCard'); ?></option>
				<option value="Exlibris"><?php say('SelOptExlibris'); ?></option>
			</select>
			<hr>
			<button class="w3-btn w3-green" type="submit" onclick="document.getElementById('modal_print').style.display='none'"><?php say('Print'); ?></button>
			<button class="w3-btn w3-green" type="button" onclick="document.getElementById('modal_print').style.display='none'"><?php say('Cancel'); ?></button>
        </div>
      </form>
    </div>
  </div>
  
  <!-- ###################### MODAL: EXPORT ############################ -->
  
  <div id="modal_export" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:400px">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('modal_export').style.display='none'" class="w3-closebtn">&times;</span>
        <h2><?php say('ExportBook_s'); ?></h2>
      </header>
	  
      <form class="w3-container" method="post" action="index.php?action=export_books" target="_blank">
        <div class="w3-section">
			<?php set_book_filters($filters); ?>
			
			<input class="" type="hidden" id="form_export_csv_sort_by" name="export_csv_sort_by" value="<?php echo($table->getSortBy()); ?>">
			<input class="" type="hidden" id="form_export_csv_sort_order" name="export_csv_sort_order" value="<?php echo($table->getSortOrder()); ?>">
			
			<label><b><?php say('SelectExportFormat'); ?></b></label>
			<select class="w3-select w3-margin-bottom w3-border" id="modal_export_format" name="export_format" required style="font-family:monospace">
				<option value="csv">CSV &nbsp; <?php say('SelOptCSV'); ?></option>
			</select>
		
			<label><b><?php say('SelectFieldSeparator'); ?></b></label>
			<select class="w3-select w3-margin-bottom w3-border" id="modal_export_csv_delimiter" name="export_csv_delimiter" required style="font-family:monospace">
				<option value="semicolon">; &nbsp; <?php say('SelOptSemicolon'); ?></option>
				<option value="comma">, &nbsp; <?php say('SelOptComma'); ?></option>
				<option value="tab"><?php say('SelOptTab'); ?></option>
			</select>
			
			<label><b><?php say('SelectStringEnclosure'); ?></b></label>
			<select class="w3-select w3-margin-bottom w3-border" id="modal_export_csv_enclosure" name="export_csv_enclosure" required style="font-family:monospace">
				<option value="doublequote">" &nbsp; <?php say('SelOptDoubleQuote'); ?></option>
				<option value="singlequote">' &nbsp; <?php say('SelOptSingleQuote'); ?></option>
			</select>
			<hr>
			<button class="w3-btn w3-green" type="submit" onclick="document.getElementById('modal_export').style.display='none'"><?php say('Export'); ?></button>
			<button class="w3-btn w3-green" type="button" onclick="document.getElementById('modal_export').style.display='none'"><?php say('Cancel'); ?></button>
        </div>
      </form>
    </div>
  </div>
  
  <!-- ###################### MODAL: FILTER RECORDS ############################# -->
  
  <div id="modal_filter" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('modal_filter').style.display='none'" class="w3-closebtn">&times;</span>
        <h2><?php say('FilterBook_s'); ?></h2>
      </header>
	  
      <form class="w3-container" method="post" action="index.php?action=books">
        <div class="w3-section">
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Title'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_filter_title" name="filter_title" value="<?php echo($filters['filter_title']); ?>">
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Genre'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_filter_genre_id" name="filter_genre_id">
						<?php populate_genres($filters['filter_genre_id']); ?>
					</select>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Author'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_filter_author_id" name="filter_author_id">
						<?php populate_authors($filters['filter_author_id']); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Language'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_filter_language_id" name="filter_language_id">
						<?php populate_languages($filters['filter_language_id']); ?>
					</select>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Author2'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_filter_author2_id" name="filter_author2_id">
						<?php populate_authors($filters['filter_author2_id']); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('ISBN'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_filter_isbn" name="filter_isbn" value="<?php echo($filters['filter_isbn']); ?>">
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Format'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_filter_format_id" name="filter_format_id">
						<?php populate_formats($filters['filter_format_id']); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Location'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_filter_location_id" name="filter_location_id">
						<?php populate_locations($filters['filter_location_id']); ?>
					</select>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Publisher'); ?></b></label>
					<select class="w3-select w3-margin-bottom w3-border" id="modal_filter_publisher_id" name="filter_publisher_id">
						<?php populate_publishers($filters['filter_publisher_id']); ?>
					</select>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Borrower'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" placeholder="" id="modal_filter_location_ex" name="filter_location_ex" value="<?php echo($filters['filter_location_ex']); ?>">
				</div>
			</div>
			<label><b><?php say('Summary'); ?></b></label>
			<textarea class="w3-select w3-border" rows="2" id="modal_filter_summary" name="filter_summary"><?php echo($filters['filter_summary']); ?></textarea>
			<hr>
			<button class="w3-btn w3-green" type="submit"><?php say('Filter'); ?></button>
			<button class="w3-btn w3-green" type="button" onclick="rec_reset_filter();"><?php say('Reset'); ?></button>
			<button class="w3-btn w3-green" type="button" onclick="document.getElementById('modal_filter').style.display='none'"><?php say('Cancel'); ?></button>
        </div>
      </form>
    </div>
  </div>
    
  <script>
	// Record info
	function rec_info(rec) {
		document.getElementById("modal_info_id").innerHTML = rec.id;
		document.getElementById("modal_info_title").value = rec.title;
		document.getElementById("modal_info_author").value = rec.author;
		document.getElementById("modal_info_author2").value = rec.author2;
		document.getElementById("modal_info_genre").value = rec.genre;
		document.getElementById("modal_info_format").value = rec.format;
		document.getElementById("modal_info_language").value = rec.language;
		document.getElementById("modal_info_publisher").value = rec.publisher;
		document.getElementById("modal_info_location").value = rec.location;
		document.getElementById("modal_info_location_ex").value = rec.location_ex;
		document.getElementById("modal_info_isbn").value = rec.isbn;
		document.getElementById("modal_info_summary").value = rec.summary;
		document.getElementById('modal_info').style.display = 'block';
	}
	
	// Edit record
	function rec_edit(rec) {
		document.getElementById("modal_edit_id").innerHTML = rec.id;
		document.getElementById("modal_edit_id_hidden").value = rec.id;
		document.getElementById("modal_edit_title").value = rec.title;
		document.getElementById("modal_edit_author_id").value = rec.author_id;
		document.getElementById("modal_edit_author2_id").value = rec.author2_id;
		document.getElementById("modal_edit_genre_id").value = rec.genre_id;
		document.getElementById("modal_edit_format_id").value = rec.format_id;
		document.getElementById("modal_edit_language_id").value = rec.language_id;
		document.getElementById("modal_edit_publisher_id").value = rec.publisher_id;
		document.getElementById("modal_edit_location_id").value = rec.location_id;
		document.getElementById("modal_edit_location_ex").value = rec.location_ex;
		document.getElementById("modal_edit_isbn").value = rec.isbn;
		document.getElementById("modal_edit_summary").value = rec.summary;
		document.getElementById('modal_edit').style.display = 'block';
	}
	
	// Delete record
	function rec_delete(rec) {
		document.getElementById("modal_delete_id").innerHTML = rec.id;
		document.getElementById("modal_delete_id_hidden").value = rec.id;
		document.getElementById("modal_delete_show").innerHTML = rec.title;
		document.getElementById('modal_delete').style.display = 'block';
	}
	
	// Print record(s)
	function rec_print(rec_id) {
		document.getElementById("modal_print_book_id").value = rec_id;
		document.getElementById('modal_print').style.display = 'block';
	}
	
	// Export records
	function rec_export() {
		document.getElementById('modal_export').style.display = 'block';
	}
	
	// Filter records
	function rec_filter() {
		document.getElementById('modal_filter').style.display = 'block';
	}
	
	// Reset filter records
	function rec_reset_filter() {
		document.getElementById("modal_filter_title").value = '';
		document.getElementById("modal_filter_author_id").value = '';
		document.getElementById("modal_filter_author2_id").value = '';
		document.getElementById("modal_filter_genre_id").value = '';
		document.getElementById("modal_filter_format_id").value = '';
		document.getElementById("modal_filter_language_id").value = '';
		document.getElementById("modal_filter_publisher_id").value = '';
		document.getElementById("modal_filter_location_id").value = '';
		document.getElementById("modal_filter_location_ex").value = '';
		document.getElementById("modal_filter_isbn").value = '';
		document.getElementById("modal_filter_summary").value = '';
	}

  
  </script>