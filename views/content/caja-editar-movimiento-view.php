<?php
require_once "./controllers/cajaControlador.php";
$ins_caja = new CajaControlador();
$movimiento = $ins_caja->get_caja_movimiento_controlador($pagina[1]);
?>

<div class="card shadow border-left-warning">
    <div class="card-body">
        <div class="block font-weight-bold text-center mb-3 h5 text-white bg-warning border border-warning  py-2 rounded">Editar Movimiento de Caja</div> 
        <form class="row needs-validation FormularioAjax" action="<?php echo SERVERURL ?>ajax/cajaAjax.php" method="POST" data-form="editar" novalidate>
            <div class="col-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Concepto</div>
                    </div>

                    <input type="hidden" name="caja_movimiento_id_edit" value="<?php echo $movimiento['movimiento_caja_id']; ?>">
                    <input type="text" class="form-control" id="caja_movimiento_concepto_edit" value="<?php echo $movimiento['movimiento_caja_concepto']; ?>" name="caja_movimiento_concepto_edit" placeholder="Ingrese aquí el Concepto" required>
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
                    <input type="text" class="form-control" id="caja_movimiento_valor_edit" value="<?php echo $movimiento['movimiento_caja_valor']; ?>" name="caja_movimiento_valor_edit" placeholder="Ingrese aquí el Valor" required>
                    <div class="invalid-feedback text-center">
                        Campo Valor es obligatorio
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <select oninput="select_color()" class="form-control text-white <?php if($movimiento['movimiento_caja_tipo']=='ENTRADA'){echo 'bg-success';}else{echo 'bg-danger';} ?>" id="caja_movimiento_tipo_edit" name="caja_movimiento_tipo_edit">
                        <option <?php if($movimiento['movimiento_caja_tipo']=='SALIDA'){echo 'selected';} ?> value="SALIDA" class="bg-danger">SALIDA</option>
                        <option <?php if($movimiento['movimiento_caja_tipo']=='ENTRADA'){echo 'selected';} ?>  value="ENTRADA" class="bg-success">ENTRADA</option>
                    </select>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary p-3"><i class="fas fa-upload fa-lg mr-3"></i>Modificar</button>
            </div>
        </form>
    </div>
</div>

<?php require_once "./views/include/validation.php" ?>

<script>

    function select_color(){
        var select = $('#caja_movimiento_tipo_edit').val();
        if(select === 'SALIDA'){
            $('#caja_movimiento_tipo_edit').addClass('bg-danger');
            $('#caja_movimiento_tipo_edit').removeClass('bg-success');   
        }else{
            $('#caja_movimiento_tipo_edit').addClass('bg-success');
            $('#caja_movimiento_tipo_edit').removeClass('bg-danger');   
        }

    }



</script>