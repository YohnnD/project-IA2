<?php
	class Estadistica extends BaseModel {
		

		public function __construct() {
			parent::__construct();

		}

		public function producto(){
			
			$producto=$this->db()->query("SELECT pro_pedidos.codigo_producto, productos.nombre_producto, productos.tipo_producto, productos.precio_producto,
			COUNT( pro_pedidos.codigo_producto ) AS total 
			FROM  pro_pedidos INNER JOIN productos ON pro_pedidos.codigo_producto = productos.codigo_producto
			GROUP BY pro_pedidos.codigo_producto, productos.nombre_producto, productos.tipo_producto, productos.precio_producto
			ORDER BY total DESC LIMIT 5");

				if($producto->rowCount()>=1){

					while($fila=$producto->fetch(PDO::FETCH_OBJ)){
						$result[]=$fila;
					}	
					return $result;
				}
					else{
						return $result=null;
					}
		}

		public function pedido(){

			$pedido=$this->db()->query("SELECT * FROM pedidos INNER JOIN clientes ON pedidos.cedula_cliente = clientes.cedula_cliente  WHERE status_pedido = 'En Proceso'");

			if($pedido->rowCount()>=1){

				while($fila=$pedido->fetch(PDO::FETCH_OBJ)){
					$result[]=$fila;
				}	
				return $result;
			}
				else{
					return $result=null;
				}
				
		}
		public function servicio(){

			$servicio=$this->db()->query("SELECT servi_pedidos.id_servicio, servicios.nombre_servicio, servicios.descripcion_servicio ,servicios.precio_servicio,
			COUNT( servi_pedidos.id_servicio ) AS total 
			FROM  servi_pedidos INNER JOIN servicios ON servi_pedidos.id_servicio = servicios.id_servicio 
			GROUP BY servi_pedidos.id_servicio, servicios.nombre_servicio,servicios.descripcion_servicio, servicios.precio_servicio
			ORDER BY total DESC LIMIT 2");

				if($servicio->rowCount()>=1){

					while($fila=$servicio->fetch(PDO::FETCH_OBJ)){
						$result[]=$fila;
					}	
					return $result;
				}
					else{
						return $result=null;
					}

						}
		public function cliente(){

			$cliente=$this->db()->query("SELECT COUNT(cedula_cliente) AS total FROM clientes");

			if($cliente->rowCount()>=1){

				while($fila=$cliente->fetch(PDO::FETCH_OBJ)){
					$result[]=$fila;
				}	
				return $result;
			}
				else{
					return $result=null;
				}

					}

		public function factura(){

			$factura=$this->db()->query("SELECT COUNT(codigo_factura) AS total FROM factura_ventas;");

			if($factura->rowCount()>=1){

				while($fila=$factura->fetch(PDO::FETCH_OBJ)){
					$result[]=$fila;
				}	
				return $result;
			}
				else{
					return $result=null;
				}

		}

		public function ingreso(){

			$ingreso=$this->db()->query("SELECT to_char(fecha_factura, 'MM/YYYY') AS mes, count(*) AS ventas FROM factura_ventas GROUP BY mes");

			if($ingreso->rowCount()>=1){
				while($fila=$ingreso->fetch(PDO::FETCH_ASSOC)){
					$result[]=$fila;
				}
				return $result;
			}else{
				return $result=null;
			}
			

		}

		public function ganancia(){


		}

	}
?>