<?php

	// ----------------------------
	// MyTreasure: Spanish language
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
		'Database' => 'Base de datos',
		'Users' => 'Usuarios',
		'Books' => 'Libros',
		'Authors' => 'Autores',
		'Publishers' => 'Editoriales',
		'Genres' => 'Géneros',
		'Formats' => 'Formatos',
		'Languages' => 'Idiomas',
		'Locations' => 'Localizaciones',
		'More' => 'Más',
		
		// --- Titles for modals ----------------------------------------------------
		
		'Welcome' => 'Bienvenido/a a '.$CF['app_name'],
		'AboutInfo' => 'Acerca de '.$CF['app_name'],
		'EditConf' => 'Editar configuración',
		'UserInfo' => 'Información del usuario',
		'AddUser' => 'Añadir usuario',
		'EditUser' => 'Editar usuario',
		'DeleteUser' => 'Eliminar usuario',
		'BookInfo' => 'Información del libro',
		'AddBook' => 'Añadir libro',
		'EditBook' => 'Editar libro',
		'DeleteBook' => 'Eliminar libro',
		'PrintBook_s' => 'Imprimir libro(s)',
		'ExportBook_s' => 'Exportar libro(s)',
		'FilterBook_s' => 'Filtrar libro(s)',
		'AuthorInfo' => 'Información del autor',
		'AddAuthor' => 'Añadir autor',
		'EditAuthor' => 'Editar autor',
		'DeleteAuthor' => 'Eliminar autor',
		'PublisherInfo' => 'Información de la editorial',
		'AddPublisher' => 'Añadir editorial',
		'EditPublisher' => 'Editar editorial',
		'DeletePublisher' => 'Eliminar editorial',
		'GenreInfo' => 'Información del género',
		'AddGenre' => 'Añadir género',
		'EditGenre' => 'Editar género',
		'DeleteGenre' => 'Eliminar género',
		'FormatInfo' => 'Información del formato',
		'AddFormat' => 'Añadir formato',
		'EditFormat' => 'Editar formato',
		'DeleteFormat' => 'Eliminar formato',
		'LanguageInfo' => 'Información del idioma',
		'AddLanguage' => 'Añadir idioma',
		'EditLanguage' => 'Editar idioma',
		'DeleteLanguage' => 'Eliminar idioma',
		'LocationInfo' => 'Información de la localización',
		'AddLocation' => 'Añadir localización',
		'EditLocation' => 'Editar localización',
		'DeleteLocation' => 'Eliminar localización',

		// --- Titles for generic actions and buttons -------------------------------
		
		'Configure' => 'Configurar',
		'Add' => 'Añadir',
		'Print' => 'Imprimir',
		'Export' => 'Exportar',
		'Continue' => 'Continuar',
		'Save' => 'Grabar',
		'Cancel' => 'Cancelar',
		'Update' => 'Actualizar',
		'Delete' => 'Eliminar',
		'Filter' => 'Filtrar',
		'Reset' => 'Reiniciar',
		'Login' => 'Entrar',
		
		'Error' => 'Error',
		
		// --- Labels for checkboxes, etc. ------------------------------------------
		
		'Actions' => 'Acciones',
		
		// Questions: the character '*' will be replaced with a record id, name, etc.
		
		'AskDeleteUser' => '¿Está seguro de querer eliminar el usuario "*"?',
		'AskDeleteBook' => '¿Está seguro de querer eliminar el libro "*"?',
		'AskDeleteAuthor' => '¿Está seguro de querer eliminar el autor "*"?',
		'AskDeletePublisher' => '¿Está seguro de querer eliminar la editorial "*"?',
		'AskDeleteGenre' => '¿Está seguro de querer eliminar el género "*"?',
		'AskDeleteFormat' => '¿Está seguro de querer eliminar el formato "*"?',
		'AskDeleteLanguage' => '¿Está seguro de querer eliminar el idioma "*"?',
		'AskDeleteLocation' => '¿Está seguro de querer eliminar la localización "*"?',
		
		// --- Field names ----------------------------------------------------------
		
		'Username' => 'Usuario',
		'Password' => 'Contraseña',
		'Owner' => 'Propietario',
		'Exlibris' => 'Exlibris',
		'Fullname' => 'Nombre completo',
		'Role' => 'Rol',
		'Id' => 'Id',
		'Title' => 'Título',
		'Author' => 'Autor',
		'Author2' => 'Autor nº 2',
		'Author_s' => 'Autor(es)',
		'Genre' => 'Género',
		'Format' => 'Formato',
		'Language' => 'Idioma',
		'Publisher' => 'Editorial',
		'Location' => 'Localización',
		'Borrower' => 'Prestado a',
		'ISBN' => 'ISBN',
		'Summary' => 'Sumario',
		'Name' => 'Nombre',
		
		// --- Selectors ------------------------------------------------------------
		
		'SelectAuthor' => 'Seleccione un autor',
		'SelectGenre' => 'Seleccione un género',
		'SelectPublisher' => 'Selecciona una editorial',
		'SelectFormat' => 'Seleccione un formato',
		'SelectLanguage' => 'Seleccione un idioma',
	
		'SelectExlibris' => 'Seleccione un icono para el exlibris',
		'SelectLocation' => 'Seleccione una localización',
		'SelectRole' => 'Seleccione un rol',
		'SelectFieldSeparator' => 'Seleccione un separador de campo',
		'SelectStringEnclosure' => 'Seleccione un delimitador de cadena',
		'SelectPrintFormat' => 'Seleccione un formato de impresión',
		'SelectExportFormat' => 'Seleccione un formato de exportación',
		
		// --- Selector options -----------------------------------------------------
		
		'SelOptComma' => 'coma',
		'SelOptSemicolon' => 'punto y coma',
		'SelOptSingleQuote' => 'comilla sencilla',
		'SelOptDoubleQuote' => 'comilla doble',
		'SelOptTab' => 'tabulador',
		'SelOptCSV' => 'valores separados por comas',
		'SelOptList' => 'Lista',
		'SelOptCard' => 'Tarjeta',
		'SelOptExlibris' => 'Exlibris',
		
		// --- Reports --------------------------------------------------------------
		
		'TotalBooks' => 'Nº total de libros:',
		
		// --- Errors ---------------------------------------------------------------
		
		'MissingParameters' => 'Faltan algunos parámetros.',
		
		'CantReadConf' => 'No se ha podido leer la configuración.',
		'CantAddConf' => 'No se ha podido añadir la configuración.',
		'CantUpdateConf' => 'No se ha podido actualizar la configuración.',
		
		'UserNotExists' => 'El usuario no existe.',
		'UserAlreadyExists' => 'El usuario ya existe.',
		'CantReadUsers' => 'No se ha podido leer los usuarios.',
		'CantAddUser' => 'No se ha podido añadir el usuario.',
		'CantUpdateUser' => 'No se ha podido actualizar el usuario.',
		'CantDeleteUser' => 'No se ha podido eliminar el usuario.',
		
		'LanguageAlreadyExists' => 'El idioma ya existe.',
		'CantReadLanguage' => 'No se ha podido leer los idiomas.',
		'CantAddLanguage' => 'No se ha podido añadir el lenguaje.',
		'CantUpdateLanguage' => 'No se ha podido actualizar el idioma.',
		'CantDeleteLanguage' => 'No se ha podido eliminar el idioma.',
		
		'LocationAlreadyExists' => 'La localización ya existe.',
		'CantReadLocation' => 'No se ha podido leer las localizaciones.',
		'CantAddLocation' => 'No se ha podido añadir la localización.',
		'CantUpdateLocation' => 'No se ha podido actualizar la localización.',
		'CantDeleteLocation' => 'No se ha podido eliminar la localización.',
		
		'CantReadBooks' => 'No se ha podido leer los libros.',
		'CantAddBook' => 'No se ha podido añadir el libro.',
		'CantUpdateBook' => 'No se ha podido actualizar el libro.',
		'CantDeleteBook' => 'No se ha podido eliminar el libro.',
		
		'AuthorAlreadyExists' => 'El autor ya existe.',
		'CantReadAuthors' => 'No se ha podido leer los autores.',
		'CantAddAuthor' => 'No se ha podido leer el autor.',
		'CantUpdateAuthor' => 'No se ha podido actualizar el autor.',
		'CantDeleteAuthor' => 'No se ha podido eliminar el autor.',
		
		'PublisherAlreadyExists' => 'La editorial ya existe.',
		'CantReadPublishers' => 'No se ha podido leer las editoriales.',
		'CantAddPublisher' => 'No se ha podido añadir la editorial.',
		'CantUpdatePublisher' => 'No se ha podido actualizar la editorial.',
		'CantDeletePublisher' => 'No se ha podido eliminar la editorial.',
	
		'GenreAlreadyExists' => 'El género ya existe.',
		'CantReadGenres' => 'No se ha podido leer los géneros.',
		'CantAddGenre' => 'No se ha podido añadir el género.',
		'CantUpdateGenre' => 'No se ha podido actualizar el género.',
		'CantDeleteGenre' => 'No se ha podido eliminar el género.',
		
		'FormatAlreadyExists' => 'El formato ya existe.',
		'CantReadFormat' => 'No se ha podido leer los formatos.',
		'CantAddFormat' => 'No se ha podido añadir el formato.',
		'CantUpdateFormat' => 'No se ha podido actualizar el formato.',
		'CantDeleteFormat' => 'No se ha podido eliminar el formato.',
		
		// --- Other ----------------------------------------------------------------
		
		'AboutText' => 'Un gestor de biblioteca para gente que ama los libros y los quiere organizados.',
		'AllRightsReserved' => 'Todos los derechos reservados.',
		
		// --- Nice Table -----------------------------------------------------------
		
		'NiceTableShow' => 'Mostrar',
		'NiceTableEntries' => 'entradas',
		'NiceTablePage' => 'Página',
		'NiceTableOf' => 'de',
		
		// --- END ------------------------------------------------------------------
		
		'NotAvailable' => 'n/d'
	);
?>