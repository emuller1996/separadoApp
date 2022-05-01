<?php
require_once "./controllers/facturaControlador.php";
$ins_factura = new facturaControlador();
$factura = $ins_factura->get_factura_by_id_controlador($pagina[1]);
$detalles_factura = $ins_factura->get_detalles_factura_controlador($pagina[1]);
?>

<div class="card border-left-primary shadow h-100 ">
    <div class="card-body ">
        <div class="block text-center" style="font-size: 12px;">Datos Factura</div>
        <div class="row border border-primary rounded ">
            <div class="col-12 font-weight-bold bg-primary py-2 text-white text-center h4">
                FT - <?php echo $factura['factura_id']; ?>
            </div>
            <div class="col-6 text-left">
                Fecha : <?php echo $factura['factura_fecha']; ?>
            </div>
            <div class="col-6 text-left">
                Hora : <?php echo $factura['factura_hora']; ?>
            </div>
            <div class="col-6 text-left">
                Estado : <?php echo $factura['factura_estado_estado']; ?>
            </div>
            <div class="col-6 text-left">
                Cliente : <?php echo $factura['cliente_nombre']; ?>
            </div>
            <div class="col-12 font-weight-bold bg-primary py-2 text-white text-center h6 m-0">
                $<?php echo number_format($factura['factura_total'], 0, '', '.'); ?>
            </div>
        </div>
        <hr>
        <div class="block text-center mb-2" style="font-size: 12px;">Detalles Factura</div>
        <div class="border border-primary rounded ">
            <div class="table-responsive">
                <table class=" w-100 table-hover text-center">
                    <thead>
                        <th>Cantidad</th>
                        <th>Descripcion</th>
                        <th>Vr Unitario</th>
                        <th>Vr Total</th>
                    </thead>
                    <tbody>
                        <?php foreach ($detalles_factura as $detalle) { ?>
                            <tr>
                                <td class="text-nowrap text-center"><?php echo $detalle['detalle_cantidad']; ?></td>
                                <td class="text-nowrap text-center"><?php echo $detalle['producto_descripcion']; ?></td>
                                <td class="text-nowrap text-center">$<?php echo number_format($detalle['detalle_valor_unitario'], 0, '', '.'); ?></td>
                                <td class="text-nowrap text-center">$<?php echo number_format($detalle['detalle_valor_total'], 0, '', '.'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <a class="btn btn-success w-100 font-weight-bold" href="javascript:ventanaSecundaria('<?php echo SERVERURL ?>facturas/factura_ticket.php?id=<?php echo $factura['factura_id']?>')" >
                    <i class="fas fa-print mr-2"></i> IMPRIMIR FACTURA.
                </a>
            </div>
        </div>
    </div>
</div>

<script> 
function ventanaSecundaria (URL){ 
   window.open(URL,"popup","width=500,height=800,scrollbars=NO") ;
} 
</script>