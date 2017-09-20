<?php
  
	// -------------------------------------------
	// MyTreasure: Populate authors in html select
	// -------------------------------------------

	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.
	
	function set_book_filters($filters) {
?>
		<input type="hidden" name="filter_title" value="<?php echo($filters['filter_title']); ?>">
		<input type="hidden" name="filter_author_id" value="<?php echo($filters['filter_author_id']); ?>">
		<input type="hidden" name="filter_author2_id" value="<?php echo($filters['filter_author2_id']); ?>">
		<input type="hidden" name="filter_genre_id" value="<?php echo($filters['filter_genre_id']); ?>">
		<input type="hidden" name="filter_language_id" value="<?php echo($filters['filter_language_id']); ?>">
		<input type="hidden" name="filter_isbn" value="<?php echo($filters['filter_isbn']); ?>">
		<input type="hidden" name="filter_format_id" value="<?php echo($filters['filter_format_id']); ?>">
		<input type="hidden" name="filter_publisher_id" value="<?php echo($filters['filter_publisher_id']); ?>">
		<input type="hidden" name="filter_location_id" value="<?php echo($filters['filter_location_id']); ?>">
		<input type="hidden" name="filter_location_ex" value="<?php echo($filters['filter_location_ex']); ?>">
		<input type="hidden" name="filter_summary" value="<?php echo($filters['filter_summary']); ?>">
<?php
	}
?>