<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>

<?php
$categoria_actual = conseguirCategoria($db, $_GET['id']);
if (!isset($categoria_actual['id'])) {
  header("Location: index.php");
}

?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>



<!-- caja principal -->
<div id="principal">

  <?= var_export($categoria_actual); ?>


  <h1>entradas de <?= $categoria_actual['nombre'] ?></h1>

  <?php
  $entradas = conseguirEntradas($db, null, $_GET['id']);
  if (!empty($entradas) && mysqli_num_rows($entradas) >= 1) :
    while ($entrada = mysqli_fetch_assoc($entradas)):


  ?>
      <article class="entrada">
        <a href="entrada.php?id=<?= $entrada['id'] ?>">
          <h2><?= $entrada['titulo'] ?></h2>
          <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha'] ?></span>
          <p>
            <?= substr($entrada['descripcion'], 0, 180) . "..."; ?>
          </p>
        </a>
      </article>

    <?php
    endwhile;
  else :
    ?>
    <div class="alerta">
      no hay categorias
    </div>

  <?php endif; ?>

</div>


<!-- pie de pagina -->
<?php require_once 'includes/pie.php' ?>