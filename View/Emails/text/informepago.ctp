Ha recibido un nuevo informe de pago de parte de su cliente.

Cliente: <?php echo $cliente['razon_social']; ?>
Importe: <?php echo $importe; ?>
Aclaracion: <?php echo $aclaracion; ?>
<?php if( $tipo == 1 ) { ?>
Tipo: Transferencia Bancaria
<?php } else { ?>
Tipo: Otro	
<?php } ?>

Este email ha sido generado automaticamente, no responda este mensaje.
