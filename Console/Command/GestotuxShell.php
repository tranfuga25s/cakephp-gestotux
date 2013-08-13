<?php

App::uses('CakeEmail', 'Network/Email');

class TurnosShell extends AppShell {

	var $uses = array( 'Gestotux.Cliente', 'Gestotux.Ctacte', 'Gestotux.Conteosms' );

	public function main() {
		$this->out('Opciones de la consola de gestotux:');
		$this->out('');
		$this->out('Comandos:');
		$this->out(' - contabilizarMensajes: Genera una factura con los importes gastados durante el mes.');
	}

    public function contabilizarMensajes() {
        
    }
}
?>