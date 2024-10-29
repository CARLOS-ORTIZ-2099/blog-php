<?php
/* helper de redireccion */
require_once 'includes/redireccion.php';
/* encabezado */
require_once 'includes/cabecera.php';
/*  barra lateral  */
require_once 'includes/lateral.php';

?>


<!-- caja principal -->
<div id="principal">

  <h1>crear categorias</h1>

  <p>
    añade mas categorias al blog
  </p>
  <br />

  <form action="guardar-categoria.php" method="POST">
    <label for="nombre">nombre de la categoria</label>
    <input type="text" name="nombre">

    <input type="submit" value="Guardar">

  </form>

</div>


<!-- pie de pagina -->
<?php require_once 'includes/pie.php' ?>