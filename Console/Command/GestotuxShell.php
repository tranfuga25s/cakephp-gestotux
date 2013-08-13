<?php

App::uses('CakeEmail', 'Network/Email');

class GestotuxShell extends AppShell {

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

        // Defino en que mes estoy
        $mes = date( 'j' );
        $texto_mes = date( 'F' );
        
        // Busco el conteo de mensajes
        $cant_mensajes = $this->ConteoSms->buscarConteoMes( $id_cliente, $mes );
        $precio_mensaje = $this->ConteoSms->buscarPrecioSms( $id_cliente, $mes );
        $texto = "Cobro de mensajes sms utilizados - Mes: ".$texto_mes;
        
        $items = array( array( 'cantidad' => $cant_mensajes, 'texto' => $texto, 'precio_unitario' => $precio_mensaje ) );
        if( !$this->Factura->agregarFacturaSms( $id_cliente, $items ) ) {
            $this->out( 'No se pudo agregar correctamente la factura de los mensajes' );
            return;
        }
        $this->out( 'Factura guardada correctamente' );
        $id_factura = $this->Factura->id;
        $num_factura = $this->Factura->obtenerNumeroComprobante();
        
        $datos = array(
            'factura' => array( 'id' => $id_factura, 'numero' => $num_factura ),
            'sms' => array(
                'cantidad' => $cant_mensajes,
                'precio_mensaje' => $precio_mensaje,
                'resumen' => $this->ConteoSms->obtenerListado( $id_cliente, $mes )                    
            )
        );
        $template = 'Gestotux.CobroSms';
        $layout = 'cobranza';
        
        // Envio el correo electronico correspondiente
        $email = new CakeEmail();
        $email->template( $template, $layout )
              ->emailFormat( 'both' )
              ->from( 'gestotux@gestotux.com' )
              ->to( 'esteban.zeller@gmail.com' )
              ->subject( 'Nueva cobranza de sms' )
              ->viewVars( $datos )
              ->send();
        $this->out( 'Mensaje enviado a cobranzas' );
        return;        
    }
}
?>