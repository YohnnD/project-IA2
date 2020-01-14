<?php

use PHPUnit\Framework\TestCase;

require 'core/BaseModel.php';
require 'app/models/Tela.php';
require 'config/actions.php';
require 'config/modules.php';
$_SESSION['nick_usuario']='Aserranogomez';

class TelaTest extends TestCase{

    protected $tela;

    public function SetUp():void
    {
        $this->tela= new Tela();

        $this->tela->setId_tela(1);

        $this->tela->setNombre_tela(ucwords("Tonela"));
        $this->tela->setDescripcion_tela(ucwords("Suavecita"));
        $this->tela->setUnidad_med_tela(ucwords("mts"));
        $this->tela->setTipo_tela(ucwords("Algodón"));
    }


    public function testGetAllTela()
    {
        $result = $this->tela->getAll();
        $row = array_values($result);
        $row = $row[0];
        $this->assertIsString($row->nombre_tela);
        $this->assertIsString($row->descripcion_tela);
        $this->assertIsString($row->unidad_med_tela);
        $this->assertIsString($row->tipo_tela);
    }

    public function testSave(){
        $result=$this->tela->save();
        $this->assertIsBool($result);
    }

    public function testGetById(){
        $result = $this->tela->getById();
        $this->assertIsObject($result);
    }

    public function testSearchName(){
        $result = $this->tela->search('Tonela');
        $this->assertIsObject($result);
    }

    public function testUpdate(){
        $result = $this->tela->update();
        $this->assertIsBool($result);
    }


    public function testDelete(){
        $result = $this->tela->delete();
        $this->assertIsObject($result);
    }

}