<!-- BARRA LATERAL -->
<aside id="sidebar">


  <div id="buscador" class="bloque">
    <h3>buscar</h3>

    <?php if (isset($_SESSION['error_login'])):; ?>
      <div class="alerta alerta-error">
        <?php echo $_SESSION['error_login']; ?>
      </div>
    <?php endif; ?>


    <form action="buscar.php" method="POST">

      <input type="text" name="busqueda" />
      <input type="submit" value="Buscar" />
    </form>
  </div>


  <?php if (isset($_SESSION['usuario'])):; ?>

    <div id="usuario-logueado" class="bloque">

      <h3>bienvenido, <?php echo $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos'];  ?>
      </h3>

      <!-- botones -->
      <a class="boton boton-verde" href="crear-entradas.php">crear entradas</a>
      <a class="boton" href="crear-categoria.php">crear categoria</a>
      <a class="boton boton-naranja" href="mis-datos.php">mis datos</a>
      <a class="boton boton-rojo" href="cerrar.php">cerrar sesion</a>

    </div>

  <?php endif; ?>



  <?php if (!isset($_SESSION['usuario'])):; ?>


    <div id="login" class="bloque">
      <h3>Identificate</h3>

      <?php if (isset($_SESSION['error_login'])):; ?>
        <div class="alerta alerta-error">
          <?php echo $_SESSION['error_login']; ?>
        </div>
      <?php endif; ?>


      <form action="login.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" />

        <label for="password">Contraseña</label>
        <input type="password" name="password" />

        <input type="submit" value="Entrar" />
      </form>
    </div>




    <div id="register" class="bloque">

      <!-- lateral hereda la conexion que se creo en cabecera.php 
         por que esta en su mismo contexto
    -->


      <h3>Resgistrate</h3>
      <!-- evaluamos si la session tiene un resultado de exito o de error  -->
      <?php if (isset($_SESSION['completado'])): ?>
        <div class="alerta alerta-exito">
          <?php echo $_SESSION['completado']; ?>
        </div>

      <?php elseif (isset($_SESSION['errores']['general'])) : ?>
        <div class="alerta alerta-error">
          <?php echo  $_SESSION['errores']['general'];   ?>
        </div>

      <?php endif; ?>



      <form action="registro.php" method="POST">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" />
        <!-- aqui accedemos al arreglo de errores que creamos en la sesion actual, recordemos que la session se hereda gracias a cabecera.php
       primero comprobamos que exista el error
        -->
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '';  ?>




        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" />

        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '';  ?>



        <label for="email">Email</label>
        <input type="email" name="email" />

        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : '';  ?>




        <label for="password">Contraseña</label>
        <input type="password" name="password" />

        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : '';  ?>




        <input type="submit" name="submit" value="Registrar" />
      </form>

      <?php borrarErrores(); ?>

    </div>
  <?php endif; ?>



</aside>