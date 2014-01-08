<?php
/**
 * Clase para ejecutar todos los test
 */
class AllTests extends PHPUnit_Framework_TestSuite {

    /**
     * Suite define the tests for this suite
     *
     * @return $suite
     */
	public static function suite() {
		$suite = new PHPUnit_Framework_TestSuite('All Tests');
        $suite->addTestFile( ROOT. DS . APP_DIR . DS . 'Plugin' . DS . 'Gestotux'. DS . 'Test'. DS. 'Case'. DS .'Controller' . DS . 'ControllersTest.php' );
        $suite->addTestFile( ROOT. DS . APP_DIR . DS . 'Plugin' . DS . 'Gestotux'. DS . 'Test'. DS. 'Case'. DS .'Model' . DS . 'AllModelsTest.php' );
        //$suite->addTestFile( ROOT. DS . APP_DIR . DS . 'Plugin' . DS . 'Gestotux'. DS . 'Test'. DS. 'Case'. DS . 'View' . DS . 'AllViewsTest.php');
		return $suite;
	}
}
