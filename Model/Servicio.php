<?php
App::uses('GestotuxAppModel', 'Gestotux.Model');
/**
 * Servicio Model
 *
 * @property Cliente $Cliente
 */
class Servicio extends GestotuxAppModel {

	/**
	 * Use database config
	 *
	 * @var string
	 */
	public $useDbConfig = 'gestotux';

	/**
	 * Primary key field
	 *
	 * @var string
	 */
	public $primaryKey = 'id_servicio';


    public function read( $fields = null, $id = null ) {
		$ret = parent::read( $fields, $id );
		if( array_key_exists( 'periodo', $ret['Servicio'] ) ) {
			switch( $ret['Servicio']['periodo'] ) {
				case 1:  { $ret['Servicio']['periodo'] = 'Semanal'      ; break; }
				case 2:  { $ret['Servicio']['periodo'] = 'Quincenal'    ; break; }
				case 3:  { $ret['Servicio']['periodo'] = 'Mensual'      ; break; }
				case 4:  { $ret['Servicio']['periodo'] = 'BiMensual'    ; break; }
				case 5:  { $ret['Servicio']['periodo'] = 'Trimestral'   ; break; }
				case 6:  { $ret['Servicio']['periodo'] = 'Cuatrimestral'; break; }
				case 7:  { $ret['Servicio']['periodo'] = 'Semestral'    ; break; }
				case 8:  { $ret['Servicio']['periodo'] = 'Anual'        ; break; }
				default: { $ret['Servicio']['periodo'] = 'Indeterminado'; break; }
			}
		}
		return $ret;
	}
}
