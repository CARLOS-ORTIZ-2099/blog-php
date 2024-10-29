<?php

require_once 'includes/conexion.php';


// aqui solo se hace la query de eliminacion cuando el usuario ha inciado
// sesion y exista un id en la url de consulta
if (isset($_SESSION['usuario']) && isset($_GET['id'])) {
  $entrada_id = $_GET['id'];
  $usuario_id = $_SESSION['usuario']['id'];

  $sql = "DELETE FROM entradas WHERE usuario_id  = $usuario_id 
  AND id =$entrada_id
  ";

  $result = mysqli_query($db, $sql);
}

header('Location: index.php');
