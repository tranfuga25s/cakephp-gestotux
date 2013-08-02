<?php
class GestotuxSchema extends CakeSchema {

    public function before($event = array()) {
        return true;
    }

    public function after($event = array()) {
    }

    public $sms = array(
        'cliente_id' => array( 'type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary' ),
        'fecha' => array( 'type' => 'date', 'null' => false, 'default' => null, 'key' => 'primary' ),
        'envios' => array( 'type' => 'integer', 'null' => false, 'default' => 0, 'length' => 10 ),
        'recibidos' => array( 'type' => 'integer', 'null' => false, 'default' => 0, 'length' => 10),
        'costo' => array('type' => 'double', 'null' => true, 'default' => null, 'length' => 10),
        'indexes' => array(
            'PRIMARY' => array('column' => array( 'cliente_id', 'fecha' ), 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
    );
}