<?php

	// ----------------------------
	// MyTreasure: English language
	// ----------------------------
	
	// (c) 2017 Miguel Garcia / FloppySoftware
	//
	// http://www.floppysoftware.es
	// floppysoftware@gmail.com
	//
	// Released under the GNU General Public License v3.

	$LG = array(
	
		// --- Titles for menu options and sections ---------------------------------

		'Menu' => 'Menu',
		'Database' => 'Database',
		'Users' => 'Users',
		'Books' => 'Books',
		'Authors' => 'Authors',
		'Publishers' => 'Publishers',
		'Genres' => 'Genres',
		'Formats' => 'Formats',
		'Languages' => 'Languages',
		'Locations' => 'Locations',
		'More' => 'More',
		
		// --- Titles for modals ----------------------------------------------------
		
		'Welcome' => 'Welcome to '.$CF['app_name'],
		'AboutInfo' => 'About '.$CF['app_name'],
		'EditConf' => 'Edit configuration',
		'UserInfo' => 'User information',
		'AddUser' => 'Add user',
		'EditUser' => 'Edit user',
		'DeleteUser' => 'Delete user',
		'BookInfo' => 'Book information',
		'AddBook' => 'Add book',
		'EditBook' => 'Edit book',
		'DeleteBook' => 'Delete book',
		'PrintBook_s' => 'Print book(s)',
		'ExportBook_s' => 'Export book(s)',
		'FilterBook_s' => 'Filter book(s)',
		'AuthorInfo' => 'Author information',
		'AddAuthor' => 'Add author',
		'EditAuthor' => 'Edit author',
		'DeleteAuthor' => 'Delete author',
		'PublisherInfo' => 'Publisher information',
		'AddPublisher' => 'Add publisher',
		'EditPublisher' => 'Edit publisher',
		'DeletePublisher' => 'Delete publisher',
		'GenreInfo' => 'Genre information',
		'AddGenre' => 'Add genre',
		'EditGenre' => 'Edit genre',
		'DeleteGenre' => 'Delete genre',
		'FormatInfo' => 'Format information',
		'AddFormat' => 'Add format',
		'EditFormat' => 'Edit format',
		'DeleteFormat' => 'Delete format',
		'LanguageInfo' => 'Language information',
		'AddLanguage' => 'Add language',
		'EditLanguage' => 'Edit language',
		'DeleteLanguage' => 'Delete language',
		'LocationInfo' => 'Location information',
		'AddLocation' => 'Add location',
		'EditLocation' => 'Edit location',
		'DeleteLocation' => 'Delete location',

		// --- Titles for generic actions and buttons -------------------------------
		
		'Configure' => 'Configure',
		'Add' => 'Add',
		'Print' => 'Print',
		'Export' => 'Export',
		'Continue' => 'Continue',
		'Save' => 'Save',
		'Cancel' => 'Cancel',
		'Update' => 'Update',
		'Delete' => 'Delete',
		'Filter' => 'Filter',
		'Reset' => 'Reset',
		'Login' => 'Login',
		
		'Error' => 'Error',
		
		// --- Labels for checkboxes, etc. ------------------------------------------
		
		'Actions' => 'Actions',

		
		// Questions: the character '*' will be replaced with a record id, name, etc.
		
		'AskDeleteUser' => 'Are you sure do you want to delete the user "*"?',
		'AskDeleteBook' => 'Are you sure do you want to delete the book "*"?',
		'AskDeleteAuthor' => 'Are you sure do you want to delete the author "*"?',
		'AskDeletePublisher' => 'Are you sure do you want to delete the publisher "*"?',
		'AskDeleteGenre' => 'Are you sure do you want to delete the genre "*"?',
		'AskDeleteFormat' => 'Are you sure do you want to delete the format "*"?',
		'AskDeleteLanguage' => 'Are you sure do you want to delete the language "*"?',
		'AskDeleteLocation' => 'Are you sure do you want to delete the location "*"?',
		
		// --- Field names ----------------------------------------------------------
		
		'Username' => 'Username',
		'Password' => 'Password',
		'Owner' => 'Owner',
		'Exlibris' => 'Exlibris',
		'Fullname' => 'Full name',
		'Role' => 'Role',
		'Id' => 'Id',
		'Title' => 'Title',
		'Author' => 'Author',
		'Author2' => 'Author #2',
		'Author_s' => 'Author(s)',
		'Genre' => 'Genre',
		'Format' => 'Format',
		'Language' => 'Language',
		'Publisher' => 'Publisher',
		'Location' => 'Location',
		'Borrower' => 'Borrower',
		'ISBN' => 'ISBN',
		'Summary' => 'Summary',
		'Name' => 'Name',
		
		// --- Selectors ------------------------------------------------------------
		
		'SelectAuthor' => 'Select an author',
		'SelectGenre' => 'Select a genre',
		'SelectPublisher' => 'Select a publisher',
		'SelectFormat' => 'Select a format',
		'SelectLanguage' => 'Select a language',
	
		'SelectExlibris' => 'Select a exlibris icon',
		'SelectLocation' => 'Select a location',
		'SelectRole' => 'Select a role',
		'SelectFieldSeparator' => 'Select a field separator',
		'SelectStringEnclosure' => 'Select a field enclosure',
		'SelectPrintFormat' => 'Select a print format',
		'SelectExportFormat' => 'Select an export format',
		
		// --- Selector options -----------------------------------------------------
		
		'SelOptComma' => 'comma',
		'SelOptSemicolon' => 'semicolon',
		'SelOptSingleQuote' => 'single quote',
		'SelOptDoubleQuote' => 'double quote',
		'SelOptTab' => 'tab',
		'SelOptCSV' => 'comma separated values',
		'SelOptList' => 'List',
		'SelOptCard' => 'Card',
		'SelOptExlibris' => 'Exlibris',
		
		// --- Reports --------------------------------------------------------------
		
		'TotalBooks' => 'Total number of books:',
		
		// --- Errors ---------------------------------------------------------------
		
		'MissingParameters' => 'There are some missing parameters.',
		
		'CantReadConf' => 'Can\'t read configuration.',
		'CantAddConf' => 'Can\'t add configuration.',
		'CantUpdateConf' => 'Can\'t update configuration.',
		
		'UserNotExists' => 'User not exists.',
		'UserAlreadyExists' => 'User already exists.',
		'CantReadUsers' => 'Can\' read users.',
		'CantAddUser' => 'Can\'t add user.',
		'CantUpdateUser' => 'Can\'t update user.',
		'CantDeleteUser' => 'Can\'t delete user.',
		
		'LanguageAlreadyExists' => 'Language already exists.',
		'CantReadLanguage' => 'Can\'t read languages.',
		'CantAddLanguage' => 'Can\'t add language.',
		'CantUpdateLanguage' => 'Can\'t update language.',
		'CantDeleteLanguage' => 'Can\'t delete language.',
		
		'LocationAlreadyExists' => 'Location already exists.',
		'CantReadLocation' => 'Can\'t read locations.',
		'CantAddLocation' => 'Can\'t add location.',
		'CantUpdateLocation' => 'Can\'t update location.',
		'CantDeleteLocation' => 'Can\'t delete location.',
		
		'CantReadBooks' => 'Can\'t read books.',
		'CantAddBook' => 'Can\'t add book.',
		'CantUpdateBook' => 'Can\'t update book.',
		'CantDeleteBook' => 'Can\'t delete book.',
		
		'AuthorAlreadyExists' => 'Author already exists.',
		'CantReadAuthors' => 'Can\'t read authors.',
		'CantAddAuthor' => 'Can\'t add author.',
		'CantUpdateAuthor' => 'Can\'t update author.',
		'CantDeleteAuthor' => 'Can\'t delete author.',
		
		'PublisherAlreadyExists' => 'Publisher already exists.',
		'CantReadPublishers' => 'Can\'t read publishers.',
		'CantAddPublisher' => 'Can\'t add publisher.',
		'CantUpdatePublisher' => 'Can\'t update publisher.',
		'CantDeletePublisher' => 'Can\'t delete publisher.',
	
		'GenreAlreadyExists' => 'Genre already exists.',
		'CantReadGenres' => 'Can\'t read genres.',
		'CantAddGenre' => 'Can\'t add genre.',
		'CantUpdateGenre' => 'Can\'t update genre.',
		'CantDeleteGenre' => 'Can\'t delete genre.',
		
		'FormatAlreadyExists' => 'Format already exists.',
		'CantReadFormat' => 'Can\'t read format.',
		'CantAddFormat' => 'Can\'t add format.',
		'CantUpdateFormat' => 'Can\'t update format.',
		'CantDeleteFormat' => 'Can\'t delete format.',
		
		// --- Other ----------------------------------------------------------------
		
		'AboutText' => 'A library manager for people who love books and want them organized.',
		'AllRightsReserved' => 'All rights reserved.',
		
		// --- Nice Table -----------------------------------------------------------
		
		'NiceTableShow' => 'Show',
		'NiceTableEntries' => 'entries',
		'NiceTablePage' => 'Page',
		'NiceTableOf' => 'of',
		
		// --- END ------------------------------------------------------------------
		
		'NotAvailable' => 'n/a'
	);
?>