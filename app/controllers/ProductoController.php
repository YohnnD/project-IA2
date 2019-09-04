<?php
	class ProductoController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Productos/Productos');
		}

		public function create() {
			$this->view('Productos/Productos.Registrar');
		}

		public function getAll() {
			$producto = new Producto(); // Instancia el objeto
			$allProductos = $producto->getAll(); // Obtiene todos los registros del producto
			$this->view('Productos/Productos.Consultar', ['allProductos' => $allProductos]); // Envia los registros a la vista
		}

		public function register() {
			if($_POST) {
				$codigo_producto = $this->input('codigo_producto', true, 'string');
				$nombre_producto = $this->input('nombre_producto', true, 'string');
				$descripcion_producto = $this->input('descripcion_producto', true, 'string');
				$tipo_producto = $this->input('tipo_producto', true, 'string');
				$modelo_producto = $this->input('modelo_producto', true, 'string');
				$costo_producto = $this->input('costo_producto', true, 'int');
				$precio_producto = $this->input('precio_producto', true, 'int');
				$stock_max_producto = $this->input('stock_max_producto', true, 'int');
				$stock_min_producto = $this->input('stock_min_producto', true, 'int');
				$talla = $this->input('talla', false, 'string');
				$stock_pro_talla = $this->input('stock_pro_talla', false, 'int');

				if($this->validateFails()) { // Si la validacion falla
					$this->redirect('Producto','index'); // Redirecciona al inicio.
				}
				else {
					$producto = new Producto(); // Instancia el objeto
					// Setea los campos
					$producto->setCodigoProducto($codigo_producto);
					$producto->setNombreProducto(ucwords($nombre_producto));
					$producto->setDescripcionProducto(ucwords($descripcion_producto));
					$producto->setTipoProducto($tipo_producto);
					$producto->setModeloProducto($modelo_producto);
					$producto->setCostoProducto($costo_producto);
					$producto->setPrecioProducto($precio_producto);
					$producto->setStockMaxProducto($stock_max_producto);
					$producto->setStockMinProducto($stock_min_producto);
					$producto->setTalla($talla);
					$producto->setStockProTalla($stock_pro_talla);
					$data = $producto->insert();
					$this->sendAjax($data);
				}
			}
		}

		public function details() {
			if(isset($_GET['codigo_producto'])){
				$codigo_producto = $_GET['codigo_producto'];
				$producto = new Producto();
				$producto->getOne($codigo_producto);
			}
			$this->view('Productos/Productos.Detalles');
		}

		public function update() {

		}

		public function delete() {

		}
	}
?>