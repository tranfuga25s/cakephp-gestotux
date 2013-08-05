<?php
App::uses('GestotuxAppController', 'Gestotux.Controller');
/**
 * ConteoSms Controller
 * @property ConteoSms ConteoSms
 */
class ConteoSmsController extends GestotuxAppController {

    /**
     * Modelo de conteo de sms
     *
     * @var ConteoSms ConteoSms
     */
	public $uses = array( 'Gestotux.ConteoSms' );
    
    public function beforeFilter() {
        $id_cliente = intval( Configure::read( 'Gestotux.cliente' ) );
        $this->ConteoSms->setearCliente( $id_cliente );
        parent::beforeFilter();
    }
    
    public function index() {
        $this->set( 'enviados', $this->ConteoSms->cantidadEnviada() );
        $this->set( 'recibidos', $this->ConteoSms->cantidadRecibidos() );
        $this->set( 'costo', $this->ConteoSms->costoMensaje() );
    }

}
