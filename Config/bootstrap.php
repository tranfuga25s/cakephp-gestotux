<?php
 /*!
  * Inicializaciones y configuraciones propias del plugin
  */
  App::uses( 'ConnectionManager', 'Model' );
	ConnectionManager::create( 'gestotux',
	 array(
	     'datasource' => 'Database/Mysql',
	     'persistent' => false,
	     'host' => 'trafu.no-ip.org',
	     'login' => 'gestotux',
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
  Configure::config( 'Gestotux', new IniReader( ROOT.DS.APP_DIR.DS.'Plugin'.DS.'Gestotux'.DS.'Config'.DS.'cliente' ) );
  Configure::load( '', 'Gestotux' );
?>