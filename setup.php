<?php


// MODULE CONFIGURATION DEFINITION
$config = array();
$config['mod_name'] = 'exercicio';		// name the module
$config['mod_version'] = '1.0.0';		// add a version number
$config['mod_directory'] = 'exercicio';		// tell dotProject where to find this module
$config['mod_setup_class'] = 'CSetupClientes';	// the name of the PHP setup class (used below)
$config['mod_type'] = 'user';			// 'core' for modules distributed with dP by standard, 'user' for additional modules from dotmods
$config['mod_ui_name'] = 'exercicio';		// the name that is shown in the main menu of the User Interface
//$config['mod_ui_icon'] = 'communicate.gif';	// name of a related icon
//$config['mod_description'] = '...';	// some description of the module
$config['mod_config'] = true;			// show 'configure' link in viewmods
$config['mod_description'] = 'exercicio';

// show module configuration with the dPframework (if requested via http)
if (@$a == 'setup') {
	echo dPshowModuleConfig( $config );
}

class CSetupClientes {

	function configure() {		// configure this module
	global $AppUI;
		$AppUI->redirect( 'm=clientes&a=configure' );	// load module specific configuration page
  		return true;
	}

	function remove() {		// run this method on uninstall process
		//db_exec( "DROP TABLE einstein;" );	// remove the einstein table from database

		return null;
	}


	function upgrade( $old_version ) {	// use this to provide upgrade functionality between different versions; not relevant here

		switch ( $old_version )
		{
		case "all":		// upgrade from scratch (called from install)
		case "0.9":
			//do some alter table commands

		case "1.0":
			return true;

		default:
			return false;
		}

		return false;
	}

	function install() {
/*		$sql = "CREATE TABLE einstein ( " .					// prepare the creation of a dbTable
			"  einstein_id int(11) unsigned NOT NULL auto_increment" .
			", einstein_quote text" .
			", PRIMARY KEY  (einstein_id)" .
			", UNIQUE KEY einstein_id (einstein_id)" .
			") TYPE=MyISAM;";

		db_exec( $sql ); db_error();						// execute the queryString
*/
		return null;
	}

}

?>
