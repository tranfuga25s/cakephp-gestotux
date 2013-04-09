<?php
App::uses( 'ConnectionManager', 'Model' );

class GestotuxAppController extends AppController {
	
	public function necesitaConexion() {
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
	}
}

?>