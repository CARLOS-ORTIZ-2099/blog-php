<?php


// solo inciamos sesion si previamente no esta inciada
if (!isset($_SESSION)) {
  session_start();
}

// si el usuario no ha iniciado session lo mandamos a la pagina principal
if (!isset($_SESSION['usuario'])) {
  header("Location: index.php");
}
