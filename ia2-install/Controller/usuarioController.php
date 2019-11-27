<?php


require_once ("Model/usuario.php");
$usuario= new Usuario();

$passwordEncriptada=password_hash(1234,PASSWORD_DEFAULT,array("cost"=>12));
$band=$usuario->register('codeslator','Andreés','Meléndez','codeslator@mail.com',$passwordEncriptada,'1');

if($band){
    echo "Usuario Registro con  Exitoso,Ya puedes entrar al sistema,Suerte con la defensa de codigo :)";
}else{
    echo "el Usuario ya esta registrado,Vaya y entre al sistema amiguito";
}


