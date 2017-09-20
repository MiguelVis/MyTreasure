<?php
  
	// -------------------------
	// MyTreasure: Print book(s)
	// -------------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	// Dependencies
	require_once(dirname(__FILE__) . '/../actions/get_conf.php');
	
	require_once(dirname(__FILE__) . '/../libs/get_book_filters.php');
	require_once(dirname(__FILE__) . '/../libs/read_books.php');
	require_once(dirname(__FILE__) . '/../libs/read_book_by_id.php');
	
	function print_list_header() {
?>
		<table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white w3-card-4">
			<thead>
				<tr class="w3-blue">
					<th><?php say('Id'); ?></th>
					<th><?php say('Title'); ?></th>
					<th><?php say('Author_s'); ?></th>
					<th>&nbsp;</th>
					<th><?php say('Genre'); ?></th>
				</tr>
			</thead>
<?php
	}
	
	function print_list_book($book, $nrec) {
?>
			<tr>
				<td><?php echo($book['id']); ?></td>
				<td><?php echo($book['title']); ?></td>
				<td><?php echo($book['author']); ?></td>
				<td><?php echo($book['author2']); ?></td>
				<td><?php echo($book['genre']); ?></td>
			</tr>
<?php
	}
	
	function print_list_footer($trecs) {
?>
			<tr>
				<td colspan="5"><?php say('TotalBooks'); ?><?php echo(' '.$trecs); ?></td>
			</tr>
		</table>
<?php
	}
	
	function print_card_book($book, $nrec) {
?>
	<div class="w3-modal-content w3-card-8" style="">
      <div class="w3-container w3-teal"> 
        <h2><?php say('BookInfo'); ?> &nbsp;|&nbsp; <span><?php echo($book['id']); ?></span></h2>
      </div>
	  
      <div class="w3-container">
        <form class="w3-section">
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Title'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" value="<?php echo($book['title']); ?>" disabled>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Genre'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" value="<?php echo($book['genre']); ?>" disabled>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Author'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" value="<?php echo($book['author']); ?>" disabled>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Language'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" value="<?php echo($book['language']); ?>" disabled>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Author2'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" value="<?php echo($book['author2']); ?>" disabled>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('ISBN'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" value="<?php echo($book['isbn']); ?>" disabled>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Format'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" value="<?php echo($book['format']); ?>" disabled>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Location'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" value="<?php echo($book['location']); ?>" disabled>
				</div>
			</div>
			<div class="w3-row">
				<div class="w3-col m6">
					<label><b><?php say('Publisher'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" value="<?php echo($book['publisher']); ?>" disabled>
				</div>
				<div class="w3-col m1 w3-hide-small">
					&nbsp;
				</div>
				<div class="w3-col m5">
					<label><b><?php say('Borrower'); ?></b></label>
					<input class="w3-input w3-margin-bottom w3-border" type="text" value="<?php echo($book['location_ex']); ?>" disabled>
				</div>
			</div>
			<label><b><?php say('Summary'); ?></b></label>
			<textarea class="w3-input w3-border" rows="4" disabled><?php echo($book['summary']); ?></textarea>
        </div>
      </form>
    </div>
	<br>
<?php
	}
	
	function print_exlibris_header() {
?>
		<table class="w3-table w3-bordered w3-border w3-white w3-card-4">
			<!--thead>
				<tr class="w3-blue">
					<th>Id</th>
					<th>Title</th>
					<th>Author</th>
					<th>Genre</th>
				</tr>
			</thead-->
<?php
	}
	
	function print_exlibris_book($book, $nrec, $conf) {
		$tr_open  = ($nrec % 4 != 0 ? false : true);
		$tr_close = ($nrec % 4 == 3 ? true : false);
		
		if($tr_open) {
?>
			<tr>
<?php
		}
?>
				<td class="w3-bordered w3-border w3-padding" style="width:25%;">
					Book Id:<span class="w3-right"><?php echo($book['id']); ?></span><br>
					<div class="w3-center w3-xxxlarge">&#<?php echo($conf['exlibris']); ?>;</div>
					<div class="w3-center"><?php echo($book['title']); ?></div>
					
				</td>
<?php
		if($tr_close) {
?>
			</tr>
<?php
		}
	}
	
	function print_exlibris_footer($trecs) {
		
		$ntd = $trecs % 4;
		
		if($ntd > 0) {
?>
				<td colspan="<?php echo(4 - $ntd); ?>">&nbsp;</td>
			</tr>
<?php
		}
?>
		</table>
<?php
	}
	
	function print_books() {
		global $db;
		global $dashboard_error;
		global $CF;
		
		//
		$ret = '';
		
		if(array_key_exists('print_book_id', $_POST)
			&& array_key_exists('print_format', $_POST)
			&& array_key_exists('print_sort_by', $_POST)
			&& array_key_exists('print_sort_order', $_POST)) {
				
			//
			$book_id    = $_POST['print_book_id'];
			$format     = $_POST['print_format'];
			$sort_by    = $_POST['print_sort_by'];
			$sort_order = $_POST['print_sort_order'];
			
			// Filter books
			$filters = get_book_filters();
				
			// Start output
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo($CF['app_name']); ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="ext/w3css/w3.css">
		<link rel="stylesheet" href="ext/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="app.css">
		<style>
			html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
		</style>
	</head>
	<body>

			
<?php			
			// Print header if any
			switch($format) {
				case 'List' :
					print_list_header();
					break;
				case 'Card' :
					break;
				case 'Exlibris' :
					$conf = get_conf();
					print_exlibris_header();
					break;
			}
			
			//
			if($book_id == '*') {
				$limit  = 50;
				$offset = 0;
			}

			//
			$trecs = 0;
			$more = true;
			
			while($more) {
				// Read book(s)
				if($book_id == '*') {
					// More than one book
					$result = read_books($offset, $limit, $sort_by, $sort_order, $filters);
				
					// Check result
					if($result['error'] != '') {
						$ret = $result['error'];
						break;
					}
					
					// Get records
					$recs = $result['recs'];
					
					// Update offset and next iteration
					if(count($recs) < $limit) {
						$more = false;
					}
					else {
						$offset += $limit;
					}
				}
				else {
					// Just one book
					$result = read_book_by_id($book_id);
					
					// Check result
					if($result['error'] != '') {
						$ret = $result['error'];
						break;
					}
					
					// Get records
					$recs = $result['recs'];
					
					// Stop next iteration
					$more = false;
				}
				
				// Check result
				if($ret != '') {
					break;
				}

				// Print records
				for($i = 0; $i < count($recs); ++$i) {
					switch($format) {
						case 'List' :
							print_list_book($recs[$i], $trecs);
							break;
						case 'Card' :
							print_card_book($recs[$i], $trecs);
							break;
						case 'Exlibris' :
							print_exlibris_book($recs[$i], $trecs, $conf);
							break;
					}
					
					// Increment # of record
					++$trecs;
				}
			}
			
			// Print footer if any
			switch($format) {
				case 'List' :
					print_list_footer($trecs);
					break;
				case 'Card' :
					break;
				case 'Exlibris' :
					print_exlibris_footer($trecs);
					break;
			}
			
			// End output
?>		
	</body>
</html>			
<?php
		}
		else {
			$ret = 'MissingParameters';
		}
			
		return $ret;
	}
	
	
	//
	$ret = print_books();
	
	if($ret != '') {
		$dashboard_error = $ret;
	}
?>