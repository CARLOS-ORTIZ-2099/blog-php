<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // conexion a la base de datos
  require_once 'includes/conexion.php';


  // recoger los valores del formulario de actualizacion


  $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;

  $apellidos = isset($_POST['apellidos']) ?  mysqli_real_escape_string($db, $_POST['apellidos']) : false;


  $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;




  // array que almacenara los errores para cada campo
  $errores = [];


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


  if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_validado = true;
  } else {
    $email_validado = false;
    $errores['email'] = "el email no es valido";
  }



  $guardar_usuario = false;

  if (count($errores) == 0) {
    $usuario = $_SESSION['usuario'];
    $guardar_usuario = true;

    // comprobar si el email ya existe 
    $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
    $isset_email = mysqli_query($db, $sql);
    $isset_user = mysqli_fetch_assoc($isset_email);

    echo "<pre/>";
    var_export($isset_user);
    echo "<pre/>";
    // aqui comrpobamos si el id que devuelve la query es igual al usuario autenticado o si esta vacio si es se cumple quiere decir que el usuario
    // esta inetentando editar su cuenta con el mismo correo o que el correo
    // que inserto no esta en la bd
    if ($isset_user['id'] == $usuario['id'] || empty($isset_user)) {
      // actualizar usuario en la tabla usuarios de la bbdd
      $usuario = $_SESSION['usuario'];
      $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', email = '$email' WHERE id =" . $usuario['id'];
      $guardar = mysqli_query($db, $sql);


      if ($guardar) {
        $_SESSION['usuario']['nombre'] = $nombre;
        $_SESSION['usuario']['apellidos'] = $apellidos;
        $_SESSION['usuario']['email'] = $email;
        $_SESSION['completado'] = "tus datos se han actualizado con exito";
      } else {
        $_SESSION['errores']['general'] = "fallo al actualizar tus datos";
      }
    } else {
      $_SESSION['errores']['general'] = "el usuario ya existe";
    }
  } else {
    $_SESSION['errores'] = $errores;
  }
}

header("Location: mis-datos.php");
