<?php

// iniciar la sesion y la conexiona bd
require_once 'includes/conexion.php';

// recoger datos del formulario

if (isset($_POST)) {

  // si previamente se cacho un error entonces lo borramos
  if (isset($_SESSION['error_login'])) {
    unset($_SESSION['error_login']);
  }

  $email = trim($_POST['email']);
  $password = $_POST['password'];


  // consulta para comprobar las credenciales del usuario
  $sql = "SELECT * FROM usuarios WHERE email = '$email' ";
  $login = mysqli_query($db, $sql);

  // aqui comprobamos que la consulta halla sido exitosa y que solo tenga un resultado 
  if ($login && mysqli_num_rows($login) == 1) {
    // aqui serializamos la respuesta de la db en un array asociativo
    $usuario = mysqli_fetch_assoc($login);

    // comprobar la contraseña 
    $verify = password_verify($password, $usuario['password']);

    // si la verificacion es erronea
    if ($verify) {
      // utilizar una sesion para guardar los datos del usuario logueado
      $_SESSION['usuario'] = $usuario;
    } else {
      // si algo falla enviar una sesion con el fallo
      $_SESSION['error_login'] = "login incorrecto";
    }
  }
  // si la consulta es erronea
  else {
    $_SESSION['error_login'] = "login incorrecto";
  }
}


// redirigir
header('Location: index.php');
