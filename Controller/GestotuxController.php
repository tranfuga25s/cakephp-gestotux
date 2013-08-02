<?php

App::uses( 'CakeEmail', 'Network/Email' );

class GestotuxController extends GestotuxAppController {

	public $uses = array( 'Gestotux.Cliente', 'Gestotux.Ctacte', 'Gestotux.ItemCtacte', 'Gestotux.Servicio' );
	public $helpers = array( 'Number' );

	public function beforeFilter() {
		$this->necesitaConexion();
		parent::beforeFilter();
		$this->Auth->allow( array( 'precio' ) );
	}

	/**
	 * Funcion para mostrar el listado de precios del sistema que está elegido
	 * @param id_servicio Identificador del servicio
	 * @author Esteban Zeller
	 */
	public function precio( $id_servicio = null ) {
		$this->Servicio->id = $id_servicio;
		if( !$this->Servicio->exists() ) {
			throw new NotFoundException( "El Servicio que está buscando no existe en nuestra base de datos" );
		}
		if ($this->request->is('requested')) {
			return $this->Servicio->field( 'precio_base' );
		}
		$this->set( 'servicio', $this->Servicio->read( null, $id_servicio ) );
	}

   /*!
    * Accion de "Mi Cuenta"
    */
    public function administracion_index() {
        // busco el saldo de la cuenta corriente
        $id_cliente = intval( Configure::read( "Gestotux.cliente" ) );
        $this->loadModel( 'Gestotux.Cliente' );
        $this->Cliente->id = $id_cliente;
        if( !$this->Cliente->exists() ) {
            throw new NotFoundException( "El cliente #".$id_cliente." no existe!" );
        }
        $this->set( 'saldo', $this->Ctacte->obtenerSaldo( $id_cliente ) );
        $this->set( 'servicio', $this->Servicio->read( null, $id_cliente ) );
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
					$cliente = $this->Cliente->read( null, intval( Configure::read( "Gestotux.cliente" ) ) );
					$data = $this->data['informepago'];
					$email = new CakeEmail();
					$email->template( 'Gestotux.informepago', 'Gestotux.default' );
					$email->addTo( 'esteban.zeller@gmail.com' );
					$email->subject( "Informe de pago de ".$cliente['Cliente']['razon_social'] );
					$email->from( $cliente['Cliente']['email'] );
					$email->addAttachments( array( $this->data['informepago']['adjunto']['name'] => $this->data['informepago']['adjunto']['tmp_name'] ) );
					$email->viewVars(
						array( 'cliente' => $cliente['Cliente'],
							   'importe' => $data['importe'],
							   'aclaracion' => $data['texto'],
							   'tipo' => $data['tipo'] )
					);
					$email->send();
					$this->Session->setFlash( "Su informe de pago ha sido enviado. Le responderemos a la brevedad.", 'default', array( 'class' => 'success' ) );
					$this->redirect( array( 'plugin' => 'gestotux', 'controller' => 'gestotux', 'action' => 'index' ) );
				} else {
					$this->Session->setFlash( "No se pudo subir correctamente el archivo adjunto.", 'default', array( 'class' => 'error' ) );
				}
			} else {
				$this->Session->setFlash( "Por favor, ingrese un importe que sea un número.", 'default', array( 'class' => 'error' ) );
			}
		}
		$id_cliente = intval( Configure::read( "Gestotux.cliente" ) );
		$this->set( 'id_cliente', $id_cliente );
		$cliente = $this->Cliente->read( null, $id_cliente );
		$this->set( 'razon_social', $cliente['Cliente']['razon_social'] );
		$tmp = $this->Ctacte->find( 'first', array( 'conditions' => array( 'id_cliente' => $id_cliente ),
													'recursive' => -1,
													'fields' => array( 'numero_cuenta' ) ) );
		$this->set( 'nctacte', $tmp['Ctacte']['numero_cuenta'] );
	}

   /*!
    * Listado de cuenta corriente correspondiente al cliente
    */
	public function administracion_verctacte() {
		$id_cliente = intval( Configure::read( "Gestotux.cliente" ) );
		$tmp = $this->Ctacte->find( 'first', array( 'conditions' => array( 'id_cliente' => $id_cliente ),
													'recursive' => -1,
													'fields' => array( 'numero_cuenta' ) ) );
		$idctacte = $tmp['Ctacte']['numero_cuenta'];
		unset( $tmp );
		// Busco la cuenta corriente para el cliente
		$this->set( 'lista', $this->ItemCtacte->find( 'all', array( 'conditions' => array( 'id_ctacte' => $idctacte ) ) ) );
		$this->set( 'saldo_actual', $this->Ctacte->obtenerSaldo( $id_cliente ) );
	}

   /*!
    * Function de envió de consulta administrativa
    */
	public function administracion_consulta() {
		if( $this->request->isPost() ) {
			$this->Cliente->recursive = -1;
			$cliente = $this->Cliente->read( null, intval( Configure::read( "Gestotux.cliente" ) ) );
			$data = $this->data['consulta'];
			$email = new CakeEmail();
			$email->template( 'Gestotux.consulta', 'Gestotux.default' );
			$email->addTo( 'esteban.zeller@gmail.com' );
			$email->subject( "Consulta Administrativa de ".$cliente['Cliente']['razon_social'] );
			$email->from( $cliente['Cliente']['email'] );
			$email->viewVars( array( 'cliente' => $cliente['Cliente'], 'texto' => $data['texto'] ) );
			$email->send();
			$this->Session->setFlash( "Su consulta ha sido enviada. Le responderemos a la brevedad", 'default', array( 'class' => 'success' ) );
			$this->redirect( array( 'plugin' => 'gestotux', 'controller' => 'gestotux', 'action' => 'index' ) );
		}
		$id_cliente = intval( Configure::read( "Gestotux.cliente" ) );
		$this->set( 'id_cliente', $id_cliente );
		$cliente = $this->Cliente->read( null, $id_cliente );
		$this->set( 'razon_social', $cliente['Cliente']['razon_social'] );
	}

   /*!
    * Functión de dar de baja el servicio que está corriendo
    */
	public function administracion_darbaja() {
		if( $this->request->isPost() ) {

		}
		$this->loadModel( 'Gestotux.Cliente' );
		$id_cliente = intval( Configure::read( "Gestotux.cliente" ) );
		$cliente = $this->Cliente->read( null, $id_cliente );
		$this->loadModel( 'Gestotux.Servicio' );
		$servicio = $this->Servicio->read( null, intval( Configure::read( "Gestotux.servicio" ) ) );
		$this->set( 'servicio', $servicio );
		$this->set( 'cliente', $cliente );
	}
}

?>