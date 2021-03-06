<?php
/**
 * ServicioFixture
 *
 */
class ServicioFixture extends CakeTestFixture {

    public $fields = array(
          'id_servicio' => array('type' => 'integer', 'key' => 'primary'),
          'nombre' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'descripcion' => array( 'type' => 'string', 'length' => 255, 'null' => false ),
          'fecha_alta' => 'datetime',
          'fecha_baja' => 'datetime',
          'precio_base' => 'float',
          'periodo' => 'integer',
          'dia_cobro' => 'integer',
          'forma_incompleto' => 'integer'
      );

      public $records = array(
          array(
              'id_servicio' => 1,
              'nombre' => 'prueba',
              'descripcion' => 'prueba',
              'fecha_alta' => '2014-01-01',
              'fecha_baja' => null,
              'precio_base' => 150.0,
              'periodo' => 3,
              'dia_cobro' => 1,
              'forma_incompleto' => 1
          )
      );

}
