<?php $this->set( 'title_for_layout', "Enviar consulta administrativa" ); ?>
<script>$(function(){$("a",".acciones").button();});</script>
<div class="acciones">
	<?php echo $this->Html->link( 'Volver', array( 'plugin' => 'gestotux', 'controller' => 'gestotux', 'action' => 'index' ) ); ?>
</div>
<h1>Consulta administrativa</h1>
<p>Utilice el siguiente formulario para enviarnos su consulta:</p>
<div class="consulta form">
	<?php echo $this->Form->create( 'contacto' ); ?>
	<fieldset>
		<legend>Enviar consulta administrativa</legend>		
		<?php
			echo $this->Form->input( 'texto', array( 'label' => "Texto del mensaje:", 'type' => 'textarea' ) );
			echo $this->Form->end( 'Enviar' );
		?>	
	</fieldset>
</div>