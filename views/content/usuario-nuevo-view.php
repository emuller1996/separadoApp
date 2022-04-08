<div class="card o-hidden border-0 shadow-lg my-4">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            
            <div class="col">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Nuevo Usuario</h1>
                    </div>
                    <form class="user FormularioAjax"   action="<?php echo SERVERURL?>ajax/usuarioAjax.php" method="POST" data-form="save" autocomplete="off" >
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="usuario_nombre_reg" name="usuario_nombre_reg" placeholder="Nombre">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="usuario_apellido_reg" name="usuario_apellido_reg" placeholder="Apellido">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="usuario_email_reg" name="usuario_email_reg" placeholder="Correo Electrónico">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="usuario_usuario_reg" name="usuario_usuario_reg" placeholder="Usuario">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="usuario_pass_reg_1" name="usuario_pass_reg_1"placeholder="Contraseña">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="usuario_pass_reg_2" name="usuario_pass_reg_2"placeholder="Confirmar Contraseña">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control form-control-user" id="usuario_telefono_reg" name="usuario_telefono_reg" placeholder="Teléfono">
                        </div>
                        <button type="submit" class="btn btn-google btn-user btn-block">
                        <i class="fas fa-plus-circle me-4"></i>
                                Guardar
                        </button>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>