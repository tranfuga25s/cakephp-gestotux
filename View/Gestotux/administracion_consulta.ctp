<?php
$this->set( 'title_for_layout', "Enviar consulta administrativa" );
?>
<div class="decorado1">
	<div class="titulo2">Consulta administrativa</div>
	<div>
		Utilice el siguiente formulario para enviarnos su consulta:
		<?php
			echo $this->Form->create( 'contacto' );
			echo $this->Form->input( 'nombre', array( 'label' => "Su nombre" ) );
			echo $this->Form->input( 'email', array( 'label' => "Su e-mail" ) );
			echo $this->Form->input( 'texto', array( 'label' => "Texto del mensaje:", 'type' => 'textarea' ) );
			echo $this->Form->end( 'Enviar' );
		?>	
	</div>
</div>