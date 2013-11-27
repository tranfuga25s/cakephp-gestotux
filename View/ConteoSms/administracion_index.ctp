<?php
$this->set( 'title_for_layout', "Visor de mensajes sms" );
?>
<div id="acciones">
    
</div>
<br />
<div class="index">
    <h2>Contabilidad de Mensajes</h2>
    <br />
    <table cellpadding="0" cellspacing="0" width="60%">
        <tbody>
            <tr>
                <td>Cantidad de mensajes enviados:</td>
                <td>&nbsp;</td>
                <td width="10%"><?php echo $enviados; ?> mensajes</td>
            </tr>
            <tr>
                <td>Cantidad de mensajes recibidos:</td>
                <td style="text-align: right;">+</td>
                <td style="border-bottom: solid black 2px;"><?php echo $recibidos; ?> mensajes</td>
            </tr>
            <tr>
                <td>Total:</td>
                <td>&nbsp;</td>
                <td><?php echo ( $enviados + $recibidos ); ?> mensajes</td>
            </tr>
            <tr>
                <td>Costo por mensaje:</td>
                <td style="text-align: right;">x</td>
                <td style="border-bottom: solid black 2px;"><?php echo $this->Number->currency( $costo, '$', array(  'fractionSymbol' => '$ 0,', 
                                                                                                                     'fractionPosition' => 'before',
                                                                                                                     'fractionExponent' => 2, 
                                                                                                                     'places' => 2, 
                                                                                                                     'decimals' => ',', 
                                                                                                                     'thousands' => '.' ) ); ?></td>
            </tr>            
            <tr>
                <td>Costo total:</td>
                <td>&nbsp;</td>
                <td><?php echo $this->Number->currency( $costo * ( $enviados + $recibidos ), '$', array(  'fractionSymbol' => '$ 0,', 
                                                                                                                     'fractionPosition' => 'before',
                                                                                                                     'fractionExponent' => 2, 
                                                                                                                     'places' => 2, 
                                                                                                                     'decimals' => ',', 
                                                                                                                     'thousands' => '.' ) ); ?></td>
            </tr>            
        </tbody>
    </table>
</div>
