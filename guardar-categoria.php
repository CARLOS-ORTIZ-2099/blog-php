<?php
if (isset($_POST)) {
  // conexion a la base de datos
  require_once 'includes/conexion.php';

  $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;



  // array que almacenara los errores para cada campo
  $errores = [];


  // validar nombres
  if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
    $nombre_validado = true;
  } else {
    $nombre_validado = false;
    $errores['nombre'] = "el nombre no es valido";
  }

  // verificar si no hay errores

  if (count($errores) == 0) {
    $sql = "INSERT INTO categorias VALUES(NULL, '$nombre') ; ";
    $guardar = mysqli_query($db, $sql);
  }
}

header('Location: index.php');
