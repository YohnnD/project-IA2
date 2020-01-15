<?php

// namespace App\Model;
use PHPUnit\Framework\TestCase;
require 'core/BaseModel.php';
require 'app/models/Usuario.php';
require 'config/actions.php';
require 'config/modules.php';
$_SESSION['nick_usuario']='angelito';

class UsuarioTest extends TestCase{
    protected $usuario;

    public function SetUp():void {
    	$this->usuario = new Usuario();
    	$this->usuario->setNickUsuario('JhonB');
    	$this->usuario->setNombreUsuario('Jhon');
    	$this->usuario->setApellidoUsuario('Morán');
    	$this->usuario->setEmailUsuario('jhonbeiker.ma26@gmail.com');
    	$this->usuario->setContraseniaEncriptada('1234');
    	$this->usuario->setIdRol(1);
    }

    public function testGetAllUsuarios() {
        $result = $this->usuario->getAll();
        $this->assertIsArray($result);
    }

    public function testSave() {
    	$result = $this->usuario->save();
        $this->assertIsBool($result);
    }

    public function testUpdate(){
        $result = $this->usuario->update();
        $this->assertIsBool($result);
    }

    public function testDelete(){
        $result = $this->usuario->delete();
        $this->assertIsBool($result);
    }

    public function testGetOne(){
        $result = $this->usuario->getOne('angelito');
        $this->assertIsObject($result);
    }

    // public function testLogin() {
    // 	$this->usuario->setNickUsuario('angelito');
    // 	$result = $this->usuario->login();
    //     $this->assertIsObject($result);
    // }

    public function testCheckNickUsuario() {
    	$result = $this->usuario->checkNickUsuario();
        $this->assertIsBool($result);
    }

    public function testCheckEmailUsuario() {
    	$result = $this->usuario->checkEmailUsuario();
        $this->assertIsBool($result);
    }

    public function testGetBitacora() {
        $result = $this->usuario->getBitacora();
        $this->assertIsArray($result);
    }

}