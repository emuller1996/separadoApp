<?php
require_once "./controllers/cajaControlador.php";
$ins_caja = new cajaControlador();
$listaMovimienos = $ins_caja->listar_caja_movimientos_hoy_controlador();

$saldo = 0;

?>

<div class=" card border-left-primary shadow border-primary">
    <div class="card-body ">
        <h5 class="card-title text-center">Movimientos de Caja</h5>


        <div class="row">
            <div class="col-4">
                <button class="btn btn-primary w-100" data-toggle="modal" data-target="#CajaModal">

                    <i class="fas fa-money-check-alt fa-2x mr-2"></i>
                    Nuevo Mov.
                </button>
            </div>

        </div>

        <div class="table-responsive rounded mt-3">
            <table class="table-hover table-striped bg-light border w-100" id="">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>HORA</th>
                        <th>CONCEPTO</th>
                        <th>ENTRADA</th>
                        <th>SALIDA</th>
                        <th>SALDO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($listaMovimienos) {
                        foreach ($listaMovimienos as $movimiento) { ?>
                            <tr>
                                <td scope="row"> <?php echo date("h:i a", strtotime($movimiento['movimiento_caja_hora'])); ?></td>
                                <td> <?php echo $movimiento['movimiento_caja_concepto'] ?> </td>
                                <td>
                                    <?php
                                    if ($movimiento['movimiento_caja_tipo'] == 'ENTRADA') {
                                        echo number_format($movimiento['movimiento_caja_valor'], 0, '', '.');
                                        $saldo += $movimiento['movimiento_caja_valor'];
                                    } else {
                                        echo '$0';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($movimiento['movimiento_caja_tipo'] == 'SALIDA') {
                                        echo number_format($movimiento['movimiento_caja_valor'], 0, '', '.');
                                        $saldo -= $movimiento['movimiento_caja_valor'];
                                    } else {
                                        echo '$0';
                                    }
                                    ?>
                                </td>
                                <td><?php echo number_format($saldo, 0, '', '.'); ?> </td>
                            </tr>
                        <?php
                        }
                    } else {  ?>
                        <tr>
                            <td class="text-center py-2" colspan="5"> No hay Registros en los movimientos de caja hoy</td>
                        </tr>

                    <?php }
                    ?>

                </tbody>
            </table>
        </div>

    </div>
</div>






<!-- Modal Insertar Movimiento Caja -->
<div class="modal fade" id="CajaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Nuevo Movimiento Caja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo SERVERURL ?>ajax/cajaAjax.php" method="POST" class="FormularioAjax needs-validation" data-form="save" novalidate>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Concepto</div>
                                </div>
                                <input type="text" class="form-control" id="caja_movimiento_concepto_reg" name="caja_movimiento_concepto_reg" placeholder="Ingrese aquí el Concepto" required>
                                <div class="invalid-feedback text-center">
                                    el Campo Concepto es obligatorio
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Valor</div>
                                </div>
                                <input type="text" class="form-control" id="caja_movimiento_valor_reg" name="caja_movimiento_valor_reg" placeholder="Ingrese aquí el Valor" required>
                                <div class="invalid-feedback text-center">
                                    Campo Valor es obligatorio
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <select oninput="select_color()" class="form-control bg-danger text-white" id="caja_movimiento_tipo_reg" name="caja_movimiento_tipo_reg" required>
                                    <option value="SALIDA" class="bg-danger">SALIDA</option>
                                    <option value="ENTRADA" class="bg-success">ENTRADA</option>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Guarda Movimiento</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function select_color(){
        var select = $('#caja_movimiento_tipo_reg').val();
        if(select === 'SALIDA'){
            $('#caja_movimiento_tipo_reg').addClass('bg-danger');
            $('#caja_movimiento_tipo_reg').removeClass('bg-success');   
        }else{
            $('#caja_movimiento_tipo_reg').addClass('bg-success');
            $('#caja_movimiento_tipo_reg').removeClass('bg-danger');   
        }

    }

</script>

<?php 
require_once "./views/include/validation.php";
?>