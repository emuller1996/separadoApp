<?php
require_once "./controllers/rubroControlador.php";

$ins_rubroContorlador = new rubroControlador();
$listaRubro = $ins_rubroContorlador->rubro_all();
?>

<div class="card border-left-warning shadow">
    <div class="card-header">
        <div class="text-center text-warning font-weight-bold m-0">Gestión de Rubros.</div>
    </div>
    <div class="card-body p-0">
        <div class="row p-2">
            <div class="col-2 text-center mx-auto mt-4">
                <a class="btn btn-warning w-100 py-3 " data-toggle="modal" data-target="#modal_add_rubro">
                    <i class="fas fa-plus-circle"></i>
                    Nuevo Rubro
                </a>
            </div>
            <div class="col-10">
                <div class="table-responsive">
                    <table class="table w-100 text-center table-bordered  table-hover">
                        <thead>
                            <th>ID</th>
                            <th>Rubro</th>
                            <th>Descripcion</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            <?php foreach($listaRubro as $rubro){ ?>
                                <tr>
                                    <td> <?php echo $rubro['rubro_id'] ?> </td>
                                    <td> <?php echo $rubro['rubro_nombre'] ?> </td>
                                    <td> <?php echo $rubro['rubro_descripcion'] ?> </td>
                                    <td>
                                        <a class="btn btn-info" href="">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>


                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Agregar Rubro -->
<div class="modal fade" id="modal_add_rubro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="exampleModalLabel">Añadir Rubros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="FormularioAjax needs-validation" method="POST" action="<?php echo SERVERURL ?>ajax/rubroAjax.php" data-form="save" novalidate>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="rubro_nombre">Nombre Rubro</label>
                        <input type="text" class="form-control" id="rubro_nombre_reg" name="rubro_nombre_reg" required>
                        <div class="invalid-feedback text-center">
                            Campo Rubro es obligatorio
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rubro_nombre">Descripcion Rubro</label>
                        <input type="text" class="form-control" id="rubro_descripcion_reg" name="rubro_descripcion_reg" required>
                        <div class="invalid-feedback text-center">
                            Campo Descripcion es obligatorio
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php require_once "./views/include/validation.php" ?>