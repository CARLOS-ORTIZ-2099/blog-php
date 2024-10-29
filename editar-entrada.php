<?php require_once 'includes/redireccion.php' ?>;
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<?php
$entrada_actual = conseguirEntrada($db, $_GET['id']);
if (!isset($entrada_actual['id'])) {
  header("Location: index.php");
}

?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>



<div id="principal">

  <h1>editar entrada</h1>

  <p>
    edita tu entrada ahora <?= $entrada_actual['titulo'] ?>
  </p>
  <br />

  <form action="guardar-entrada.php?editar=<?= $entrada_actual['id'] ?>" method="POST">

    <label for="titulo">titulo</label>
    <input type="text" name="titulo" value="<?= $entrada_actual['titulo'] ?>">
    <!-- mostrar los errores que sucedan en este campo  -->
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : '';  ?>



    <label for="descripcion">descripcion</label>
    <textarea name="descripcion"><?= $entrada_actual['descripcion'] ?></textarea>
    <!-- mostrar los errores que sucedan en este campo  -->
    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : '';  ?>


    <label for="categoria">categoria</label>
    <select name="categoria">

      <?php
      $categorias = conseguirCategorias($db);
      if (!empty($categorias)) :
        while ($categoria  = mysqli_fetch_assoc($categorias)):
      ?>

          <option value="<?= $categoria['id'] ?>"
            <?= ($categoria['id'] == $entrada_actual['categoria_id'])
              ? 'selected="selected"' : "" ?>>
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


<?php require_once 'includes/pie.php' ?>