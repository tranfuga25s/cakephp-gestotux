<?php

App::uses( 'CakeEmail', 'Network/Email' );

class GestotuxController extends GestotuxAppController {
	
	public $uses = array( 'Gestotux.Cliente', 'Gestotux.Ctacte', 'Gestotux.ItemCtacte' );

   /*!
    * Accion de "Mi Cuenta"
    */
	public function administracion_index() {
		$this->necesitaConexion();
		// busco el saldo de la cuenta corriente
		$this->set( 'saldo', $this->Ctacte->obtenerSaldo( intval( Configure::read( "Gestotux.cliente" ) ) ) );
	}

   /*!
    * Generación de la pagina de informe de pago
    */	
	public function administracion_informapago() {
		if( $this->request->isPost() ) {
			if( is_numeric( $this->data['informepago']['importe'] ) ) {
				if( ( $this->data['informepago']['adjunto']['error'] ==  UPLOAD_ERR_OK &&
				    $this->data['informepago']['adjunto']['size'] != 0 ) ||
					( $this->data['informepago']['adjunto']['error'] == UPLOAD_ERR_NO_FILE ) ) {
					///@todo Revisar tipo!
					$this->necesitaConexion();
					$this->loadModel( 'Cliente' );
					$cliente = $this->Cliente->read( null, intval( Configure::read( "Gestotux.cliente" ) ) );
					$data = $this->data['infomepago'];
					$email = new CakeEmail();
					$email->addTo( 'esteban.zeller@gmail.com' );
					$email->subject( "Informe de pago de ".$cliente['Cliente']['razon_social'] );
					$email->from( $cliente['Cliente']['email'] );
					$email->addAttachments( $this->data['informepago']['adjunto']['tmp_name'] );
					$email->viewVars( 
						array( 'cliente' => $cliente['Cliente'], 
							   'importe' => $data['importe'],
							   'aclaracion' => $data['texto'],
							   'adjunto' => $data['adjunto'],
							   'tipo' => $data['tipo'] )
					);
				} else {
					///@todo Agregar Errores de validación error al subir el archivo
				}
			} else {
				///@todo Agregar Errores de validación error importe no numerico
			}
		}
		$this->necesitaConexion();
		$this->loadModel( 'Cliente' );
		$id_cliente = intval( Configure::read( "Gestotux.cliente" ) );
		$cliente = $this->Cliente->read( null, $id_cliente );
		$this->set( 'razon_social', $cliente['Cliente']['razon_social'] );
		$this->loadModel( 'Ctacte' );
		$tmp = $this->Ctacte->find( 'first', array( 'conditions' => array( 'id_cliente' => $id_cliente ),
													'recursive' => -1,
													'fields' => array( 'numero_cuenta' ) ) );
		$this->set( 'nctacte', $tmp['Ctacte']['numero_cuenta'] );
	}
	
   /*!
    * Listado de cuenta corriente correspondiente al cliente
    */	
	public function administracion_verctacte() {
		$this->necesitaConexion();
		$id_cliente = intval( Configure::read( "Gestotux.cliente" ) );
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

   /*!
    * Function de envió de consulta administrativa
    */	
	public function administracion_consulta() {
		
	}
	
   /*!
    * Functión de dar de baja el servicio que está corriendo
    */	
	public function administracion_darbaja() {
		
	}
}

?>