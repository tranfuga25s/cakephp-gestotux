<?php
App::uses('Servicio', 'Gestotux.Model');

/**
 * Servicio Test Case
 *
 */
class ServicioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.gestotux.servicio',
		'plugin.gestotux.cliente',
		'plugin.gestotux.servicios_cliente'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Servicio = ClassRegistry::init('Gestotux.Servicio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Servicio);

		parent::tearDown();
	}

}
