<div class="card o-hidden border-0 shadow-lg my-4">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            
            <div class="col">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Nuevo Cliente.</h1>
                    </div>
                    <form class="user FormularioAjax" action="<?php echo SERVERURL?>ajax/clienteAjax.php" method="POST" data-form="save" autocomplete="off" >
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user" id="cliente_documento_reg" name="cliente_documento_reg" placeholder="Documento">
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user" id="cliente_telefono_reg" name="cliente_telefono_reg" placeholder="Telefono">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="cliente_nombre_reg" name="cliente_nombre_reg" placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="cliente_correo_reg" name="cliente_correo_reg" placeholder="Correo">
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