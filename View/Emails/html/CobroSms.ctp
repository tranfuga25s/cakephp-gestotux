Se efectuó el siguente cobro de sms cobrados:<br />
<br />
<b>Cliente:</b>&nbsp;<?php $cliente['Cliente']['razonsocial']; ?><br />
<b>Numero de factura:</b>&nbsp;<?php $factura['numero']; ?><br />
<br />
<b>Cantidad de mensajes:</b><?php $sms['cantidad']; ?><br />
<b>Precio del mensaje:</b><?php $sms['precio_mensaje']; ?><br />
<b>Resumen de envios:</b><br />
<br />
<table>
    <tbody>
        <th>Fecha</th>
        <th>Cantidad</th>
        <th>Precio x mensaje</th>
        <th>Subtotal</th>
        <th>Sumatoria</th>
<?php $sumatoria = 0.0; ?>
<?php foreach( $sms['resumen'] as $dato ) :
      $sumar = $dato['precio'] * $dato['cantidad'];
      $sumatoria += $sumar; 
?>
        <tr>
            <td><?php echo $dato['fecha']; ?></td>
            <td><?php echo $dato['cantidad']; ?></td>
            <td><?php echo $dato['precio']; ?></td>
            <td><?php echo $sumar; ?></td>
            <td><?php echo $subtotal; ?></td>
        </tr>
<?php endoforeach; ?>
    </tbody>
</table>