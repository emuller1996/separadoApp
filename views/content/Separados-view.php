<?php 
require_once "./controllers/separadoControlador.php";

$ins_separado_controlador = new separadoControlador();

$lista_separado = $ins_separado_controlador->listar_separados_controlador();

?>

<div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
        <h5>Lista Separados</h5>

        <div class="table-responsive">
            <table class="table-striped bg-light rounded border table-hover" id="data-table">
                <thead>
                    <th>ID </th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Vencimiento</th>
                    <th>Saldo</th>
                    <th>Abonado</th>
                    <th>Estado</th>
                    <th>Fecha Ultimo Abono</th>
                    <th>Valor Ultimo Abono</th>
                    <th>Factura</th>
                    <th>Cliente</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    <?php foreach ($lista_separado as $separado ) {?>

                        <tr class="<?php if($separado['separado_fecha_vencimiento']== getdate()){ echo 'bg-danger';}else{echo 'bg-success';}  ?>">
                            <td class="text-white text-nowrap"><?php echo $separado['separado_id'] ?></td>
                            <td class="text-white text-nowrap"><?php echo $separado['separado_fecha_inicio'] ?></td>
                            <td class="text-white text-nowrap"><?php echo $separado['separado_fecha_vencimiento'] ?></td>
                            <td class="text-white text-nowrap"><?php echo $separado['separado_saldo'] ?></td>
                            <td class="text-white text-nowrap"><?php echo $separado['separado_abonado'] ?></td>
                            <td class="text-white text-nowrap"><?php echo $separado['separarado_estado_estado'] ?></td>
                            <td class="text-white text-nowrap"><?php echo $separado['separado_ultimo_fecha_abono'] ?></td>
                            <td class="text-white text-nowrap"><?php echo $separado['separado_ultimo_valor_abono'] ?></td>
                            <td class="text-white text-nowrap">FT-<?php echo $separado['factura_id'] ?></td>
                            <td class="text-white text-nowrap"><?php echo $separado['cliente_nombre'] ?></td>
                            <td>
                                <a href="<?php echo SERVERURL ?>separado/<?php echo $separado['separado_id']?>" class="btn btn-sm btn-dark">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>