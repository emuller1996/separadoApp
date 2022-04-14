

<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary text-center">Lista Clientes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="tableUsuario">
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
                    <tr>
                        <td>1114734866</td>
                        <td>Estefano Muller</td>
                        <td>emuller@gmail.com</td>
                        <td>318612011</td>
                        <td>ACTIVO</td>
                        <td>
                        <div class="btn-group">
                                    <a href="<?php echo SERVERURL . "cliente-editar/" . mainModel::encryption('sad'); ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <form  action="<?php echo SERVERURL?>ajax/productoAjax.php" class="overflow-hidden FormularioAjax" data-form="dalete" method="post">
                                        <input type="hidden" value="" name="producto_id_del">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>