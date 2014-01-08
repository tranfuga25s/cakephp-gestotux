<?php
/**
 * Clase para ejecutar todos los test de modelos
 */
class AllModelTests extends PHPUnit_Framework_TestSuite {

    /**
     * Suite define the tests for this suite
     *
     * @return $suite
     */
    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('All Model Tests');
        $path = ROOT. DS . APP_DIR . DS . 'Plugin' . DS . 'Gestotux'. DS . 'Test'. DS. 'Case'. DS . 'Model'. DS;
        $suite->addTestFile( $path.'ClienteTest.php' );
        $suite->addTestFile( $path.'ConteoSmsTest.php' );
        $suite->addTestFile( $path.'FacturaTest.php' );
        $suite->addTestFile( $path.'ServicioTest.php' );
        return $suite;
    }
}
