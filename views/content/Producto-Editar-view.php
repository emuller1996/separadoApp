<?php
require_once "./controllers/productosControlador.php";
require_once "./controllers/rubroControlador.php";
$controlador_usuario = new productosControlador();
$ins_rubroContorlador = new rubroControlador();

$usuario_editar = $controlador_usuario->get_producto_controlador($pagina[1]);
$listaRubro = $ins_rubroContorlador->rubro_all();
echo var_dump($usuario_editar);
echo var_dump($listaRubro);

?>

<div class="card o-hidden border-0 shadow-lg my-4">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">

            <div class="col">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Editar Producto.</h1>
                    </div>
                    <form class="user FormularioAjax" action="<?php echo SERVERURL ?>ajax/productoAjax.php" method="POST" data-form="update" autocomplete="off">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="hidden" name="producto_id_edit" value="<?php echo $usuario_editar['producto_id']; ?>">
                                <input type="text" class="form-control form-control-user" id="producto_codigo_edit" name="producto_codigo_edit" value="<?php echo $usuario_editar['producto_codigo']; ?>" placeholder="Codigo">
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user" id="producto_existencia_edit" name="producto_existencia_edit" value="<?php echo $usuario_editar['producto_existencia']; ?>" placeholder="Existencias">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="producto_descripcion_edit" name="producto_descripcion_edit" value="<?php echo $usuario_editar['producto_descripcion']; ?>" placeholder="Descripcion">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user" id="producto_costo_edit" name="producto_costo_edit" value="<?php echo $usuario_editar['producto_costo']; ?>" placeholder="Costo">
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user" id="producto_precio_edit" name="producto_precio_edit" value="<?php echo $usuario_editar['producto_precio']; ?>" placeholder="Precio">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <select class="custom-select " id="producto_rubro_id_edit" name="producto_rubro_id_edit">                
                                    <?php foreach($listaRubro as $rubro){ ?>
                                    <option  <?php if($rubro['rubro_id']==$usuario_editar['rubro_id']){ echo 'selected'; }else{} ?>  value="<?php echo $rubro['rubro_id'] ?>"> <?php echo $rubro['rubro_nombre'] ?> </option>                                                     
                                    <?php } ?>
                                </select>
                                
                                <div class="invalid-feedback text-center">
                                    Campo Rubro es obligatorio
                                </div>
                            </div>
                        </div>
                        
                            


                            <button type="submit" class="btn btn-google btn-user btn-block">
                                <i class="fas fa-save mr-2"></i>
                                Guardar
                            </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>