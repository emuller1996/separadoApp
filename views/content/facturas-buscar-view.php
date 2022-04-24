<div class="card border-info p-0 shadow ">
    <div class="card-header border-0 bg-info py-1">
        <div class="text-center text-white font-weight-bold"> Buscar factura emitidas por fecha. </div>
    </div>
    <div class="card-body">
        <form action="<?php echo SERVERURL ?>ajax/facturaAjax.php" class="FormularioAjax" data-form="buscar" method="POST">
            <div class="row">
                <div class="col-6 text-center">
                    <div class="block  mb-3">Fecha Inicio</div>
                    <input class="form-control w-75 text-center mx-auto" type="date" name="factura_buscar_fecha_inicio" id="factura_buscar_fecha_inicio">
                </div>
                <div class="col-6 text-center">
                    <div class="block  mb-3">Fecha Fin</div>
                    <input class="form-control w-75 text-center mx-auto" type="date" name="factura_buscar_fecha_fin" id="factura_buscar_fecha_fin">
                </div>
                <div class="col-12 mt-3">
                    <button class="btn btn-info w-100" type="submit">
                        Consultar
                    </button>
                </div>
            </div>
        </form>
        
    </div>
</div>