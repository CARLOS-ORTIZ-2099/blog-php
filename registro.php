<?php

/* echo "<pre/>";
var_export($_SERVER);
echo "<pre/>"; 
*/


// utilizando la variable global $_SERVER para corroborar 
// si envian datos a esta pagina
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // conexion a la base de datos
  require_once 'includes/conexion.php';

  // iniciar sesion
  if (!isset($_SESSION)) {
    session_start();
  }


  echo "entro";
  echo "<pre/>";
  var_export($_POST);
  echo "<pre/>";


  // recoger los valores del formulario de registro

  // la funcion isset comprueba si una variable existe y si su valor es distinto de null o undefined
  $nombre = isset($_POST['nombre'])
    // con esta funcion evitamos que los caracteres especiales y/o comillas sean interpretados como parte del lenguaje evitando asi errores en la insercion
    ? mysqli_real_escape_string($db, $_POST['nombre']) : false;

  $apellidos = isset($_POST['apellidos'])
    ?  mysqli_real_escape_string($db, $_POST['apellidos']) : false;


  $email = isset($_POST['email'])
    ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;


  $password = isset($_POST['password'])
    ?  mysqli_real_escape_string($db, $_POST['password']) : false;


  // array que almacenara los errores para cada campo
  $errores = [];


  // aqui comprobamos si el nombre no esta vacio Y que el nombre no sea un numero Y que ademas no contenga un numero, si pasamos todas esas validaciones creamos una variable a true
  if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
    $nombre_validado = true;
  } else {
    $nombre_validado = false;
    $errores['nombre'] = "el nombre no es valido";
  }

  if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
    $apellidos_validado = true;
  } else {
    $apellidos_validado = false;
    $errores['apellidos'] = "los apellidos no son valido";
  }

  // comprobando que el campo email no este vacio Y que cumpla con ser un email valido es decir contenga un @, .com, etc
  if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_validado = true;
  } else {
    $email_validado = false;
    $errores['email'] = "el email no es valido";
  }

  if (!empty($password)) {
    $password_validado = true;
  } else {
    $password_validado = false;
    $errores['password'] = "la contraseña no es valida";
  }


  $guardar_usuario = false;

  if (count($errores) == 0) {
    $guardar_usuario = true;

    // insertar usuario en la tabla de usuarios de la bbbdd
    // cifrar contaseña
    // este metoda cifra la contraseña, recibe 3 parametros, la contraseña a hashear, el algoritmo que usara para hashear y un array asociativo que inique cuantas veces iterara para hashear la password
    $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

    // var_export($password_segura);

    // insertar usuario en la tabla usuarios de la bbdd
    $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE() ) ; ";

    $guardar = mysqli_query($db, $sql);

    /*    // checando los posibles errores en la insercion de datos en la db
    var_export(mysqli_error($db));
    // paramos la ejecucion si hay un error 
    die(); 
    */


    // si se guardo correctamente guardamos en la session una propiedad con un mensaje de insercion satisfactoria
    if ($guardar) {
      $_SESSION['completado'] = "el registro se ha completado con exito";
    }
    // si hubo un error al guardar tambien crearemos una propiedad en la session con el mensaje de error
    else {
      $_SESSION['errores']['general'] = "fallo al guardar el usuario";
    }
  } else {
    $_SESSION['errores'] = $errores;
  }
}

header("Location: index.php");
