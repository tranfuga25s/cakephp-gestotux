<?php $this->set( 'title_for_layout', "Informar pago" ); ?>
<script>$(function(){$("a",".acciones").button();})</script>
<h1>Informar pago</h1>
<div class="acciones">
	<?php echo $this->Html->link( 'Volver', array( 'plugin' => 'gestotux', 'controller' => 'gestotux', 'action' => 'index' ) ); ?>
</div>
<div>
	Utilice el siguiente formulario para enviarnos su av&iacute;so de pago:
	<?php echo $this->Form->create( 'informepago', array( 'type' => 'file' ) ); ?>
	<fieldset>
		<legend>Informe de pago</legend>
		<label>Cliente:</label><?php echo $razon_social; echo $this->Form->input( 'id_cliente', array( 'type' => 'hidden', 'value' => $id_cliente ) ); ?><br /><br />
		<label>Numero Ctacte:</label><?php echo $nctacte; ?><br /><br />
	<?php
		echo $this->Form->input( 'importe', array( 'label' => "Importe:", 'type' => 'text' ) );
		echo $this->Form->input( 'tipo', array( 'type' => 'radio', 'options' => array( 'Transferencia bancaria', 'Otro' ) ) );
		echo $this->Form->input( 'texto', array( 'label' => "Aclaracion:", 'type' => 'textarea' ) );
		echo $this->Form->input( 'adjunto', array( 'type' => 'file', 'label' => "Adjuntar comprobante" ) );
	?>
	</fieldset>
	<?php echo $this->Form->end( 'Enviar informe' ); ?>	
</div>