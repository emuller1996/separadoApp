<script>
    /**Buscar Cliente Factura */
    function buscar_cliente(){
        let input_buscar = document.querySelector("#input_cliente").value;
        input_buscar=input_buscar.trim();

        if(input_buscar!=""){
            let datos = new FormData();
            datos.append("buscar_cliente",input_buscar);

            fetch("<?php echo SERVERURL?>ajax/facturaAjax.php",{
                method:'POST',
                body:datos
            })
			.then(respuesta => respuesta.text())
			.then(respuesta => {
                let tabla_cliente = document.querySelector("#tabla_cliente");
                tabla_cliente.innerHTML=respuesta;
			});
        }else{
            

        }
    }


    /** Agregar Cliente Factura */
    function agregar_cliente(id){
        $('#modal_cliente').modal('hide');
        Swal.fire({
		title: '¿Desea agregar el Cliente?',
		text: 'Se va Agregar el Cliente para Realizar la Factura',
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Agregar',
		cancelButtonText: 'No, Cancelar'
	}).then((result) => {
		if(result.value){
            let datos = new FormData();
            datos.append("id_agregar_cliente",id);
			fetch("<?php echo SERVERURL?>ajax/facturaAjax.php",{
                method:'POST',
                body:datos
            })
			.then(respuesta => respuesta.json())
			.then(respuesta => {
                return alertas_ajax(respuesta);
			});
		}else{
            $('#modal_cliente').modal('show');
        }   
	});
    }

    /**Buscar Producto Factura */
    function buscar_producto(){
        let input_producto = document.querySelector("#input_producto").value;
        input_producto=input_producto.trim();

        if(input_producto!=""){
            let datos = new FormData();
            datos.append("buscar_producto",input_producto);

            fetch("<?php echo SERVERURL?>ajax/facturaAjax.php",{
                method:'POST',
                body:datos
            })
			.then(respuesta => respuesta.text())
			.then(respuesta => {
                let tabla_cliente = document.querySelector("#tabla_producto");
                tabla_cliente.innerHTML=respuesta;
			});
        }else{
            

        }
    }

    /** Agregar Producto Factura*/
    function agregar_producto(id){
        $('#modal_producto').modal('hide');
        $('#modal_agregar_producto').modal('show');
        document.querySelector('#id_producto_agregar_factura').setAttribute('value',id);
    }
    function modal_buscar_producto(id){
        $('#modal_agregar_producto').modal('hide');
        $('#modal_producto').modal('show');
    }

    function valor_total(){
        

        var total = $('#detalle_cantidad').val() * $('#detalle_valor_unitario').val();
        
        $('#detalle_valor_total').val(total)  ;
    }
</script>