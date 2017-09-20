<?php
  
	// --------------------------------------------------
	// MyTreasure: Populate exlibris icons in html select
	// --------------------------------------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function populate_exlibris($selected_id = null) {

		//
		$utf8_icons = array(
			array(9728, 9731),
			array(9733, 9734),
			array(9742, 9743),
			array(9748, 9749)
		);
		
		//
		echo('<option value="" '.($selected_id == null ? 'selected ' : '').'disabled>'.tr('SelectExlibris').'</option>');
		
		for($i = 0; $i < count($utf8_icons); ++$i) {
			$utf8_from = $utf8_icons[$i][0];
			$utf8_to   = $utf8_icons[$i][1];
			
			for($k = $utf8_from; $k <= $utf8_to; ++$k) {
				echo('<option class="w3-xlarge" value="'.$k.'"'.($k == $selected_id ? ' selected' : '').'>&#'.$k.';</option>'."\n");
			}
		}
	}
?>