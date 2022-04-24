<?php
	
	class vistasModelo{

		/*--------- Modelo obtener vistas ---------*/
		protected static function obtener_vistas_modelo($vistas){
			$listaBlanca=["home","Clientes","Login",
			"Productos","producto-nuevo","Producto-Editar","Usuarios",
			"usuario-nuevo","usuario-editar",
			"cliente-nuevo",
			"registrar-factura","facturas-emitidas","ver-factura","facturas-buscar","facturas-por-fecha",
			"Separados","separado"];
			if(in_array($vistas, $listaBlanca)){
				if(is_file("./views/content/".$vistas."-view.php")){
					$contenido="./views/content/".$vistas."-view.php";
				}else{
					$contenido="404";
				}
			}elseif($vistas=="login" || $vistas=="index"){
				$contenido="login";
			}else{
				$contenido="404";
			}
			return $contenido;
		}
	}