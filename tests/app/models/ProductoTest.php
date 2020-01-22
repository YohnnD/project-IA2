<?php

// namespace App\Model;
use PHPUnit\Framework\TestCase;

require 'core/BaseModel.php';
require 'app/models/Producto.php';
require 'config/actions.php';
require 'config/modules.php';
$_SESSION['nick_usuario']='angelito';


class ProductoTest extends TestCase{

    protected $producto;

    public function SetUp():void {
    	$this->producto = new Producto;
    	$this->producto->setCodigoProducto('PAN001');
    	$this->producto->setNombreProducto('Pantalon');
    	$this->producto->setDescripcionProducto('Pantalon jean tradicional');
    	$this->producto->setTipoProducto('ma');
    	$this->producto->setModeloProducto('FRR-001');
    	$this->producto->setCostoProducto(10.5);
    	$this->producto->setPrecioProducto(15);
    	$this->producto->setStockMaxProducto(100);
    	$this->producto->setStockMinProducto(24);
    	$this->producto->setStockProducto(50);
    	$this->producto->setImgProducto('imagen.jpg');
    	$this->producto->setIdTalla(1);
    	$this->producto->setStockProTalla(50);
    }

    public function testGetAllProductos() {
        $result = $this->producto->getAll();
        $this->assertIsArray($result);
    }

    public function testSave() {
    	$result = $this->producto->save();
        $this->assertIsBool($result);
    }

    public function testSaveTallas() {
    	$result = $this->producto->saveTallas();
        $this->assertIsBool($result);
    }

    public function testUpdate(){
        $result = $this->producto->update();
        $this->assertIsBool($result);
    }

    public function testUpdateTallas(){
        $result = $this->producto->updateTallas();
        $this->assertIsBool($result);
    }

    public function testDelete(){
        $result = $this->producto->delete();
        $this->assertIsBool($result);
    }

    public function testGetOne(){
        $result = $this->producto->getOne('1');
        $this->assertIsObject($result);
    }

    public function testGetAllTallas() {
        $result = $this->producto->getAllTallas();
        $this->assertIsArray($result);
    }

    public function testGetProductoXTallas() {
    	$result = $this->producto->getProductoXTallas('1');
        $this->assertIsArray($result);
    }

    public function testCheckCodigoProducto() {
    	$result = $this->producto->checkCodigoProducto();
        $this->assertIsBool($result);
    }
}