<?php

use PHPUnit\Framework\TestCase;

require 'core/BaseModel.php';
require 'app/models/Material.php';
require 'config/actions.php';
require 'config/modules.php';
$_SESSION['nick_usuario']='Aserranogomez';

class MaterialTest extends TestCase{

    protected $material;

    public function SetUp():void
    {
        $this->material= new Material();

        $this->material->setId_material(1);

        $this->material->setNombre_material(ucwords("Tijeras"));
        $this->material->setDescripcion_material(ucwords("Este es un material"));
        $this->material->setUnidad_material("Mts");
        $this->material->setPrecio_material(26);
    }


    public function testGetAllMaterial()
    {
        $result = $this->material->getAll();
        $row = array_values($result);
        $row = $row[0];
        $this->assertIsString($row->nombre_material);
        $this->assertIsString($row->descripcion_material);
        $this->assertIsString($row->unidad_material);
        $this->assertIsInt($row->precio_material);
    }

    public function testSave(){
        $result=$this->material->save();
        $this->assertIsBool($result);
    }

    public function testGetById(){
        $result = $this->material->getById();
        $this->assertIsObject($result);
    }

    public function testSearchName(){
        $result = $this->material->search('Tijeras');
        $this->assertIsObject($result);
    }

    public function testUpdate(){
        $result = $this->material->update();
        $this->assertIsBool($result);
    }


    public function testDelete(){
        $result = $this->material->delete();
        $this->assertIsObject($result);
    }

}