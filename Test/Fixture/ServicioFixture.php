<?php
/**
 * ServicioFixture
 *
 */
class ServicioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_servicio' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 1, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'descripcion' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'fecha_alta' => array('type' => 'date', 'null' => false, 'default' => null),
		'fecha_baja' => array('type' => 'date', 'null' => true, 'default' => null),
		'precio_base' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,3'),
		'periodo' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'dia_cobro' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'forma_incompleto' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id_servicio', 'unique' => 1)
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
			'id_servicio' => 1,
			'nombre' => 'Lorem ipsum dolor sit amet',
			'descripcion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'fecha_alta' => '2012-12-12',
			'fecha_baja' => '2012-12-12',
			'precio_base' => 1,
			'periodo' => 1,
			'dia_cobro' => 1,
			'forma_incompleto' => 1
		),
	);

}
