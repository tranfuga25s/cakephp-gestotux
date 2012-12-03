<?php 

$this->set( 'title_for_layout', "Mi cuenta" );

?>
<script>
	$(function() { $("#acciones").button(); });
</script>
<div>
	<h1>Mi cuenta</h1>
	<p>A continuación tendrá los detalles de su cuenta del servicio.</p>
	<br />
	<br />
	<h2>Estado de cuenta corriente</h2>
	<p>Aqui está el saldo de su cuenta corriente:</p><br />
	<div class="saldo">
		$ 0.00
	</div>
	<br />
	<br />
	<div id="aciones">
		<?php echo $this->Html->link( 'Informar Pago',        array( 'plugin' => 'gestotux', 'action' => 'informapago' ) ); ?>
		<?php echo $this->Html->link( 'Ver cuenta corriente', array( 'plugin' => 'gestotux', 'action' => 'verctacte'   ) ); ?>
		<?php echo $this->Html->link( 'Enviar consulta',      array( 'plugin' => 'gestotux', 'action' => 'consulta'    ) ); ?>
		<?php echo $this->Html->link( 'Dar de baja',          array( 'plugin' => 'gestotux', 'action' => 'darbaja'     ) ); ?>
	</div> 
</div>