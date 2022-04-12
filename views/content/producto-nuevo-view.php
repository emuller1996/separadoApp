<div class="card o-hidden border-0 shadow-lg my-4">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            
            <div class="col">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Nuevo Producto.</h1>
                    </div>
                    <form class="user FormularioAjax" action="<?php echo SERVERURL?>ajax/productoAjax.php" method="POST" data-form="save" autocomplete="off" >
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="producto_codigo_reg" name="producto_codigo_reg" placeholder="Codigo">
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user" id="producto_existencia_reg" name="producto_existencia_reg" placeholder="Existencias">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="producto_descripcion_reg" name="producto_descripcion_reg" placeholder="Descripcion">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user" id="producto_costo_reg" name="producto_costo_reg" placeholder="Costo">
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user" id="producto_precio_reg" name="producto_precio_reg" placeholder="Precio">
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