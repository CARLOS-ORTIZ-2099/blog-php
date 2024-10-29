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



<!-- caja principal -->
<div id="principal">

  <?= var_export($entrada_actual); ?>


  <h1> <?= $entrada_actual['titulo'] ?></h1>

  <a href="categoria.php?id=<?= $entrada_actual['categoria_id'] ?>">
    <h2> <?= $entrada_actual['categoria'] ?></h2>
  </a>

  <h4> <?= $entrada_actual['fecha'] ?> | <?= $entrada_actual['usuario'] ?> </h4>
  <p> <?= $entrada_actual['descripcion'] ?></p>

  <!-- aqui solo mostraremos los botones de editar y eliminar cuando el
       el usuario este autenticado y sea dueño de dicha publicacion 
  -->
  <?php if (
    isset($_SESSION['usuario'])
    && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']
  ) : ?>


    <a class="boton boton-verde" href="editar-entrada.php?id=<?= $entrada_actual['id'] ?>">editar entrada</a>
    <a class="boton" href="borrar-entrada.php?id=<?= $entrada_actual['id'] ?>">eliminar entrada</a>

  <?php endif; ?>



</div>


<!-- pie de pagina -->
<?php require_once 'includes/pie.php' ?>