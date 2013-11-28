<?php
/**
 * SmFixture
 *
 */
class ConteoSmsFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
	    'id_conteo_sms' => array( 'type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary' ),
		'cliente_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => null, 'key' => 'primary'),
		'envios' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'recibidos' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
		'costo' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,4'),
        'indexes' => array(
            'PRIMARY' => array( 'column' => array( 'id_conteo_sms' ), 'unique' => 1 ),
            'clientefecha' => array( 'column' => array( 'cliente_id', 'fecha' ), 'unique' => 1 )
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
		    'id_conteo_sms' => 1,
			'cliente_id' => 5,
			'fecha' => '2013-08-02',
			'envios' => 1,
			'recibidos' => 1,
			'costo' => 1
		)
	);

    public function init() {
        $f = new DateTime();
        // Registro en el día de hoy
        $this->records[] = array(
            'id_conteo_sms' => 2,
            'cliente_id' => 5,
            'fecha' => $f->format( 'Y-m-d' ),
            'envios' => 1,
            'recibidos' => 1,
            'costo' => 1
        );
        $f->sub( new DateInterval( "P1D" ) );
        // Registro de hace un dia
        $this->records[] = array(
            'id_conteo_sms' => 2,
            'cliente_id' => 5,
            'fecha' => $f->format( 'Y-m-d' ),
            'envios' => 1,
            'recibidos' => 1,
            'costo' => 1.1
        );
        $f->sub( new DateInterval( "P2D" ) );
        // Registro de hace tres dias atras
        $this->records[] = array(
            'id_conteo_sms' => 2,
            'cliente_id' => 5,
            'fecha' => $f->format( 'Y-m-d' ),
            'envios' => 1,
            'recibidos' => 1,
            'costo' => 1.1
        );
        $f->sub( new DateInterval( "P7D" ) );
        // Registro de hace mas de una semana
        $this->records[] = array(
            'id_conteo_sms' => 2,
            'cliente_id' => 5,
            'fecha' => $f->format( 'Y-m-d' ),
            'envios' => 1,
            'recibidos' => 1,
            'costo' => 1.4
        );
        $f = new DateTime();
        $f->sub( new DateInterval( "P1M" ) );
        // Registro de hace un dia
        $this->records[] = array(
            'id_conteo_sms' => 2,
            'cliente_id' => 5,
            'fecha' => $f->format( 'Y-m-d' ),
            'envios' => 1,
            'recibidos' => 1,
            'costo' => 1.1
        );
        $f->sub( new DateInterval( "P5D" ) );
        // Registro de hace más de un mes atras
        $this->records[] = array(
            'id_conteo_sms' => 2,
            'cliente_id' => 5,
            'fecha' => $f->format( 'Y-m-d' ),
            'envios' => 1,
            'recibidos' => 1,
            'costo' => 10.1
        );
        parent::init();
    }

}
