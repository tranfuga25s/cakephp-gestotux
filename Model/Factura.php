<?php
App::uses('AppModel', 'Model');
/**
* Modelo de factura
*/
class Factura extends GestotuxAppModel {

    public $useTable = 'factura';
	public $primaryKey = 'id_factura';
	
	/**
	 * hasAndBelongsToMany associations
	 *
	 * @var array
	 */
	public $hasMany = array( 'ItemFactura' => array( 'foreignKey' => 'id_factura' ) );
	
}