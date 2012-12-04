<?php $this->set( 'title_for_layout', "Informar pago" ); ?>
<h1>Informar pago</h1>
<div>
	Utilice el siguiente formulario para enviarnos su consulta:
	<fieldset>
		<legend>Informe de pago</legend>
		<label>Cliente:</label><?php echo $razon_social; ?><br />
		<label>Numero Ctacte:</label><?php echo $nctacte; ?><br />
	<?php
		echo $this->Form->create( 'informepago' );
		echo $this->Form->input( 'importe', array( 'label' => "Importe:", 'type' => 'text' ) );
		echo $this->Form->input( 'tipo', array( 'type' => 'radio', 'options' => array( 'Transferencia bancaria', 'Otro' ) ) );
		echo $this->Form->input( 'texto', array( 'label' => "Aclaracion:", 'type' => 'textarea' ) );
		echo $this->Form->input( 'adjunto', array( 'type' => 'file', 'label' => "Adjuntar comprobante" ) );
		echo $this->Form->end( 'Enviar' );
	?>
	</fieldset>	
</div>