<?php
$this->set( 'title_for_layout', "Precio del servicio" );
?>
<div class="decorado1">
	<div class="titulo1">Plan de Precios</div>
	<br />
	<p>Nuestro plan <?php echo h($servicio['Servicio']['nombre']); ?> tiene el siguiente precio:</p>
	<div class="precio"><?php echo $this->Number->currency( $servicio['Servicio']['precio_base'] ); ?></div>
	<p><div class="periodo">y es de pago <b><?php echo $servicio['Servicio']['periodo']; ?></b></div></p>
	<p>La facutaración de este servicio se realiza los días <b><?php echo $servicio['Servicio']['dia_cobro'];?></b> de cada período.</p>
</div>