<?php
/**
 * SmFixture
 *
 */
class SmFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'cliente_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => null, 'key' => 'primary'),
		'envios' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'recibidos' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'costo' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,4'),
		'indexes' => array(
			'PRIMARY' => array('column' => array('cliente_id', 'fecha'), 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'cliente_id' => 1,
			'fecha' => '2013-08-02',
			'envios' => 1,
			'recibidos' => 1,
			'costo' => 1
		),
	);

}
