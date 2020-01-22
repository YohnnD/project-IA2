<?php

use PHPUnit\Framework\TestCase;

require 'core/BaseModel.php';
require 'app/models/Factura.php';
require 'config/actions.php';
require 'config/modules.php';

$_SESSION['nick_usuario'] = 'Jhon';


class FacturaTest extends TestCase
{

    protected $factura;

    public function SetUp(): void
    {
        $this->factura = new Factura();
        $this->factura->setCodigoFactura(2);
    }

    public function testGetAll()
    {
        $result = $this->factura->getAll();
        $this->assertIsArray($result);
    }

    public function testGetOne()
    {
        $result = $this->factura->getOne();
        $this->assertIsArray($result);
    }

    public function testAnular()
    {
        $result = $this->factura->anular();
        $this->assertIsBool($result);
    }

}