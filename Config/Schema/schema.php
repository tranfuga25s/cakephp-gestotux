<?php
class GestotuxSchema extends CakeSchema {

    public function before($event = array()) {
        return true;
    }

    public function after($event = array()) {
    }

    public $conteo_sms = array(
        'id_conteo_sms' => array( 'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary' ),
        'cliente_id' => array( 'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10 ),
        'fecha' => array( 'type' => 'date', 'null' => false, 'default' => null ),
        'envios' => array( 'type' => 'integer', 'null' => false, 'default' => 0, 'length' => 10 ),
        'recibidos' => array( 'type' => 'integer', 'null' => false, 'default' => 0, 'length' => 10),
        'costo' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,4' ),
        'indexes' => array(
            'PRIMARY' => array( 'column' => array( 'id_conteo_sms' ), 'unique' => 1 ),
            'clientefecha' => array( 'column' => array( 'cliente_id', 'fecha' ), 'unique' => 1 )
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'InnoDB')
    );
    
    public $cobro_sms = array(
        'id_cobro_sms' => array( 'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary' ),
        'cliente_id' => array( 'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10 ),
        'fecha' => array( 'type' => 'date', 'null' => false, 'default' => null ),
        'costo' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,4' ),
        'mov_ctacte_id' => array( 'type' => 'integer', 'null' => false, 'default' => 0, 'length' => 10),
        'indexes' => array(
            'PRIMARY' => array( 'column' => array( 'id_cobro_sms' ), 'unique' => 1 ),
            'movctacteunique' => array( 'column' => array( 'mov_ctacte_id' ), 'unique' => 1 )
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'InnoDB')
    );
}