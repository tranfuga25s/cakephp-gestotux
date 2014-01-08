<?php
App::uses('ConteoSms', 'Gestotux.Model');
App::uses( 'IniReader', 'Configure' );
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
		'plugin.gestotux.conteo_sms'
	);

    /**
     * setUp method
     *
     * @return void
     */
	public function setUp() {
		parent::setUp();
		$this->ConteoSms = ClassRegistry::init('Gestotux.ConteoSms');

        Configure::config( 'Gestotux', new IniReader( ROOT.DS.APP_DIR.DS.'Plugin'.DS.'Gestotux'.DS.'Config'.DS.'cliente' ) );
        Configure::load( '', 'Gestotux' );
        $this->ConteoSms->setearCliente( Configure::read( 'Gestotux.cliente' ) );
	}

    /**
     * tearDown method
     *
     * @return void
     */
	public function tearDown() {
		unset($this->ConteoSms);

		parent::tearDown();
	}

    public function testVerificarCantidadEnviada() {
        $this->assertInternalType( 'integer', $this->ConteoSms->cantidadEnviada(), "El tipo de valor debe ser entero" );
        $this->assertEqual( $this->ConteoSms->cantidadEnviada(), 1, "No corresponde la cantidad enviada" );
        $this->assertEqual( $this->ConteoSms->cantidadEnviada( date('Y').'-'.date('m').(date('d')-1) ), 0, "Error al buscar otra fecha" );
        $this->assertEqual( $this->ConteoSms->cantidadEnviada( array( 'inicio' => date('Y').'-'.date('m').'-'.(date('d')-1), 'fin' => date( 'Y-m-d' ) ) ), 2, "Error al buscar otra fechas con array" );
    }

    public function testVerificarCantidadRecibida() {
         $this->assertInternalType( 'integer', $this->ConteoSms->cantidadRecibida(), "El tipo de valor debe ser entero" );
         $this->assertEqual( $this->ConteoSms->cantidadRecibida(), 1, "No corresponde la cantidad enviada" );
         // En distintas fechas
         $this->assertEqual( $this->ConteoSms->cantidadRecibida( date('Y').'-'.date('m').(date('d')-1) ), 0, "Error al buscar otra fecha" );
         $this->assertEqual( $this->ConteoSms->cantidadRecibida( array( 'inicio' => date('Y').'-'.date('m').'-'.(date('d')-1), 'fin' => date( 'Y-m-d' ) ) ), 2, "Error al buscar otra fechas con array" );
    }

    public function testAgregarEnviado() {
        $this->assertEqual( $this->ConteoSms->cantidadEnviada(), 1, "No corresponde la cantidad enviada" );
        $this->assertEqual( $this->ConteoSms->agregarEnviado(), 1, "La llamada debería de sumar uno en la fecha de hoy" );
        $this->assertEqual( $this->ConteoSms->cantidadEnviada(), 2, "No corresponde la cantidad enviada" );
        $this->assertEqual( $this->ConteoSms->agregarEnviado( date( 'Y-m-d' ) ), true, "La llamada con fecha debería de devolver verdadero" );
        $this->assertEqual( $this->ConteoSms->cantidadEnviada(), 3, "La cantidad enviada debería ser 2" );
        $this->assertEqual( $this->ConteoSms->agregarEnviado( date( 'Y-m-d' ), 2 ), true, "La llamada con fecha debería de devolver verdadero" );
        $this->assertEqual( $this->ConteoSms->cantidadEnviada(), 5, "La cantidad enviada debería ser 4" );
    }

    public function testAgregarRecibido() {
        $this->assertEqual( $this->ConteoSms->cantidadRecibida(), 1, "No corresponde la cantidad recibida" );
        $this->assertEqual( $this->ConteoSms->agregarRecibido(), 1, "La llamada debería de sumar uno en la fecha de hoy" );
        $this->assertEqual( $this->ConteoSms->cantidadRecibida(), 2, "No corresponde la cantidad Recibida" );
        $this->assertEqual( $this->ConteoSms->agregarRecibido( date( 'Y-m-d' ) ), true, "La llamada con fecha debería de devolver verdadero" );
        $this->assertEqual( $this->ConteoSms->cantidadRecibida(), 3, "La cantidad Recibida debería ser 2" );
        $this->assertEqual( $this->ConteoSms->agregarRecibido( date( 'Y-m-d' ), 2 ), true, "La llamada con fecha debería de devolver verdadero" );
        $this->assertEqual( $this->ConteoSms->cantidadRecibida(), 5, "La cantidad Recibida debería ser 4" );
    }

    public function testConteoSmsPorMes() {
        // Debe devolver el conteo maximo de mesnajes salientes y entrantes
        $this->assertInternalType( 'integer', $this->ConteoSms->buscarConteoMes( date( 'n' ) ), "El tipo de valor debe ser entero" );
        $this->assertLessThanOrEqual( 8, $this->ConteoSms->buscarConteoMes( date( 'n' ) ), "No corresponde la cantidad contabilizada del mes" );
        $this->assertEqual( $this->ConteoSms->buscarConteoMes( 0 ), 0, "No corresponde la cantida devuelta cuando el mes es incorrecto" );
        $this->assertEqual( $this->ConteoSms->buscarConteoMes(), 0, "No corresponde la cantida devuelta cuando el mes es nulo" );
    }

    public function testPrecioSmsPorMes() {
        // Debe devolver el maximo precio de todo el mes
        $this->assertEqual( $this->ConteoSms->buscarPrecioSms( 0 ), 0.0, "No corresponde la cantida devuelta cuando el mes es incorrecto" );
        $this->assertEqual( $this->ConteoSms->buscarPrecioSms(), 0.0, "No corresponde la cantida devuelta cuando el mes es nulo" );
        $this->assertLessThanOrEqual( 1.4, $this->ConteoSms->buscarPrecioSms( date( 'n' ) ), "No corresponde el precio pasado en este mes" );
        $this->assertLessThanOrEqual( 10.1, $this->ConteoSms->buscarPrecioSms( date( 'n' )-1 ), "No corresponde el precio respecto al mes anterior" );
        $this->assertLessThanOrEqual( 0.0, $this->ConteoSms->buscarPrecioSms( date( 'n' )-2 ), "No corresponde el precio respecto al 2 meses antes" );
    }


}
