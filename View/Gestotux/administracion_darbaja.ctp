<?php
$this->set( 'title_for_layout', "Dar de baja el servicio" );
?>
<script>$(function(){$("a",".acciones").button();});</script>
<div class="acciones">
	<?php echo $this->Html->link( 'Volver', array( 'plugin' => 'gestotux', 'controller' => 'gestotux', 'action' => 'index' ) ); ?>
</div>
<br />
<fieldset>
	<legend><h1>Darse de baja</h1></legend>
	<fieldset>
		<legend><h3>Datos del servicio</h3></legend>
		<b>Nombre del servicio:</b>&nbsp;<?php echo $servicio['Servicio']['nombre']; ?><br />
		<b>Precio:</b>&nbsp;<?php echo $this->Number->currency( $servicio['Servicio']['precio_base'] ).'/'.$servicio['Servicio']['periodo']; ?><br />
		<b>Nombre del cliente:</b>&nbsp;<?php echo $cliente['Cliente']['razon_social']; ?><br />
		<b>N&uacute;mero de cuenta corriente:</b>&nbsp;<?php echo "#".$cliente['Ctacte']['numero_cuenta']; ?><br />
		<b>Saldo actual:</b>&nbsp;<?php echo $this->Number->currency( $cliente['Ctacte']['saldo'] ); ?>
		<?php
			if( $cliente['Ctacte']['saldo'] > 0 ) {
				echo $this->Html->link( 'Debe regularizar su cuenta para darse de baja', array( 'controller' => 'gestotux', 'action' => 'informapago' ) );
			}
		?>
	</fieldset>
	<?php echo $this->Form->create( 'Baja' ); ?>
	<fieldset>
		<legend><h2>Razon de baja</h2></legend>
		<p>Por favor, indique la raz&oacute;n de baja del servicio:</p>
		<?php
			echo $this->Form->input( 'razon', array( 'type' => 'textarea', 'label' => 'Razón de baja:' ) );
			echo "<b>Hacer efectivo desde:</b>&nbsp;".$this->Form->dateTime( 'fecha_aplique', 'DMY', null, array( 'empty' => false ) );
			
		?>
	</fieldset>
</fieldset>
<?php echo $this->element( 'sponsor' ); ?>
