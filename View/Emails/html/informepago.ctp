<p>Ha recibido un nuevo informe de pago de parte de su cliente.</p>
<br />
<b>Cliente:</b> <?php echo $cliente['razon_social']; ?><br />
<b>Importe:</b> <?php echo $importe; ?><br />
<b>Aclaracion:</b> <?php echo $aclaracion; ?><br />
<?php if( $tipo == 0 ) { ?>
<b>Tipo:</b> Transferencia Bancaria<br />
<?php } else { ?>
<b>Tipo:</b> Otro<br />	
<?php } ?>
<br />
<p>Este email ha sido generado automaticamente, no responda este mensaje.</p>