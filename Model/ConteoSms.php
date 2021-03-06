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
            debug( "Numero de cliente no seteado" );
            return 0;
        }

        $condicion_fecha = array( '`ConteoSms`.`fecha`' => date('Y-m-d') );
        if( !is_null( $fecha ) ) {
            if( is_array( $fecha ) ) {
                $condicion_fecha = array( 'DATE( `ConteoSms`.`fecha` ) BETWEEN ? AND ? ' => array( $fecha['inicio'], $fecha['fin'] ) );
            } else {
                $condicion_fecha = array( 'DATE( `ConteoSms`.`fecha` )' => $fecha );
            }
        }

        $data = $this->find( 'first', array( 'conditions' => array( '`ConteoSms`.`cliente_id`' => $this->_id_cliente, $condicion_fecha ),
                                            'fields' => array( 'SUM( envios )' ),
                                            'recursive' => -1 ) );
        if( count( $data ) > 0 ) {
            return intval( $data[0]['SUM( envios )'] );
        }
        return 0;
    }

    public function cantidadRecibida( $fecha = null ) {
        if( is_null( $this->_id_cliente ) ) {
            debug( "Numero de cliente no seteado" );
            return 0;
        }

        $condicion_fecha = array( "`ConteoSms`.`fecha`" => date( 'Y-m-d' ) );
        if( !is_null( $fecha ) ) {
            if( is_array( $fecha ) ) {
                $condicion_fecha = array( 'DATE( `ConteoSms`.`fecha` ) BETWEEN ? AND ? ' => array( $fecha['inicio'], $fecha['fin'] ) );
            } else {
                $condicion_fecha = array( 'DATE( `ConteoSms`.`fecha` ) ' => $fecha );
            }
        }

        $data = $this->find( 'first', array( 'conditions' => array( 'cliente_id' => $this->_id_cliente, $condicion_fecha ),
                                            'fields' => array( 'SUM( recibidos )' ),
                                            'recursive' => -1 ) );
        if( count( $data ) > 0 ) {
            return intval( $data[0]['SUM( recibidos )'] );
        }
        return 0;
    }

    public function agregarEnviado( $fecha = null, $cantidad = 1 ) {
        if( is_null( $this->_id_cliente ) ) {
            return false;
        }

        $condicion_fecha = array( '`ConteoSms`.`fecha`' => date( 'Y-m-d' )  );
        if( $fecha != null ) {
            $condicion_fecha = array( '`ConteoSms`.`fecha`' => $fecha );
        }

        $datos = $this->find( 'first',
            array( 'conditions' => array( '`ConteoSms`.`cliente_id`' => $this->_id_cliente, $condicion_fecha ),
                   'fields'     => array( 'id_conteo_sms', 'envios' ) ) );
        if( count( $datos ) == 0 ) {
            $this->create();
            $datos = array(
                'ConteoSms' => array(
                    'cliente_id' => $this->_id_cliente,
                    'envios' => 1,
                    'recibidos' => 0,
                    'costo' => doubleval( Configure::read( 'Gestotux.precio_sms' ) ),
                    'fecha' => date('Y-m-d')
                )
            );
            if( $this->save( $datos ) ) {
                return true;
            } else {
                debug( "No se pudo guardar el dato nuevo!" );
                debug( $this->validationErrors );
                die();
            }
        } else {
            $cantidad_anterior = intval( $datos['ConteoSms']['envios'] );
            $this->id = $datos['ConteoSms']['id_conteo_sms'];
            unset( $datos );
            if( $this->exists() ) {
                $nueva_cantidad = $cantidad_anterior + $cantidad;
                if( $this->saveField( 'envios', $nueva_cantidad ) ) {
                    return true;
                }
            }
        }
        return false;
    }

    public function agregarRecibido( $fecha = null, $cantidad = 1 ) {
        if( is_null( $this->_id_cliente ) ) {
            return false;
        }

        $condicion_fecha = array( '`ConteoSms`.`fecha`' =>  date( 'Y-m-d' ) );
        if( $fecha != null ) {
            $condicion_fecha = array( '`ConteoSms`.`fecha`' => $fecha );
        }

        $datos = $this->find( 'first',
            array( 'conditions' => array( '`ConteoSms`.`cliente_id`' => $this->_id_cliente, $condicion_fecha ),
                   'fields'     => array( 'id_conteo_sms', 'recibidos' ) ) );
        if( count( $datos ) == 0 ) {
            $this->create();
            $datos = array(
                'ConteoSms' => array(
                    'cliente_id' => $this->_id_cliente,
                    'envios' => 0,
                    'recibidos' => 1,
                    'costo' => doubleval( Configure::read( 'Gestotux.precio_sms' ) ),
                    'fecha' => date('Y-m-d')
                )
            );
            if( $this->save( $datos ) ) {
                return true;
            } else {
                debug( "No se pudo guardar el dato nuevo!" );
                debug( $this->validationErrors );
                die();
            }
        } else {
            $cantidad_anterior = intval( $datos['ConteoSms']['recibidos'] );
            $this->id = $datos['ConteoSms']['id_conteo_sms'];
            unset( $datos );
            if( $this->exists() ) {
                $nueva_cantidad = $cantidad_anterior + $cantidad;
                if( $this->saveField( 'recibidos', $nueva_cantidad ) ) {
                    return true;
                }
            }
        }
        return false;
    }

    public function costoMensaje( $fecha = null ) {
        if( is_null( $this->_id_cliente ) ) {
            return 0.0;
        }

        $condicion_fecha = array( '`ConteoSms`.`fecha`'  => date( 'Y-m-d' ) );
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

    public function buscarPrecioSms( $mes = null ) {
        if( is_null( $mes ) || $mes <= 0 ) {
            return 0.0;
        }
        $finicio = new DateTime();
        $finicio->setDate( date( 'Y' ), $mes, 1 );
        $ffin = clone $finicio;
        $ffin->add( New DateInterval( "P1M" ) );
        $condicion_fecha = array( '`ConteoSms`.`fecha` BETWEEN ? AND ? ' => array( $finicio->format( 'Y-m-d H:i:s' ), $ffin->format( 'Y-m-d h:i:s') ) );
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

    /*!
     * Devuelve el listado de cantidad de mensajes enviados
     * cada dia durante el mes indicado para el cliente indicado
     */
    public function obtenerListado( $id_cliente, $mes ) {
        /// @TODO: Hacer listado para el email
    }
}
