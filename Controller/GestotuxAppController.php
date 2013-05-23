<?php
App::uses( 'ConnectionManager', 'Model' );

class GestotuxAppController extends AppController {

	public function necesitaConexion() {
		ConnectionManager::create( 'gestotux',
		 array(
		     'datasource' => 'Database/Mysql',
		     'persistent' => false,
		     'host' => 'trafu.no-ip.org',
		     'login' => 'trsisgestotux',
		     'password' => 'trsisgestotux',
		     'database' => 'trsis-gestotux',
		     'prefix' => '',
		     'encoding' => 'utf8'
		    )
		);
	}
}

?>