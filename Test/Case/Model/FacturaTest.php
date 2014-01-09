<?php
App::uses('Factura', 'Gestotux.Model');

/**
 * Factura Test Case
 *
 */
class FacturaTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Factura = ClassRegistry::init('Gestotux.Factura');
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
		unset($this->Factura);

		parent::tearDown();
	}

}
