<?php
App::uses('Servicio', 'Gestotux.Model');

/**
 * Servicio Test Case
 *
 */
class ServicioTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Servicio = ClassRegistry::init('Gestotux.Servicio');
	}

    public function testBasico() {
        $this->assertEqual( true, true );
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
