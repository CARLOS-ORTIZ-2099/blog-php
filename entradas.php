<?php
/* encabezado */
require_once 'includes/cabecera.php';

?>

<!-- barra lateral -->
<!-- recordemos que el archivo cabecera.php ya tiene la conexion por tanto
      todas las variables, y las conexion misma ya se hereda y la comparte
      para todos los demas archivos que esten en su mismo contexto .
-->
<?php require_once 'includes/lateral.php'; ?>



<!-- caja principal -->
<div id="principal">

  <h1>todas las entradas</h1>

  <?php
  $entradas = conseguirEntradas($db);
  if (!empty($entradas)) :
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
  endif;
  ?>

</div>


<!-- pie de pagina -->
<?php require_once 'includes/pie.php' ?>