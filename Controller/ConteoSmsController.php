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
        $this->necesitaConexion();
        $id_cliente = intval( Configure::read( 'Gestotux.cliente' ) );
        $this->ConteoSms->setearCliente( $id_cliente );
        parent::beforeFilter();
    }
    
    public function isAuthorized( $usuario = null ) {
        switch( $usuario['grupo_id'] ) {
            case 1: // Administradores
            {
                return true;
                break;
            }
            case 2: // Medicos
            case 3: // Secretarias
            {
                switch( $this->request->params['actions'] ) {
                    case 'administracion_view':
                    case 'administracion_edit':
                    case 'administracion_index':
                    { return true; break; }
                }
                // saco el break y el default para que autorize a los permisos de el usuario normal
            }
            case 4: // Usuario normal
            {
                switch( $this->request->params['actions'] ) {
                    case 'clinicasInicio':
                    case 'view':
                    case 'cargarDatosClinicas':
                    { return true; break; }
                    default:
                    { return false; break; }
                }
                break;
            }
        }
        return false;
    }
    
    public function index() {
        $this->set( 'enviados', $this->ConteoSms->cantidadEnviada() );
        $this->set( 'recibidos', $this->ConteoSms->cantidadRecibida() );
        $this->set( 'costo', $this->ConteoSms->costoMensaje() );
    }
    
    public function administracion_index() {
        if( $this->request->is('requested') ) {
            return array(
                'enviados' => $this->ConteoSms->cantidadEnviada(),
                'recibidos' => $this->ConteoSms->cantidadRecibida(),
                'costo' => $this->ConteoSms->costoMensaje()
            );
        } else {
            $this->set( 'enviados', $this->ConteoSms->cantidadEnviada() );
            $this->set( 'recibidos', $this->ConteoSms->cantidadRecibida() );
            $this->set( 'costo', $this->ConteoSms->costoMensaje() );
        }
    }

}
