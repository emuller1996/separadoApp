<?php
require_once "./controllers/facturaControlador.php";
$ins_facturas_controlador = new facturaControlador();

$listaFacturasEmitidas = $ins_facturas_controlador->get_facturas_emitidas_hoy_controlador();
$total_valor_factura_emitidas = 0;
$total_factura_emitidas = 0;
?>

<div class="card border-left-danger shadow h-100 py-2">
    <div class="card-header">
        <h5>Factura Emitidas hoy <?php

                                    echo date("F d, Y ", time()) ?></h5>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <table id="data-table" class="table-hover table-striped bg-light rounded border">
                <thead>
                    <th>Codigo Factura</th>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    <?php
                    if (isset($listaFacturasEmitidas)) {
                        foreach ($listaFacturasEmitidas as $factura) { ?>
                            <tr>
                                <td class="text-nowrap">FT-<?php echo $factura['factura_id']; ?></td>
                                <td class="text-nowrap"><?php echo  $factura['factura_hora']  ?></td>
                                <td class="text-nowrap"><?php echo $factura['cliente_nombre']; ?></td>
                                <td class="text-nowrap"><?php echo $factura['factura_estado_estado']; ?></td>
                                <td class="text-nowrap">$ <?php echo number_format($factura['factura_total'], 0, '', '.'); ?></td>
                                <td>
                                    <a  href="<?php echo SERVERURL ?>ver-factura/<?php echo $factura['factura_id']?>" 
                                        class="btn btn-dark"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php
                            $total_valor_factura_emitidas  += $factura['factura_total'];
                            $total_factura_emitidas++;
                        }
                    } else { ?>
                    <tr class="text-center">
                        <td colspan="5" class="text-center">Hoy no se han realizado Facturas .</td>
                    </tr>
                    <?php
                    }
                    ?>

                    <tr>
                        <td colspan="1" class="text-center">
                            Total Fact.
                        </td>
                        <td colspan="1" class="text-center">
                             <?php echo number_format($total_factura_emitidas, 0, "", ""); ?>
                        </td>
                        <td colspan="1" class="text-center">
                            &nbsp;
                        </td>
                        <td colspan="1" class="text-center">
                            Total Valor Fact.
                        </td>
                        <td colspan="2" class="text-center">
                            $ <?php echo number_format($total_valor_factura_emitidas, 0, "", "."); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>
</div>