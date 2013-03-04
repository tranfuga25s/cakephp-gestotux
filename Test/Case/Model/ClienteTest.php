<?php
App::uses('Cliente', 'Gestotux.Model');

/**
 * Cliente Test Case
 *
 */
class ClienteTest extends CakeTestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array(
		'plugin.gestotux.cliente',
		'plugin.gestotux.ctacte',
		'plugin.gestotux.item_ctacte'
	);

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();
		$this->Cliente = ClassRegistry::init('Gestotux.Cliente');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->Cliente);

		parent::tearDown();
	}

	/**
	 * testExiste method
	 *
	 * @return void
	 */
	public function testExiste() {
		$ret = $this->Cliente->existe( -1 );
		$this->assertEqual( $ret, false, "El metodo cliente->existe(-1) debe devolver falso" );
	}

	/**
	 * testDarDeAlta method
	 *
	 * @return void
	 */
	/*public function testDarDeAlta() {
	}*/

}
