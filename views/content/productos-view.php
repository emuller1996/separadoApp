<?php

require_once "./controllers/productosControlador.php";
$ins_productos_controlador = new productosControlador();
$datos = $ins_productos_controlador->producto_all_controlador();
?>

<div class="card  border-left-info  rounded">
    <div class="card-header">
        <div class="text-center fw-bold text-info font-weight-bold m-0">
            Lista Productos.
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-xl-3 col-md-6 col-sm-12">
                <a href="<?php echo SERVERURL ?>producto-nuevo" class="btn btn-info py-3 w-100 mb-2">
                    <i class="fas fa-plus-circle mr-2"></i>NUEVO PRODUCTO
                </a>
            </div>
            <div class="col-xl-3 col-md-6 col-sm-12">
                <a href="<?php echo SERVERURL ?>Rubros" class="btn btn-warning py-3 w-100 mb-2">
                    <i class="fas fa-tasks mr-2"></i>GESTION RUBRO
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="data-table" class="table-hover table-striped bg-light rounded border">
                <thead>
                    <th>&nbsp;</th>
                    <th>Codigo</th>
                    <th>Description</th>
                    <th>Costo</th>
                    <th>Precio</th>
                    <th>Existencia</th>
                    <th>Rubro</th>
                    <th>Creado</th>
                    <th>Estado</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    <?php foreach ($datos as $row) { ?>
                        <tr>

                            <td >
                                <img src="https://placeimg.com/640/480/any" alt="imageProduct" style="width: 8rem;">
                            </td>
                            <td class="text-nowrap"><?php echo $row['producto_codigo'] ?></td>
                            <td class="text-nowrap"><?php echo $row['producto_descripcion'] ?></td>
                            <td class="text-nowrap"><?php echo '$ ' . number_format($row['producto_costo'], 0, '', '.'); ?></td>
                            <td class="text-nowrap"><?php echo '$ ' . number_format($row['producto_precio'], 0, '', '.'); ?></td>
                            <td class="text-nowrap"><?php echo $row['producto_existencia'] ?></td>
                            <td class="text-nowrap"><?php echo $row['rubro_nombre'] ?></td>
                            <td class="text-nowrap"><?php echo $row['producto_creado'] ?></td>
                            <td><span class="px-2 py-1 bg-primary rounded-pill text-white">
                                    <?php
                                    if ($row['producto_estado'] == 1) {
                                        echo 'Activo';
                                    } else {
                                        echo 'Inactivo';
                                    }
                                    ?></span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo SERVERURL . "Producto-Editar/" . mainModel::encryption($row['producto_id']); ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>

                                    <form action="<?php echo SERVERURL ?>ajax/productoAjax.php" class="overflow-hidden FormularioAjax" data-form="dalete" method="post">


                                        <input type="hidden" value="<?php echo mainModel::encryption($row['producto_id']); ?>" name="producto_id_del">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>