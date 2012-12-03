<?php
$this->set( 'title_for_layout', "Cuenta corriente" ); 
?>
<script>
	$( function() { $("a", ".acciones").button(); });
</script>
<h2>Mi cuenta corriente</h2>
<br />
<div class="acciones">
<?php echo $this->Html->link( 'Volver', array( 'plugin' => 'gestotux', 'controller' => 'gestotux', 'action' => 'inicio' ) ); ?>
</div>
<br />
<p><b>Cantidad de items actualmente:</b> <?php echo count( $lista ); ?></p>
<table cellpadding="0" cellspacing="0" border="1">
	<tbody>
		<th style="text-align: center; background-color: #00AFF0; border: 1px solid black;">Fecha</th>
		<th style=" background-color: #00AFF0; border: 1px solid black;">Descripcion</th>
		<th style="text-align: center; background-color: #00AFF0; border: 1px solid black;">Debe</th>
		<th style="text-align: center; background-color: #00AFF0; border: 1px solid black;">Haber</th>
		<th style="text-align: center; background-color: #00AFF0; border: 1px solid black;">Saldo</th>
		<?php foreach( $lista as $item ) : ?>
		<tr>
			<td style="text-align: center; border: 1px solid black;">
				<?php echo $item['ItemCtacte']['fecha']; ?>
			</td>
			<td style=" border: 1px solid black;" width="60%"><?php echo $item['ItemCtacte']['descripcion']; ?></td>
			<td style="text-align: right; border: 1px solid black;"><?php echo $item['ItemCtacte']['debe']; ?></td>
			<td style="text-align: right; border: 1px solid black;"><?php echo $item['ItemCtacte']['haber']; ?></td>
			<td style="text-align: right; border: 1px solid black;">$0.0</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="4" style="background-color: black; color: white; font-weight: bold; text-align: right;">Saldo Final</td>
			<td style="border: 2px solid black; text-align: center; font-size: 110%; font-weight: bold;">$0.0</td>
		</tr>
	</tbody>
</table>