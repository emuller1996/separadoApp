<?php
echo $pagina[1];
echo $pagina[2];

require_once "./controllers/facturaControlador.php";
$ins_factura = new facturaControlador();

$listaFacturasEmitidas = $ins_factura->listar_facturas_por_fecha_controlador($pagina[1], $pagina[2]);
$total_valor_factura_emitidas = 0;
$total_factura_emitidas = 0;
//echo var_dump($listaFacturasEmitidas);


?>

<div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
        
    <div class="table-responsive ">
            <table id="data-table" class="table-light  table-striped">
                <thead>
                    <th>Codigo Factura</th>
                    <th>Hora</th>
                    <th>Fecha</th>
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
                                <td width="0.75rem" class="text-nowrap">FT-<?php echo $factura['factura_id']; ?></td>
                                <td width="0.75rem" class="text-nowrap"><?php echo  date("h:m", strtotime($factura['factura_hora']));  ?></td>
                                <td class="text-nowrap"><?php echo  $factura['factura_fecha']  ?></td>
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
                        <td colspan="7" class="text-center">Hoy no se han realizado Facturas .</td>
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
                        <td colspan="1" class="text-center">
                            $ <?php echo number_format($total_valor_factura_emitidas, 0, "", "."); ?>
                        </td>
                        <td colspan="1" class="text-center">
                            &nbsp;
                        </td>
                        <td colspan="1" class="text-center">
                            &nbsp;
                        </td>   
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>