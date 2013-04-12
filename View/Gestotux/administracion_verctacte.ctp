<?php
$this->set( 'title_for_layout', "Mi Cuenta corriente" ); 
$saldo = 0.0;
?>
<script>
	$( function() { $("a", ".acciones").button(); });
</script>
<h2>Mi cuenta corriente</h2>
<p><b>Cantidad de items actualmente:</b> <?php echo count( $lista ); ?></p>
<table>
	<tbody>
		<th style="text-align: center;">Fecha</th>
		<th>Descripcion</th>
		<th style="text-align: center;">Debe</th>
		<th style="text-align: center;">Haber</th>
		<th style="text-align: center;">Saldo</th>
		<?php foreach( $lista as $item ) : ?>
		<tr>
			<td style="text-align: center;">
				<?php echo $this->Time->i18nFormat( $item['ItemCtacte']['fecha'] ); ?>
			</td>
			<td width="60%"><?php echo $item['ItemCtacte']['descripcion']; ?></td>
			<td style="text-align: right;"><?php echo $this->Number->currency( $item['ItemCtacte']['debe'], 'USD', array( 'negative' => '- ' )  ); ?></td>
			<td style="text-align: right;"><?php echo $this->Number->currency( $item['ItemCtacte']['haber'], 'USD', array( 'negative' => '- ' )  ); ?></td>
			<td style="text-align: right;"><?php $saldo -= $item['ItemCtacte']['debe']; $saldo += $item['ItemCtacte']['haber']; echo $this->Number->currency( $saldo, 'USD', array( 'negative' => '- ' ) ); ?></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="4" style="font-weight: bold; text-align: right;">Saldo Final</td>
			<td style="text-align: center; font-size: 110%; font-weight: bold;"><?php echo $this->Number->currency( $saldo_actual, 'USD', array( 'negative' => '- ' )  ); ?></td>
		</tr>
	</tbody>
</table>
<br />
<div class="acciones">
	<?php echo $this->Html->link( 'Volver', array( 'plugin' => 'gestotux', 'controller' => 'gestotux', 'action' => 'index' ) ); ?>
</div>
<?php echo $this->element( 'sponsor' ); ?>
