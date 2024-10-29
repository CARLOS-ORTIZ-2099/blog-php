
<?php

// esta funcion recibira un arreglo asociativo y un valor textual que haga referencia a una clave en especifico
function mostrarError($errores, $campo)
{
  $alerta = '';
  // comprobando que la clave exista y que el texto que nos manan no este vacio
  if (isset($errores[$campo])  && !empty($campo)) {
    $alerta = "<div class = 'alerta alerta-error'>" . $errores[$campo] . "</div>";
  }

  return $alerta;
}


// esta funcion se va ejecutar siempre cuando mandemos los datos del formulario
function borrarErrores()
{

  // session_unset es una variante de unset, ambas borran elementos de un arreglo y sea indexado o asociativo, pero para estos caso se recomienda su variante session_unset ya que se trata de un arreglo de sesion
  // $borrado = session_unset();

  // si exiten los errores entonces lo eliminamos del arreglo de sesion
  if (isset($_SESSION['errores'])) {
    $_SESSION['errores'] = null;
    $borrado = true;
  }

  if (isset($_SESSION['errores_entrada'])) {
    $_SESSION['errores_entrada'] = null;
  }


  // si exista algun valor satisfactorio en la sesion entonces tambien lo borramos
  if (isset($_SESSION['completado'])) {
    $_SESSION['completado'] = null;
    $borrado = true;
  }
}



function conseguirCategorias($conexion)
{
  $sql = "SELECT * FROM categorias ORDER BY id ASC";
  $categorias = mysqli_query($conexion, $sql);

  $result = [];

  if ($categorias && mysqli_num_rows($categorias) >= 1) {
    $result = $categorias;
  }

  return $result;
}


function conseguirEntrada($conexion, $id)
{
  $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario FROM entradas e 
    INNER JOIN categorias c ON e.categoria_id = c.id
    INNER JOIN usuarios u ON e.usuario_id = u.id
    WHERE e.id = $id
  ";

  $entrada = mysqli_query($conexion, $sql);

  $resultado = array();
  if ($entrada && mysqli_num_rows($entrada) >= 1) {
    $resultado = mysqli_fetch_assoc($entrada);
  }
  return $resultado;
}



function conseguirEntradas(
  $conexion,
  $limit = null,
  $categoria = null,
  $busqueda = null
) {
  // primer forma de crear una query larga
  /*   $sql = "SELECT e.*, c.* FROM entradas e " .
    "INNER JOIN categorias c " .
    "ON e.categoria_id = c.id " .
    "ORDER BY e.id DESC LIMIT 4"; 
  */

  // segunda forma de crear una query larga
  $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e 
          INNER JOIN categorias c
          ON e.categoria_id = c.id ";


  // aqui evaluamos si el parametro opcional de categoria viene
  if (!empty($categoria)) {
    $sql .= "WHERE e.categoria_id = $categoria ";
  }

  if (!empty($busqueda)) {
    $sql .= "WHERE e.titulo LIKE '%$busqueda%'  ";
  }



  $sql .= "ORDER BY e.id DESC ";
  // aqui evaluamos si el parametro opcional del limite viene
  if ($limit) {
    $sql .= "LIMIT 4";
  }

  $entradas = mysqli_query($conexion, $sql);

  $resultado = [];
  if ($entradas && mysqli_num_rows($entradas) >= 1) {
    $resultado = $entradas;
  }

  return $entradas;
}


function conseguirCategoria($conexion, $id)
{
  $sql = "SELECT * FROM categorias WHERE id = $id ;";
  $categorias = mysqli_query($conexion, $sql);

  $resultado = [];

  if ($categorias && mysqli_num_rows($categorias) >= 1) {
    $resultado = mysqli_fetch_assoc($categorias);
  }

  return $resultado;
}
