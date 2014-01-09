<?php
/**
 * ClienteFixture
 *
 */
class ClienteFixture extends CakeTestFixture {

    public $fields = array(
          'id' => array('type' => 'integer', 'key' => 'primary'),
          'razonsocial' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'nombre' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'apellido' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'calle' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'piso' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'depto' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'ciudad' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'codito_postal' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'provincia' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'pais' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'tel_fijo' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'tel_celular' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'fax' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'email' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'comprobante_email' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'ctacte' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'CUIT/CUIL' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'id_estado_fiscal' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
      );
      public $records = array(
          array(
              'id' => 5,
              'razonsocial' => 'Cliente de prueba',
              'nombre' => 'prueba',
              'apellido' => 'prueba',
              'calle' => 'prueba',
              'piso' => 'prueba',
              'depto' => 'prueba',
              'ciudad' => 'prueba',
              'codito_postal' => 'prueba',
              'provincia' => 'prueba',
              'pais' => 'prueba',
              'tel_fijo' => 'prueba',
              'tel_celular' => 'prueba',
              'fax' => 'prueba',
              'email' => 'prueba',
              'comprobante_email' => 'prueba',
              'ctacte' => 'prueba',
              'CUIT/CUIL' => 'prueba',
              'id_estado_fiscal' => 'prueba',
          )
      );

}
