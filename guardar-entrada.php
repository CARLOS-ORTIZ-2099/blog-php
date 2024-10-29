<?php

/* esta pagina nos servira para editar y/o crear entrada, esto dependera 
   de si esta pagina reciba o no un parametro query, si lo recibe estamos
   en modo edicion, si no lo recibe estamos en modo creacion
*/
if (isset($_POST)) {
  require_once 'includes/conexion.php';

  $titulo = isset($_POST['titulo'])
    ? mysqli_real_escape_string($db, $_POST['titulo']) : false;

  $descripcion = isset($_POST['descripcion'])
    ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;

  $categoria = isset($_POST['categoria'])
    ? (int)$_POST['categoria'] : false;


  // capturando la informacion del usuario autenticado
  $usuario = $_SESSION['usuario']['id'];

  // validacion

  $errores = [];

  if (empty($titulo)) {
    $errores['titulo'] = "el titulo no es valido";
  }

  if (empty($descripcion)) {
    $errores['descripcion'] = "la descripcion no es valida";
  }

  if (empty($categoria) && !is_numeric($categoria)) {
    $errores['categoria'] = "la categoria no es valida";
  }

  // comprobamos que no hallan errores

  if (count($errores) == 0) {

    if (isset($_GET['editar'])) {

      $entrada_id = $_GET['editar'];

      $usuario_id = $_SESSION['usuario']['id'];

      $sql = "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categoria_id=$categoria
      WHERE id = $entrada_id AND usuario_id = $usuario_id";
    } else {
      $sql = "INSERT INTO entradas VALUES(null, $usuario, $categoria, '$titulo',  '$descripcion', CURDATE()) ; ";
    }

    // query a realizar
    $guardar =  mysqli_query($db, $sql);
    header('Location: index.php');
  } else {

    $_SESSION['errores_entrada'] = $errores;

    if (isset($_GET['editar'])) {
      header("Location: editar-entrada.php?id=$_GET[editar]");
    } else {
      header("Location: crear-entradas.php");
    }
  }
}
