<?php
require_once "./controllers/clienteControlador.php";
$ins_cliente_controlador = new clienteControlador();
$lista_clientes = $ins_cliente_controlador->listar_clientes_controlador();

?>
<div class="card border-left-danger shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary text-center text-danger">Lista Clientes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-hover table-striped table-bordered" id="data-table">
                <thead>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Estado</th>
                    <th>
                        <a href="<?php echo SERVERURL ?>cliente-nuevo" class="btn btn btn-danger">
                            <i class="fas fa-plus-circle mr-2"></i>Nuevo
                        </a>
                    </th>
                </thead>
                <tbody>
                    

                    <?php foreach ($lista_clientes as $cliente) { ?>
                        <tr>
                            <td><?php echo $cliente['cliente_cedula']; ?></td>
                            <td><?php echo $cliente['cliente_nombre']; ?></td>
                            <td><?php echo $cliente['cliente_correo']; ?></td>
                            <td><?php echo $cliente['cliente_telefono']; ?></td>
                            <td>ACTIVO</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="<?php echo SERVERURL . "cliente-editar/" . mainModel::encryption($cliente['cliente_id']); ?>" class="btn btn-sm  btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="<?php echo SERVERURL ?>ajax/productoAjax.php" class="overflow-hidden FormularioAjax" data-form="dalete" method="post">
                                        <input type="hidden" value="" name="producto_id_del">
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