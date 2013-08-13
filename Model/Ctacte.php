<?php
App::uses('AppModel', 'Model');
/**
* Ctacte Model
*
* @property Item $Item
*/
class Ctacte extends GestotuxAppModel {

	public $useDbConfig = 'gestotux';

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
	public $hasMany = array( 'ItemCtaCte' => array( 'className' => 'Gestotux.ItemCtacte', 'foreignKey' => 'id_ctacte' ) );

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
		        if( $result == array() ) {
            return "No hay datos";
        } else {
          return $result['Ctacte']['saldo'];
        }
	}
    
    /**
     * Funcion para obtener el identificador de cuenta corriente según el id de cliente
     * @param id_cliente integer Identificador del cliente.
     * @return false si no existe asociación o el identificador de la cuenta corriente ( string )
     */
     public function obtenerCtaCte( $id_cliente = null ) {
        if( $id_cliente == null ) {
            //throw new NotFoundException( 'El cliente es nulo' );
            return false;
        }
        
        $result = $this->find( 'first', array( 'conditions' => array( 'id_cliente' => $id_cliente ), 'fields' => 'id_ctacte', 'recursive' => -1 ) );
        if( $result == array() ) {
            return false;
        } else {
            return $result['Ctacte']['id_ctacte'];
        }
     }

}