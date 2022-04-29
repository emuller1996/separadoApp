<?php
require_once "./controllers/rubroControlador.php";
$ins_rubroContorlador = new rubroControlador();
$listaRubro = $ins_rubroContorlador->rubro_all();
?>

<div class="card o-hidden border-0 shadow-lg my-4">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">

            <div class="col">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Nuevo Producto.</h1>
                    </div>
                    <form class="user FormularioAjax needs-validation" action="<?php echo SERVERURL ?>ajax/productoAjax.php" method="POST" data-form="save" autocomplete="off" novalidate>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control " id="producto_codigo_reg" name="producto_codigo_reg" placeholder="Codigo" required>
                                <div class="invalid-feedback text-center">
                                    Campo Codigo es obligatorio
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control " id="producto_existencia_reg" name="producto_existencia_reg" placeholder="Existencias" required>
                                <div class="invalid-feedback text-center">
                                    Campo Existencias es obligatorio
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="producto_descripcion_reg" name="producto_descripcion_reg" placeholder="Descripcion" required>
                            <div class="invalid-feedback text-center">
                                Campo Descripcion es obligatorio
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" class="form-control " id="producto_costo_reg" name="producto_costo_reg" placeholder="Costo" required>
                                <div class="invalid-feedback text-center">
                                    Campo Costo es obligatorio
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control " id="producto_precio_reg" name="producto_precio_reg" placeholder="Precio" required>
                                <div class="invalid-feedback text-center">
                                    Campo Precio es obligatorio
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select class="custom-select " id="producto_rubro_reg" name="producto_rubro_reg">                
                                    <?php foreach($listaRubro as $rubro){ ?>
                                    <option value="<?php echo $rubro['rubro_id'] ?>"> <?php echo $rubro['rubro_nombre'] ?> </option>                                                     
                                    <?php } ?>
                                </select>
                                
                                <div class="invalid-feedback text-center">
                                    Campo Rubro es obligatorio
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-google py-3 btn-block">
                            <i class="fas fa-save mr-2"></i>
                            Guardar
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "./views/include/validation.php"; ?>