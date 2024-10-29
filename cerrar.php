<?php

// iniciando session
session_start();

// aqui decimos si existe una session del usuario lo eliminamos
if (isset($_SESSION['usuario'])) {
  session_destroy();
}

header("Location: index.php");
