<?php

class GestotuxController extends GestotuxAppController {
	
	public $uses = array( 'Gestotux' );

   /*!
    * Accion de "Mi Cuenta"
    */
	public function administracion_index() {
		// busco el saldo de la cuenta corriente
		$this->set( 'saldo', $this->Cliente->obtenerSaldo( Configure::read( "Gestotux.cliente" ) ) );
	}
	
	public function administracion_informapago() {
		
	}
	
	public function administracion_verctacte() {
		$id_cliente = Configure::read( "Gestotux.cliente" );
		$this->loadModel( 'Ctacte' );
		$tmp = $this->Ctacte->find( 'first', array( 'conditions' => array( 'id_cliente' => $id_cliente ),
													'recursive' => -1,
													'fields' => array( 'numero_cuenta' ) ) );
		$idctacte = $tmp['Ctacte']['numero_cuenta'];
		unset( $tmp ); unset( $id_cliente );
		// Busco la cuenta corriente para el cliente
		$this->loadModel( 'ItemCtacte' );
		$this->set( 'lista', $this->ItemCtacte->find( 'all', array( 'conditions' => array( 'id_ctacte' => $idctacte ) ) ) );
	}
	
	public function administracion_consulta() {
		
	}
	
	public function administracion_darbaja() {
		
	}
}

?>