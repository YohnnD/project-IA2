<?php
	class Producto extends BaseModel {
		// Atributos
		private $table;
		private $codigo_producto;
		private $nombre_producto;
		private $descripcion_producto;
		private $tipo_producto;
		private $modelo_producto;
		private $costo_producto;
		private $precio_producto;
		private $stock_max_producto;
		private $stock_min_producto;
		private $talla;
		private $stock_pro_talla;

		// Métodos
		public function __construct() {
			$this->table = 'productos';
			parent::__construct();
		}

		// Getters & Setters
		public function getCodigoProducto() {
			return $this->codigo_producto;
		}

		public function getNombreProducto() {
			return $this->nombre_producto;
		}

		public function getDescripcionProducto() {
			return $this->descripcion_producto;
		}

		public function getTipoProducto() {
			return $this->tipo_producto;
		}

		public function getModeloProducto() {
			return $this->modelo_producto;
		}

		public function getCostoProducto() {
			return $this->costo_producto;
		}

		public function getPrecioProducto() {
			return $this->precio_producto;
		}

		public function getStockMaxProducto() {
			return $this->stock_max_producto;
		}

		public function getStockMinProducto() {
			return $this->stock_min_producto;
		}

		public function getTalla() {
			return $this->talla;
		}

		public function getStockProTalla() {
			return $this->stock_pro_talla;
		}

		public function setCodigoProducto($codigo_producto) {
			$this->codigo_producto = $codigo_producto;
		}

		public function setNombreProducto($nombre_producto) {
			$this->nombre_producto = $nombre_producto;
		}

		public function setDescripcionProducto($descripcion_producto) {
			$this->descripcion_producto = $descripcion_producto;
		}

		public function setTipoProducto($tipo_producto) {
			$this->tipo_producto = $tipo_producto;
		}

		public function setModeloProducto($modelo_producto) {
			$this->modelo_producto = $modelo_producto;
		}

		public function setCostoProducto($costo_producto) {
			$this->costo_producto = $costo_producto;
		}

		public function setPrecioProducto($precio_producto) {
			$this->precio_producto = $precio_producto;
		}

		public function setStockMaxProducto($stock_max_producto) {
			$this->stock_max_producto = $stock_max_producto;
		}

		public function setStockMinProducto($stock_min_producto) {
			$this->stock_min_producto = $stock_min_producto;
		}

		public function setTalla($talla) {
			$this->talla = $talla;
		}

		public function setStockProTalla($stock_pro_talla) {
			$this->stock_pro_talla = $stock_pro_talla;
		}

		public function insert() {
			$query = "INSERT INTO $this->table
						(codigo_producto,
						nombre_producto,descripcion_producto,tipo_producto,
						modelo_producto,costo_producto,precio_producto,stock_max_producto,
						stock_min_producto) 
						VALUES 
						(:codigo_producto,:nombre_producto,:descripcion_producto,:tipo_producto,
						:modelo_producto,:costo_producto,:precio_producto,:stock_max_producto,
						:stock_min_producto)"; // Consulta SQL
			$result = $this->db()->prepare($query); // Prepara la consulta.
			$result->bindParam(':codigo_producto', $this->codigo_producto);
			$result->bindParam(':nombre_producto', $this->nombre_producto);
			$result->bindParam(':descripcion_producto', $this->descripcion_producto);
			$result->bindParam(':tipo_producto', $this->tipo_producto);
			$result->bindParam(':modelo_producto', $this->modelo_producto);
			$result->bindParam(':costo_producto', $this->costo_producto);
			$result->bindParam(':precio_producto', $this->precio_producto);
			$result->bindParam(':stock_max_producto', $this->stock_max_producto);
			$result->bindParam(':stock_min_producto', $this->stock_min_producto);
			$insert = $result->execute(); // Ejecuta la primera consulta.
			if($insert) { // Si se ejecuto
				$last_id = $this->db()->lastInsertId(); // Obtiene el ultimo ID ingresado
			}
			$query = "INSERT INTO pro_tallas (codigo_producto,talla,stock_pro_talla) VALUES 
						(:codigo_producto,:talla,:stock_pro_talla)";
			$result = $this->db()->prepare($query); // Prepara la consulta.
			$result->bindParam(':codigo_producto', $last_id);
			$result->bindParam(':talla', $this->talla);
			$result->bindParam(':stock_pro_talla', $this->stock_pro_talla);
			$save = $result->execute(); // Ejecuta la consulta
			return $save;
		}

		public function update() {
			$query = "UPDATE $this->table SET
						codigo_producto = :codigo_producto, 
						nombre_producto = :nombre_producto,
						descripcion_producto = :descripcion_producto, tipo_producto = tipo_producto,
						modelo_producto = :modelo_producto, costo_producto = :costo_producto,
						precio_producto = :precio_producto, stock_max_producto = :stock_max_producto,
						stock_min_producto = :stock_min_producto";
			$result = $this->db()->prepare($query); // Prepara la consulta.
			$result->bindParam(':codigo_producto', $this->codigo_producto);
			$result->bindParam(':nombre_producto', $this->nombre_producto);
			$result->bindParam(':descripcion_producto', $this->descripcion_producto);
			$result->bindParam(':tipo_producto', $this->tipo_producto);
			$result->bindParam(':modelo_producto', $this->modelo_producto);
			$result->bindParam(':costo_producto', $this->costo_producto);
			$result->bindParam(':precio_producto', $this->precio_producto);
			$result->bindParam(':stock_max_producto', $this->stock_max_producto);
			$result->bindParam(':stock_min_producto', $this->stock_min_producto);
			$update = $result->execute(); // Ejecuta la primera consulta.		
			return $update;
		}

		public function delete() {
			$query = "DELETE FROM $this->table WHERE codigo_producto = :codigo_producto"; // Consulta SQL
			$result = $this->db()->prepare($query); // Prepara la consulta SQL
			$result->bindParam(':codigo_producto',$this->codigo_producto);
			$delete = $result->execute(); // Ejecuta la consulta
			return $delete;
		}

		public function getAll() {
			$sql = "SELECT * FROM $this->table";
            $query = $this->db()->query($sql);
            if($query){ // Evalua la cansulta
                if($query->rowCount() != 0) { // Si existe al menos un registro...
                    while($row = $query->fetch(PDO::FETCH_OBJ)) { // Recorre un array (tabla) fila por fila.
                        $resultSet[] = $row; // Llena el array con cada uno de los registros de la tabla.
                    }
                }
                else{ // Sino...
                    $resultSet = null; // Almacena null
                }
            }
            return $resultSet; // Finalmente retornla el arreglo con los elementos.
		}

		public function getOne($codigo_producto) {
			$sql = "SELECT * FROM $this->table WHERE codigo_producto = $codigo_producto";
			$query = $this->db()->query($sql);
			if($row = $query->fetch(PDO::FETCH_OBJ)){
				$register = $row;
			}
			return $register;
		}	
	}
?>