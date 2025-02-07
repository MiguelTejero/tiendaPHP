<?php
session_start();
require 'funciones.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mi Tienda</title>

    <link rel="stylesheet" href="assets/css/estilos.css">
  </head>

  <body>

  <nav>
      <ul>
          <li>
              <a href="index.php">Mi Tienda</a>
          </li>
          <li>
              <a href="panel/index.php">Login</a>
          </li>
          <li>
              <a href="carrito.php">CARRITO <span class="badge"><?php print cantidadProducto(); ?></span></a>
          </li>
      </ul>
  </nav>

  <div class="finalizando">
      <div class="formulario">
          <div class="fila">
              <div class="columna">
                      <form action="completar_pedido.php" method="post">
                          <div class="campo">
                              <label>Nombre</label>
                              <input type="text" name="nombre" required>
                          </div>
                          <div class="campo">
                              <label>Apellidos</label>
                              <input type="text" name="apellidos" required>
                          </div>
                          <div class="campo">
                              <label>Correo</label>
                              <input type="email" name="email" required>
                          </div>
                          <div class="campo">
                              <label>Teléfono</label>
                              <input type="text" name="telefono" required>
                          </div>
                          <div class="campo">
                              <label>Comentario</label>
                              <textarea name="comentario" rows="4"></textarea>
                          </div>
                          <button type="submit" class="boton-enviar">Enviar</button>
                      </form>
              </div>
          </div>
      </div>
  </div>




  </body>
</html>
