<div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
        <h4 class="text-center mb-2 ">Registrar Factura</h4>
        <hr>

        <form action="<?php echo SERVERURL ?>ajax/facturaAjax.php" class="FormularioAjax" data-form="loans" method="POST">
        <div class="block text-sm text-center mb-2" style="font-size: 12px;">
                    Datos Cliente
                </div>
            <div class="row">
                


                <?php if (empty($_SESSION['datos_cliente'])) { ?>

                    <div class="col-lg-4 col-md-4 col-sm-4 mb-2">
                        <input readonly name="factura_cliente_documento" id="factura_cliente_documento" class="user form-control" value="" type="number" placeholder="Documento">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 mb-2">
                        <input  readonly class="user form-control" type="text" value="" placeholder="Nombre del Cliente">
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#modal_cliente">
                            <i class="fas fa-search mr-2"></i>Buscar Cliente
                        </button>
                    </div>


                <?php } else { ?>

                    <div class="col-lg-4 col-md-4 col-sm-4 mb-2">
                        <input type="hidden" name="factura_cliente_id_del" value="<?php echo $_SESSION['datos_cliente']['ID'] ?>">
                        <input name="factura_cliente_documento" disabled id="factura_cliente_documento" class="user form-control" value="<?php echo $_SESSION['datos_cliente']['Documento'] ?>" type="number" placeholder="Documento">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 mb-2">
                        <input class="user form-control" type="text" disabled value="<?php echo $_SESSION['datos_cliente']['Nombre'] ?>" placeholder="Nombre del Cliente">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger w-100" data-toggle="modal" data-target="#">
                            <i class="fas fa-trash-alt mr-2"></i>

                        </button>
                    </div>


                <?php } ?>


            </div>
        </form>
        <hr>
        <div class="block text-center mb-2" style="font-size: 12px;">
            Datos de Productos
        </div>
        <button class="btn btn-info w-100 mb-3" data-toggle="modal" data-target="#modal_producto">
            <i class="fas fa-cart-plus mr-2"></i>
            Agregar Producto
        </button>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>

                    <th>Descripcion</th>
                    <th>Codigo</th>
                    <th>Cantidad</th>
                    <th>Vr Unitario</th>
                    <th>Vr Total</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION['datos_producto'])) {
                        $_SESSION['factura_total'] = 0;
                        $_SESSION['total_productos'] = 0;
                        foreach ($_SESSION['datos_producto'] as $producto) {
                            $subtotal = $producto['Cantidad'] * $producto['Valor_Unitario'];

                    ?>
                            <tr>
                                <td class="text-center text-nowrap"><?php echo $producto['Descripcion']; ?></td>
                                <td class="text-center text-nowrap"><?php echo $producto['Codigo']; ?></td>
                                <td class="text-center"><?php echo $producto['Cantidad']; ?></td>


                                <td class="text-center text-nowrap"><?php echo '$ ' . number_format($producto['Valor_Unitario'], 0, '', '.'); ?></td>
                                <td class="text-center text-nowrap"><?php echo '$ ' . number_format($producto['Valor_total'], 0, '', '.'); ?></td>
                                <td class="text-center text-nowrap">
                                    <form action="<?php echo SERVERURL ?>ajax/facturaAjax.php" class="FormularioAjax" data-form="loans" method="POST">
                                        <input type="hidden" name="id_eliminar_producto" value="<?php echo $producto['ID']; ?>">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            $_SESSION['factura_total'] += $subtotal;
                            $_SESSION['total_productos'] += $producto['Cantidad'];
                        }
                        ?>
                        <tr>
                            <td colspan="2" class="text-center font-weight-bold h5">Total </td>
                            <td colspan="1" class="text-center font-weight-bold h5"> <?php echo number_format($_SESSION['total_productos'], 0, '', '.'); ?></td>
                            <td>&nbsp;</td>
                            <td colspan="1" class="text-center font-weight-bold h5">$ <?php echo number_format($_SESSION['factura_total'], 0, '', '.'); ?></td>
                        </tr>
                    <?php

                    } else {
                    ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                No se han Seleccionado Productos para Realizar la Factura.
                            </td>
                        </tr>

                    <?php
                    }
                    ?>

                </tbody>
            </table>

        </div>
        <hr>
        <div class="block text-center mb-2" style="font-size: 12px;">
            Datos factura
        </div>
        <?php
        require_once "./controllers/facturaControlador.php";
        $ins_factura = new FacturaControlador();

        $factura_id_id = $ins_factura->get_facturas_id_controlador();
        ?>
        <form action="<?php echo SERVERURL ?>ajax/facturaAjax.php" class="FormularioAjax" data-form="save" method="POST">

            <div class="row mb-4">
                <div class="col-6">
                    <div class="text-center">
                        <span class="font-weight-bolder">FT - </span><?php echo  $factura_id_id['COUNT(factura_id)'] + 1; ?>
                    </div>
                </div>
                <div class="col-6 text-center">

                    <select class="form-control" name="tipo_factura" id="tipo_factura" oninput="separado_collapse()">
                        <optgroup>
                            <option  value="FACTURA">FACTURA</option>
                            <option  value="SEPARADO">SEPARADO</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="collapse" id="collapseSeparado">
                <div class="card card-body mb-4 border-info">
                    <div class="row">
                        <div class="col-12 text-center mb-3" style="font-size: 12px;">
                            Datos Separado
                        </div>
                        <div class="col-6">
                            <input class="form-control" oninput="valor_saldo()" type="text" name="separado_abonado_reg" id="separado_abonado_reg" placeholder="Valor Abonado">
                        </div>
                        <div class="col-6">
                            <input class="form-control" type="text" name="separado_saldo_reg" id="separado_saldo_reg" placeholder="Valor Saldo">
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="total_factura_reg" id="total_factura_reg" value="<?php if (isset($_SESSION['factura_total'])) echo $_SESSION['factura_total']; ?>">
            <button class="btn btn-success w-100" type="submit">
            <i class="fas fa-check-double mr-2"></i> Facturar
            </button>
        </form>

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
                <form action="" method="post" >
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="text-center fs-6 mb-2">Ingrese el codigo, documento o nombre del Cliente para realizar la busqueda.</div>
                            <input autocomplete="off" name="input_cliente" oninput="buscar_cliente()" id="input_cliente" type="text" class="form-control" placeholder="Ingresa Aqui ">
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


<!-- Modal Buscar Producto  -->
<div class="modal fade" id="modal_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Buscar Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="text-center fs-6 mb-2">Ingrese el codigo o descripcion del Producto para realizar la busqueda.</div>
                            <input  autocomplete="off" name="input_producto" oninput="buscar_producto()" id="input_producto" type="text" class="form-control" placeholder="Ingresa Aqui ">
                        </div>
                        <div class="col-12">
                            <button type="button" onclick="buscar_producto()" class="btn btn-primary w-100">
                                Buscar
                            </button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive" id="tabla_producto">


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Producto  -->
<div class="modal fade" id="modal_agregar_producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Agregar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo SERVERURL ?>ajax/facturaAjax.php" class="FormularioAjax" data-form="default" method="POST" autocomplete="off">
                <div class="modal-body">

                    <input type="hidden" name="id_producto_agregar_factura" id="id_producto_agregar_factura">
                    <div class="row">
                        <div class="col-6">Cantidad</div>
                        <div class="col-6 mb-3">
                            <input class="form-control" type="number" name="detalle_cantidad" id="detalle_cantidad">
                        </div>
                        <div class="col-6">Valor Unitario</div>
                        <div class="col-6 mb-3">
                            <input class="form-control" type="number" oninput="valor_total()" name="detalle_valor_unitario" id="detalle_valor_unitario">
                        </div>
                        <div class="col-6">Valor Total</div>
                        <div class="col-6 mb-3">
                            <input class="form-control" type="number" name="detalle_valor_total" id="detalle_valor_total">
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="modal_buscar_producto()">Cerrar</button>
                    <button type="submit" class="btn btn-success">Agregar</button>

                </div>
            </form>
        </div>
    </div>
</div>




<?php require_once "./views/include/factura.php"; ?>