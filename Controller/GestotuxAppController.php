<?php

App::uses( 'ConnectionManager', 'Model' );

class GestotuxAppController extends AppController {
	
	public function necesitaConexion() {
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
	}
}

?>