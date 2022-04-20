<?php
require_once "./controllers/facturaControlador.php";
$ins_facturas_controlador = new facturaControlador();

$listaFacturasEmitidas = $ins_facturas_controlador->get_facturas_emitidas_hoy_controlador();
$total_factura_emitidas = 0;
?>

<div class="card border-left-danger shadow h-100 py-2">
    <div class="card-header">
        <h5>Factura Emitidas hoy <?php
                                
                                    echo date("F d, Y ",time()) ?></h5>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <table class="table table-light table-bordered table-striped">
                <thead>
                    <th>Codigo Factura</th>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Total</th>
                </thead>
                <tbody>
                    <?php foreach ($listaFacturasEmitidas as $factura) { ?>
                        <tr>
                            <td>FT-<?php echo $factura['factura_id']; ?></td>
                            <td><?php echo  $factura['factura_hora']  ?></td>
                            <td><?php echo $factura['cliente_nombre']; ?></td>
                            <td><?php echo $factura['factura_estado_estado']; ?></td>
                            <td>$ <?php echo number_format($factura['factura_total'], 0, '', '.'); ?></td>
                        </tr>

                    <?php
                        $total_factura_emitidas  += $factura['factura_total'];
                    } ?>

                    <tr>
                        <td colspan="2">
                            Total
                        </td>
                        <td colspan="2">
                            $ <?php echo number_format($total_factura_emitidas, 0, "", "."); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>
</div>