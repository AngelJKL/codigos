<?php

session_start();

include_once '../yt_colores/conexion.php';

$usuario_login = $_POST['nombre_usuario'];
$contrasena_login = $_POST['contrasena'];

echo'<pre>';
var_dump($usuario_login);
var_dump($contrasena_login);
echo'</pre>';

$sql = 'SELECT * FROM usuarios WHERE nombre = ?';
$sentencia = $pdo->prepare($sql);
$sentencia->execute(array($usuario_login));
$resultado = $sentencia->fetch();

echo'<pre>';
var_dump($resultado);
echo'</pre>';

if(!$resultado){
     //matar la operacion
     echo 'No existe usario';
     die();
}

echo'<pre>';
var_dump($resultado['contrasena']);
echo'</pre>';


if(password_verify($contrasena_login, $resultado['contrasena'] )){
// Las contraseñas son iguales
    $_SESSION['admin'] = $usuario_login;
    header('Location: restringido.php');

}else{
    echo 'No son iguales las contraseñas';
    die();
}
