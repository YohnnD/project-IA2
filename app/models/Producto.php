<?php
	class Producto extends BaseModel {
		// Atributos
		private $table;
		private $codigoProducto;
		private $nombreProducto;
		private $descripcionProducto;
		private $tipoProducto;
		private $modeloProducto;
		private $costoProducto;
		private $precioProducto;
		private $stockMaxProducto;
		private $stockMinProducto;
		private $stockProducto;
		private $imgProducto;
		private $idTalla;
		private $stockProTalla;

		// Métodos
		public function __construct() {
			$this->table = 'productos';
			parent::__construct();
		}

		// Getters & Setters
		public function getCodigoProducto() {
			return $this->codigoProducto;
		}

		public function getNombreProducto() {
			return $this->nombreProducto;
		}

		public function getDescripcionProducto() {
			return $this->descripcionProducto;
		}

		public function getTipoProducto() {
			return $this->tipoProducto;
		}

		public function getModeloProducto() {
			return $this->modeloProducto;
		}

		public function getCostoProducto() {
			return $this->costoProducto;
		}

		public function getPrecioProducto() {
			return $this->precioProducto;
		}

		public function getStockMaxProducto() {
			return $this->stockMaxProducto;
		}

		public function getStockMinProducto() {
			return $this->stockMinProducto;
		}

		public function getStockProducto() {
			return $this->stockProducto;
		}

		public function getImgProducto() {
			return $this->imgProducto;
		}

		public function getIdTalla() {
			return $this->idTalla;
		}

		public function getStockProTalla() {
			return $this->stockProTalla;
		}

		public function setCodigoProducto($codigoProducto) {
			$this->codigoProducto = $codigoProducto;
		}

		public function setNombreProducto($nombreProducto) {
			$this->nombreProducto = Helpers::aesEncrypt($nombreProducto);
		}

		public function setDescripcionProducto($descripcionProducto) {
			$this->descripcionProducto = Helpers::aesEncrypt($descripcionProducto);
		}

		public function setTipoProducto($tipoProducto) {
			$this->tipoProducto = $tipoProducto;
		}

		public function setModeloProducto($modeloProducto) {
			$this->modeloProducto = $modeloProducto;
		}

		public function setCostoProducto($costoProducto) {
			$this->costoProducto = $costoProducto;
		}

		public function setPrecioProducto($precioProducto) {
			$this->precioProducto = $precioProducto;
		}

		public function setStockMaxProducto($stockMaxProducto) {
			$this->stockMaxProducto = $stockMaxProducto;
		}

		public function setStockMinProducto($stockMinProducto) {
			$this->stockMinProducto = $stockMinProducto;
		}

		public function setStockProducto($stockProducto) {
			$this->stockProducto = $stockProducto;
		}

		public function setImgProducto($imgProducto) {
			$this->imgProducto = $imgProducto;
		}

		public function setIdTalla($idTalla) {
			$this->idTalla = $idTalla;
		}

		public function setStockProTalla($stockProTalla) {
			$this->stockProTalla = $stockProTalla;
		}

		public function save() {

            try {
                $this->db()->beginTransaction();
                $this->registerBitacora(PRODUCTOS, REGISTRAR);
                $query = "INSERT INTO $this->table
						(codigo_producto,
						nombre_producto,descripcion_producto,tipo_producto,
						modelo_producto,costo_producto,precio_producto,stock_max_producto,
						stock_min_producto,stock_producto,img_producto) 
						VALUES 
						(:codigo_producto,:nombre_producto,:descripcion_producto,:tipo_producto,
						:modelo_producto,:costo_producto,:precio_producto,:stock_max_producto,
						:stock_min_producto,:stock_producto,:img_producto)"; // Consulta SQL
                $result = $this->db()->prepare($query); // Prepara la consulta.
                $result->bindParam(':codigo_producto', $this->codigoProducto);
                $result->bindParam(':nombre_producto', $this->nombreProducto);
                $result->bindParam(':descripcion_producto', $this->descripcionProducto);
                $result->bindParam(':tipo_producto', $this->tipoProducto);
                $result->bindParam(':modelo_producto', $this->modeloProducto);
                $result->bindParam(':costo_producto', $this->costoProducto);
                $result->bindParam(':precio_producto', $this->precioProducto);
                $result->bindParam(':stock_max_producto', $this->stockMaxProducto);
                $result->bindParam(':stock_min_producto', $this->stockMinProducto);
                $result->bindParam(':stock_producto', $this->stockProducto);
                $result->bindParam(':img_producto', $this->imgProducto);
                $save = $result->execute(); // Ejecuta la primera consulta.
                $this->db()->commit();
                return $save;
            }catch (Exception $e){
                $this->db()->rollBack();
                return false;
            }
		}

		public function saveTallas() {
			$query = "INSERT INTO pro_tallas (codigo_producto,id_talla,stock_pro_talla) VALUES 
						(:codigo_producto,:id_talla,:stock_pro_talla)";
			$result = $this->db()->prepare($query); // Prepara la consulta.
			$result->bindParam(':codigo_producto', $this->codigoProducto);
			$result->bindParam(':id_talla', $this->idTalla);
			$result->bindParam(':stock_pro_talla', $this->stockProTalla);
			$save = $result->execute(); // Ejecuta la consulta
			return $save;
		}

		public function update() {
			$this->registerBitacora(PRODUCTOS,ACTUALIZAR);
			$query = "UPDATE $this->table SET
						-- codigo_producto = :codigo_producto, 
						nombre_producto = :nombre_producto,
						descripcion_producto = :descripcion_producto, tipo_producto = :tipo_producto,
						modelo_producto = :modelo_producto, costo_producto = :costo_producto,
						precio_producto = :precio_producto, stock_max_producto = :stock_max_producto,
						stock_min_producto = :stock_min_producto, stock_producto = :stock_producto
						WHERE codigo_producto = :codigo_producto";
			$result = $this->db()->prepare($query); // Prepara la consulta.
			$result->bindValue(':codigo_producto', $this->codigoProducto);
			$result->bindValue(':nombre_producto', $this->nombreProducto);
			$result->bindValue(':descripcion_producto', $this->descripcionProducto);
			$result->bindValue(':tipo_producto', $this->tipoProducto);
			$result->bindValue(':modelo_producto', $this->modeloProducto);
			$result->bindValue(':costo_producto', $this->costoProducto);
			$result->bindValue(':precio_producto', $this->precioProducto);
			$result->bindValue(':stock_max_producto', $this->stockMaxProducto);
			$result->bindValue(':stock_min_producto', $this->stockMinProducto);
			$result->bindValue(':stock_producto', $this->stockProducto);
			$save = $result->execute(); // Ejecuta la consulta
			return $save;
		}

		public function updateTallas() {
			try {
				$this->db()->beginTransaction();
				$query = "UPDATE pro_tallas SET 
							id_talla = :id_talla, 
							stock_pro_talla = :stock_pro_talla
							WHERE id_talla = :id_talla AND codigo_producto = :codigo_producto";
				$result = $this->db()->prepare($query); // Prepara la consulta.
				$result->bindParam(':codigo_producto', $this->codigoProducto);
				$result->bindParam(':id_talla', $this->idTalla);
				$result->bindParam(':stock_pro_talla', $this->stockProTalla);
				$save = $result->execute(); // Ejecuta la consulta
				$this->db()->commit();
				return $save;
			}
			catch(Exception $e) {
				$this->db()->rollBack();
        return false;
			}
		}

		public function delete() {
			$this->registerBitacora(PRODUCTOS,ELIMINAR);			
			$query = "DELETE FROM $this->table WHERE codigo_producto = '$this->codigoProducto'"; // Consulta SQL
			$delete = $this->db()->query($query); // Prepara la consulta SQL
			return $delete;
		}

		public function getAll() {
			$this->registerBitacora(PRODUCTOS,CONSULTAR);			
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

		public function getOne($codigoProducto) {
			$this->registerBitacora(PRODUCTOS, DETALLES);			
			$sql = "SELECT * FROM $this->table AS pro
					WHERE pro.codigo_producto = '$codigoProducto'";
			$query = $this->db()->query($sql);
			if($query){
                if($query->rowCount() != 0){
                    if($row = $query->fetch(PDO::FETCH_OBJ)){ // Si el objeto existe en la tabla
                        $register = $row; // Lo almacena en $register
                    }
                }
                else{
                    $register = null;
                }
            }
            return $register; // Y finalmente, lo retorna.
		}	

		public function up() {

		}

		public function down() {

		}

		public function getAllTallas() {
			$sql = "SELECT * FROM tallas";
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

		public function getProductoXTallas($codigoProducto) {
			$sql = "SELECT * FROM pro_tallas AS pt 
						INNER JOIN tallas AS t
							ON t.id_talla = pt.id_talla
						WHERE pt.codigo_producto = '$codigoProducto'";
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

		public function checkCodigoProducto() {
			$sql = "SELECT codigo_producto FROM $this->table 
					WHERE codigo_producto = '$this->codigoProducto'";
			$query = $this->db()->query($sql);
			if($query){
				if($query->rowCount() != 0){
					if($row = $query->fetch(PDO::FETCH_OBJ)){ // Si el objeto existe en la tabla
						$register = $row; // Lo almacena en $register
					}
				}
				else{
					$register = null;
				}
			}
			return $register; // Y finalmente, lo retorna.
		}
	}
?>