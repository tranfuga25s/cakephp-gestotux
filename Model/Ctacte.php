<?php
App::uses('AppModel', 'Model');
/**
* Ctacte Model
*
* @property Item $Item
*/
class Ctacte extends GestotuxAppModel {

	/**
	* Use table
	*
	* @var mixed False or table name
	*/
	public $useTable = 'ctacte';
	/**
	* Primary key field
	*
	* @var string
	*/
	public $primaryKey = 'numero_cuenta';
	/**
	* Display field
	*
	* @var string
	*/
	public $displayField = 'numero_cuenta';
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	/**
	* hasAndBelongsToMany associations
	*
	* @var array
	*/
	public $hasMany = array( 'ItemCtaCte' => array( 'className' => 'ItemCtacte', 'foreignKey' => 'id_ctacte' ) );

   /**
    * Funcion para obtener el saldo de la cuenta corriente
    * @param id_cliente Identificador del cliente
    * @return Saldo en su cuenta corriente o null
    * @throws NotFoundException si el cliente no existe
    */	
	public function obtenerSaldo( $id_cliente = null ) {
		if( $id_cliente == null ) {
			throw new NotFoundException( 'El cliente es nulo' );
		}
		$result = $this->find( 'first', array( 'conditions' => array( 'id_cliente' => $id_cliente ), 'fields' => 'saldo', 'recursive' => -1 ) );
		return $result['Ctacte']['saldo'];
	}

}