<?php
App::uses('ConteoSms', 'Gestotux.Model');

/**
 * Sm Test Case
 *
 */
class ConteoSmsTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.gestotux.sm'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sms = ClassRegistry::init('Gestotux.Sm');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sms);

		parent::tearDown();
	}

}
