<script>
    
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
</script>