<div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
        <h4 class="text-center mb-2 ">Registrar Factura</h4>
        <hr>

        <form action="<?php echo SERVERURL ?>ajax/facturaAjax.php" class="FormularioAjax" data-form="loans" method="POST">
            <div class="row g-4">
                <div class="col-12 text-sm text-center mb-2" style="font-size: 12px;">
                    Datos Cliente
                </div>

                
                <?php if (empty($_SESSION['datos_cliente'])) { ?>

                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <input name="factura_cliente_documento" id="factura_cliente_documento" class="user form-control" value="" type="number" placeholder="Documento">
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6">
                        <input class="user form-control" type="text" value="" placeholder="Nombre del Cliente">
                    </div>
                    <div class="col-2 col-lg-1">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_cliente">
                            <i class="fas fa-search mr-2"></i>
                        </button>
                    </div>


                <?php } else { ?>
                   
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <input type="hidden" name="factura_cliente_id_del" value="<?php echo $_SESSION['datos_cliente']['ID'] ?>">
                        <input name="factura_cliente_documento" id="factura_cliente_documento" class="user form-control" value="<?php echo $_SESSION['datos_cliente']['Documento'] ?>" type="number" placeholder="Documento">
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6">
                        <input class="user form-control" type="text" value="<?php echo $_SESSION['datos_cliente']['Nombre'] ?>" placeholder="Nombre del Cliente">
                    </div>
                    <div class="col-2 col-lg-1">
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#">
                            <i class="fas fa-trash-alt mr-2"></i>

                        </button>
                    </div>
                    

                <?php } ?>
                

            </div>
            </form> 
            <hr>
            <div class="table-resposive">
                <table class="table table-bordered">
                    <thead>
                        <th>Cantidad</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Vr Unitario</th>
                        <th>Vr Total</th>
                    </thead>
                </table>
            </div>
        
    </div>
</div>




<!-- Modal Buscar Cliente  -->
<div class="modal fade" id="modal_cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buscar Clientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="text-center fs-6 mb-2">Ingrese el codigo, documento o nombre del Cliente para realizar la busqueda.</div>
                            <input name="input_cliente" oninput="buscar_cliente()" id="input_cliente" type="text" class="form-control" placeholder="Ingresa Aqui ">
                        </div>
                        <div class="col-12">
                            <button type="button" onclick="buscar_cliente()" class="btn btn-primary w-100">
                                Buscar
                            </button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive" id="tabla_cliente">


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>

<?php require_once "./views/include/factura.php"; ?>