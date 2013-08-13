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
        // Verifico que exista el cliente y esté todo configurado
        if( !Configure::check( 'Gestotux' ) ) 
        { $this->out( 'Gestotux no configurado. No se hace nada' ); return; }
        if( !Configure::check( 'Waltoolk' ) ) 
        { $this->out( 'El plugin de Waltoolk no está configurado. No se hace nada' ); return; }
        if( !Configure::check( 'Gestotux.cliente' ) ) 
        { $this->out( 'El plugin de gestotux no está configurado correctamente. No existe el cliente' ); return; }
        
        $this->Cliente->id = intval( Configure::read( 'Gestotux.cliente' ) );
        if( !$this->Cliente->exists() ) 
        { $this->out( 'El plugin de gestotux no está configurado correctamente. No existe el cliente' ); return; }
        $id_ctacte = $this->Ctacte->obtenerCtacte( $this->Cliente->id );
        if( $id_ctacte === false ) { $this->out( 'No hay asociación entre el cliente y la cuenta corriente' ); return; }
        
        // Busco el conteo de mensajes
        $cant_mesnajes = $this->ConteoSms->buscarConteoMes( $id_cliente, $mes );
        $precio_mensaje = $this->ConteoSms->buscarPrecioSms( $id_cliente, $mes );
        $importe_total = $cant_mesnajes * $precio_mensaje;
        $texto = "Cobro de ".$cant_mesnajes." mensajes sms utilizados - Mes: ".$texto_mes;
        
        
        
        
        
        
        
    }
}
?>