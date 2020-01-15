<?php

use PHPUnit\Framework\TestCase;

require 'core/BaseModel.php';
require 'app/models/Servicio.php';
require 'config/actions.php';
require 'config/modules.php';
$_SESSION['nick_usuario'] = 'Jhon';


class ServicioTest extends TestCase
{

    protected $servicio;

    public function SetUp(): void
    {
        $this->servicio = new Servicio();

        $this->servicio->setIdServicio(3);
        $this->servicio->setNombreServicio('Bordado');
        $this->servicio->setDescripcion('Bordado rumano');
        $this->servicio->setUnidadMedida('CM');
        $this->servicio->setCosto(4);
        $this->servicio->setPrecio(6);
    }


    public function testSave()
    {
        $result = $this->servicio->save();
        $this->assertIsBool($result);
    }

    public function testGetAllServicios()
    {
        $result = $this->servicio->getAll();
        $row = array_values($result);
        $row = $row[0];
        $this->assertIsString($row['nombre_servicio']);
        $this->assertIsString($row['descripcion_servicio']);
        $this->assertIsString($row['unidad_medida']);
        $this->assertIsNumeric($row['precio_servicio']);
        $this->assertIsNumeric($row['costo_servicio']);
    }

    public function testGetBy()
    {
        $result = $this->servicio->getOne(21);
        $this->assertIsArray($result);
    }


    public function testUpdate()
    {
        $result = $this->servicio->update();
        $this->assertIsBool($result);
    }

    public function testGetMateriales()
    {
        $result = $this->servicio->getMaterial();
        $this->assertIsArray($result);
    }

    public function testVerificarServicio()
    {
        $result = $this->servicio->verificarServicio();
        $this->assertIsBool($result);
    }

    public function testSaveMaterial()
    {
        $result = $this->servicio->saveMaterial(3, 10);
        $this->assertIsBool($result);
    }


    public function testSearchMaterial()
    {
        $result = $this->servicio->searchMaterial(1);
        $this->assertIsArray($result);
    }

    public function testGetMaterialByServi()
    {
        $result = $this->servicio->getMaterialByServi(2);
        $this->assertIsArray($result);
    }

    public function testDelete()
    {
        $result = $this->servicio->delete();
        $this->assertIsObject($result);
    }


}

