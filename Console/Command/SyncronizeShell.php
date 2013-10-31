<?php
//App::uses('CakeEmail', 'Network/Email');

class SyncronizeShell extends AppShell {

	//var $uses = array( 'Aviso' );
	
	private $tablas = array(
	   'clientes',
	   'ctacte'
    );
	
	public function main() {
        $this->out('Opciones de la consola de sincronizacion:');
        $this->out('');
        $this->out('Comandos:');
        $this->out(' - sincronizarTodo: Sincroniza todas las tablas que esten declardas.');
        $this->out(' - listarTablas: Lista las tablas que se van a sincronizar.' );
    }
    
    public function listarTablas() {
        $this->out( "Lista de tablas actualizables");
        foreach( $this->tablas as $tabla ) {
            $this->out( " - ".$tabla );
        }
    }
    
    public function sincronizarTodo() {
        $this->out( "No implementado" );
    }
}
?>