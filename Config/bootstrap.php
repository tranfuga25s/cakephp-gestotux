<?php
/*!
 * Inicializaciones y configuraciones propias del plugin
 */
 
 // Como no hay un database.php en el plugin, genero la configuracion on-fly
 // ----> Se usa el mismo array que en el database.php
 ConnectionManager::create( 'gestotux',
 	 array(
     'datasource' => 'Database/mysql',
     'persistent' => false,
     'host' => 'trafu.no-ip.org',
     'user' => 'gestotux',
     'password' => 'gestotux',
     'database' => 'gestotux',
     'prefix' => '',
     'encoding' => 'utf8'
	)
 );
 
 /*!
  * Leo la configuración del cliente.
  */
  App::uses( 'IniReader', 'Configure' );
  Configure::config( 'Gestotux', new IniReader( ROOT.DS.APP_DIR.DS.'Plugin'.DS.'gestotux'.DS.'Config'.DS.'cliente' ) );
?>