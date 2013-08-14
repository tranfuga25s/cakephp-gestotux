<?php
App::uses('GestotuxAppModel', 'Gestotux.Model');
/**
 * Sm Model
 *
 */
class ConteoSms extends GestotuxAppModel {

    /**
     * Primary key field
     *
     * @var string
     */
	public $primaryKey = 'id_conteo_sms';


    public $useDbConfig = 'default';
    /**
     * Validation rules
     *
     * @var array
     */
	public $validate = array(
		'fecha' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'envios' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'recibidos' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

    private $_id_cliente = null;

    public function setearCliente( $id_cliente = null ) {
        if( $id_cliente != null ) {
            $this->_id_cliente = $id_cliente;
        }
    }

    public function cantidadEnviada( $fecha = null ) {
        if( is_null( $this->_id_cliente ) ) {
            return 0;
        }

        $condicion_fecha = array( '`ConteoSms`.`fecha` = DATE( NOW() )' );
        if( !is_null( $fecha ) ) {
            if( is_array( $fecha ) ) {
                $condicion_fecha = array( '`ConteoSms`.`fecha` BETWEEN ? AND ? ' => array( $fecha['inicio'], $fecha['fin'] ) );
            } else {
                $condicion_fecha = array( '`ConteoSms`.`fecha`' => $fecha );
            }
        }

        $data = $this->find( 'first', array( 'conditions' => array( '`ConteoSms`.`cliente_id`' => $this->_id_cliente, $condicion_fecha ),
                                            'fields' => array( 'envios' ),
                                            'recursive' => -1 ) );
        if( array_key_exists( 'ConteoSms', $data ) ) {
            return $data['ConteoSms']['envios'];
        }
        return 0;
    }

    public function cantidadRecibida( $fecha = null ) {
        if( is_null( $this->_id_cliente ) ) {
            return 0;
        }

        $condicion_fecha = 'fecha = DATE( NOW() )';
        if( !is_null( $fecha ) ) {
            if( is_array( $fecha ) ) {
                $condicion_fecha = array( '`ConteoSms`.`fecha` BETWEEN ? AND ? ' => array( $fecha['inicio'], $fecha['fin'] ) );
            } else {
                $condicion_fecha = array( 'fecha' => $fecha );
            }
        }

        $data = $this->find( 'first', array( 'conditions' => array( 'cliente_id' => $this->_id_cliente, $condicion_fecha ),
                                            'fields' => array( 'recibidos' ),
                                            'recursive' => -1 ) );
        if( array_key_exists( 'ConteoSms', $data ) ) {
            return $data['ConteoSms']['recibidos'];
        }
        return 0;
    }

    public function agregarEnviado( $fecha = null, $cantidad = 1 ) {
        if( is_null( $this->_id_cliente ) ) {
            return false;
        }

        $condicion_fecha = '`ConteoSms`.`fecha` = DATE( NOW() )';
        if( $fecha != null ) {
            $condicion_fecha = array( '`ConteoSms`.`fecha`' => $fecha );
        }

        $datos = $this->find( 'first',
            array( 'conditions' => array( '`ConteoSms`.`cliente_id`' => $this->_id_cliente, $condicion_fecha ),
                   'fields'     => array( 'id_conteo_sms', 'envios' ) ) );
        $cantidad_anterior = intval( $datos['ConteoSms']['envios'] );
        $this->id = $datos['ConteoSms']['id_conteo_sms'];
        unset( $datos );
        if( $this->exists() ) {
            $nueva_cantidad = $cantidad_anterior + $cantidad;
            if( $this->saveField( 'envios', $nueva_cantidad ) ) {
                return true;
            }
        }
        return false;
    }

    public function agregarRecibido( $fecha = null, $cantidad = 1 ) {
        if( is_null( $this->_id_cliente ) ) {
            return false;
        }

        $condicion_fecha = '`ConteoSms`.`fecha` = DATE( NOW() )';
        if( $fecha != null ) {
            $condicion_fecha = array( '`ConteoSms`.`fecha`' => $fecha );
        }

        $datos = $this->find( 'first',
            array( 'conditions' => array( '`ConteoSms`.`cliente_id`' => $this->_id_cliente, $condicion_fecha ),
                   'fields'     => array( 'id_conteo_sms', 'recibidos' ) ) );

        $cantidad_anterior = intval( $datos['ConteoSms']['recibidos'] );
        $this->id = $datos['ConteoSms']['id_conteo_sms'];
        unset( $datos );
        if( $this->exists() ) {
            $nueva_cantidad = $cantidad_anterior + $cantidad;
            if( $this->saveField( 'recibidos', $nueva_cantidad ) ) {
                return true;
            }
        }
        return false;
    }
    
    public function costoMensaje( $fecha = null ) {
        if( is_null( $this->_id_cliente ) ) {
            return 0.0;
        }

        $condicion_fecha = 'fecha = DATE( NOW() )';
        if( !is_null( $fecha ) ) {
            if( is_array( $fecha ) ) {
                $condicion_fecha = array( '`ConteoSms`.`fecha` BETWEEN ? AND ? ' => array( $fecha['inicio'], $fecha['fin'] ) );
            } else {
                $condicion_fecha = array( 'fecha' => $fecha );
            }
        }

        $data = $this->find( 'first', array( 'conditions' => array( 'cliente_id' => $this->_id_cliente, $condicion_fecha ),
                                            'fields' => array( 'costo' ),
                                            'recursive' => -1 ) );
        if( array_key_exists( 'ConteoSms', $data ) ) {
            return $data['ConteoSms']['costo'];
        }
        return 0.0;
    }
    
    public function buscarConteoMes( $mes = null ) {
        if( is_null( $mes ) || $mes <= 0 ) {
            return 0;
        }
        $finicio = new DateTime();
        $finicio->setDate( date( 'Y' ), $mes, 1 );
        $ffin = clone $finicio;
        $ffin->add( New DateInterval( "P1M" ) );
        $rango = array( 'inicio' => $finicio->format( 'Y-m-d' ), 'fin' => $ffin->format( 'Y-m-d' ) );
        return $this->cantidadEnviada( $rango ) + $this->cantidadRecibida( $rango );
    }
    
    public function buscarPrecioSms( $mes ) {
        if( is_null( $mes ) || $mes <= 0 ) {
            return 0.0;
        }
        $finicio = new DateTime();
        $finicio->setDate( date( 'Y' ), $mes, 1 );
        $ffin = clone $finicio;
        $ffin->add( New DateInterval( "P1M" ) );
        $datos = $this->find( 'first', array( 'conditions' => array( 'cliente_id' => $this->_id_cliente, $condicion_fecha ),
                                     'fields' => array( 'MAX( costo )' ),
                                     'recursive' => -1
                                    )
        ); 
        if( count( $datos ) > 0 ) {
            if( array_key_exists( 'ConteoSms', $datos ) ) {
                return $datos['ConteoSms']['MAX( costo )'];
            }
        }
        return 0.0;
                                     
    }
}
