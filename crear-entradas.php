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

  <h1>crear entradas</h1>

  <p>
    añade mas entradas para que la gente disfrute de ese contenido y pueda nutrirse de informacion.
  </p>
  <br />

  <form action="guardar-entrada.php" method="POST">

    <label for="titulo">titulo</label>
    <input type="text" name="titulo">
    <!-- mostrar los errores que sucedan en este campo  -->
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : '';  ?>



    <label for="descripcion">descripcion</label>
    <textarea name="descripcion" id=""></textarea>
    <!-- mostrar los errores que sucedan en este campo  -->
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : '';  ?>


    <label for="categoria">categoria</label>
    <select name="categoria">

      <?php
      $categorias = conseguirCategorias($db);
      if (!empty($categorias)) :
        while ($categoria  = mysqli_fetch_assoc($categorias)):
      ?>

          <option value="<?= $categoria['id'] ?>">
            <?= $categoria['nombre'] ?>
          </option>

      <?php
        endwhile;
      endif;
      ?>

    </select>
    <!-- mostrar los errores que sucedan en este campo  -->
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : '';  ?>


    <input type="submit" value="Guardar">

  </form>
  <?php borrarErrores(); ?>


</div>


<!-- pie de pagina -->
<?php require_once 'includes/pie.php' ?>