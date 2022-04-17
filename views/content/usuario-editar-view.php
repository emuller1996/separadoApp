<?php
require_once "./controllers/usuarioControlador.php";
$ins_usuario_controlador = new usuarioControlador();
echo $pagina[1] . "<br>";
echo mainModel::decryption($pagina[1]);
$datos_usuario = $ins_usuario_controlador->get_usuario_controlador($pagina[1]);
echo var_dump($datos_usuario);
echo mainModel::decryption($datos_usuario['usuario_pass']);

?>

<div class="card o-hidden border-0 shadow-lg my-4">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            
            <div class="col">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Editar Usuario</h1>
                    </div>
                    <form class="user FormularioAjax"   action="<?php echo SERVERURL?>ajax/usuarioAjax.php" method="POST" data-form="update" autocomplete="off" >
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="usuario_nombre_edit" name="usuario_nombre_edit" value="<?php echo $datos_usuario["usuario_nombre"]; ?>" placeholder="Nombre">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="usuario_apellido_edit" name="usuario_apellido_edit" value="<?php echo $datos_usuario["usuario_apellido"]; ?>" placeholder="Apellido">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="usuario_email_edit" name="usuario_email_edit" value="<?php echo $datos_usuario["usuario_email"]; ?>" placeholder="Correo Electrónico">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="usuario_usuario_edit" name="usuario_usuario_edit" value="<?php echo $datos_usuario["usuario_usuario"]; ?>" placeholder="Usuario">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="usuario_pass_edit" name="usuario_pass_edit" value="<?php echo mainModel::decryption($datos_usuario['usuario_pass']);?>" placeholder="Contraseña">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="usuario_pass_edit" name="usuario_pass_edit"placeholder="Confirmar Contraseña">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control form-control-user" id="usuario_telefono_edit" name="usuario_telefono_edit" value="<?php echo $datos_usuario["usuario_telefono"]; ?>" placeholder="Teléfono">
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