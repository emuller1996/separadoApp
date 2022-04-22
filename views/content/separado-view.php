<?php
require_once "./controllers/separadoControlador.php";
$ins_separarado_controlador = new separadoControlador();
$separado_datos = $ins_separarado_controlador->get_separado_controlador($pagina[1]);
$abonos_datos = $ins_separarado_controlador->get_abono_separado_controlador($pagina[1]);
$cont_abono = 0;
?>
<div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">

        <div class="block text-center" style="font-size: 12px;">
            Datos Separado
        </div>
        <div class="row border rounded p-2 ">
            <div class="col-6 text-left font-weight-bold h4">
                SP - <?php echo $separado_datos['separado_id']; ?>
            </div>
            <div class="col-6 text-left font-weight-bold h4">
                Factura : FT-<?php echo $separado_datos['factura_id']; ?>
            </div>
            <div class="col-6 text-left ">
                Inicio : <?php echo $separado_datos['separado_fecha_inicio']; ?>
            </div>
            <div class="col-6 text-left ">
                Vencimiento : <?php echo $separado_datos['separado_fecha_inicio']; ?>
            </div>

            <div class="col-6 text-left ">
                Abono : $<?php echo number_format($separado_datos['separado_abonado'], 0, '', '.'); ?>
            </div>
            <div class="col-6 text-left ">
                Saldo : $<?php echo number_format($separado_datos['separado_saldo'], 0, '', '.'); ?>
            </div>
            <div class="col-6 text-left ">
                Ultimo Abono : $<?php echo number_format($separado_datos['separado_ultimo_valor_abono'], 0, '', '.'); ?>
            </div>
            <div class="col-6 text-left ">
                Fecha : <?php echo $separado_datos['separado_ultimo_fecha_abono']; ?>
            </div>
            <div class="col-12 text-center ">
                Cliente : <?php echo $separado_datos['cliente_nombre']; ?>
            </div>
            <div class="col-12 text-center bg-info rounded p-2 text-white font-weight-bold">
                <?php echo $separado_datos['separarado_estado_estado']; ?>
            </div>
        </div>
        <hr>
        <div class="block text-center" style="font-size: 12px;">
            Datos Abonos
        </div>
        <div class="table-responsive border rounded p-2">
            <table class="table table-striped ">
                <thead>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Valor</th>
                    <th width="10px">
                        <button class="btn btn-info" data-toggle="modal" data-target="#abonoModal">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </th>
                </thead>
                <tbody>
                    <?php
                    if ($abonos_datos) {
                        foreach ($abonos_datos as $abono) {
                            $cont_abono++;
                    ?>

                            <tr>
                                <td><?php echo $cont_abono ?> </td>
                                <td><?php echo $abono['abono_fecha'] ?> </td>
                                <td>$<?php echo number_format($abono['abono_valor'], 0, '', '.'); ?> </td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php
                        }
                    } else { ?>
                        <tr>
                            <td colspan="3"> No hay Abono Registrado en este Separado</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>



<!-- Modal Abono -->
<div class="modal fade" id="abonoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo SERVERURL ?>ajax/separadoAjax.php" class=" FormularioAjax" method="POST" data-form="save">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Abono</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Valor Abono</label>
                        <div class="col-sm-8">
                        
                            <input type="hidden" name="abono_separado_id_reg" id="abono_separado_id_reg" value="<?php echo $separado_datos['separado_id']; ?>">
                            <input type="number" class="form-control" id="abono_valor_reg" oninput="valor_saldo_actual()" value="" name="abono_valor_reg">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Saldo Actual</label>
                        <div class="col-sm-8">
                            <input type="hidden" disabled value="<?php echo $separado_datos['separado_saldo'] ?>" name="separado_saldo_h" id="separado_saldo_h">
                            <input type="number"  class="form-control" id="separado_saldo_actual_reg" name="separado_saldo_actual_reg">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Total Pagado</label>
                        <div class="col-sm-8">
                        
                            <input type="hidden" disabled value="<?php echo $separado_datos['separado_abonado']; ?>" name="separado_abonado_h" id="separado_abonado_h">
                            <input type="number" class="form-control" id="separado_abonado_total_reg" name="separado_abonado_total_reg">
                            <input type="hidden"  value="<?php echo $separado_datos['factura_id']; ?>" name="factura_id_h" id="factura_id_h">
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-save mr-2"></i>Guardar Abono</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php

include "./views/include/separado.php";

?>