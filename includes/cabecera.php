<?php require_once 'conexion.php';  ?>
<?php
require_once 'includes/helpers.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog de Videojuegos</title>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

  <!-- cabezera -->
  <header id="cabezera">
    <!-- logo -->
    <div id="logo">
      <a href="index.php">
        blog de videojuegos
      </a>
    </div>

    <!-- menu -->
    <nav id="menu">
      <ul>

        <li>
          <a href="index.php">inicio</a>
        </li>

        <?php
        /* aqui la funcion retornara lo que devuelva la db o un array vacio */
        $categorias = conseguirCategorias($db);
        if (!empty($categorias)) :
          /* en caso la db devuelva algo aqui sanitizamos el resultado para convertirlo en array asociativo y recorrelo, si no devuelve nada el
        bucle no se ejecutara 
        */
          while ($categoria = mysqli_fetch_assoc($categorias)):
        ?>
            <li>
              <a href="categoria.php?id=<?= $categoria['id'] ?>">
                <?php echo $categoria['nombre'] ?>
              </a>
            </li>

        <?php
          endwhile;
        endif;
        ?>


        <li>
          <a href="index.php">sobre mi</a>
        </li>

        <li>
          <a href="index.php">Contacto</a>
        </li>

      </ul>
    </nav>

    <div class="clearfix"></div>

  </header>

  <div id="contenedor">