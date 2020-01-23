<?php

use PHPUnit\Framework\TestCase;

require 'core/BaseModel.php';
require 'app/models/Estadistica.php';
require 'config/actions.php';
require 'config/modules.php';
$_SESSION['nick_usuario']='codeslator';

class EstadisticaTest extends TestCase{

	protected $estadistica;

	public function SetUp():void
    {

        $this->estadistica= new Estadistica();

    }

     public function testPedido(){

		$result = $this->estadistica->pedido();
        $this->assertIsArray($result);
    
    }

     public function testProducto()
    {	
    	
        $result = $this->estadistica->producto();
        $this->assertIsArray($result);
  
    }


    public function testServicio(){

		$result = $this->estadistica->servicio();
        $this->assertIsArray($result);
    
    }
    
    public function testCliente(){

		$result = $this->estadistica->cliente();
        $this->assertIsArray($result);
	}

 	public function testIngreso(){

		$result = $this->estadistica->ingreso();
        $this->assertIsArray($result);
	}


}