<?php
/*!
 * Inicializaciones y configuraciones propias del plugin
 */ 
 /*!
  * Leo la configuración del cliente.
  */
  App::uses( 'IniReader', 'Configure' );
  Configure::config( 'Gestotux', new IniReader( ROOT.DS.APP_DIR.DS.'Plugin'.DS.'Gestotux'.DS.'Config'.DS.'cliente' ) );
  Configure::load( '', 'Gestotux' );
?>