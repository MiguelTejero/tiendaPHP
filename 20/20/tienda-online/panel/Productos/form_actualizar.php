<?php
session_start();

if(!isset($_SESSION['usuario_info']) or empty($_SESSION['usuario_info']))
    header('Location: ../index.php');


  require '../../vendor/autoload.php';

  if(isset($_GET['id']) && is_numeric($_GET['id'])){
      $id = $_GET['id'];
    
      $producto = new Kawschool\Producto;
      $resultado = $producto->mostrarPorId($id);

      if(!$resultado)
          header('Location: index.php');

  }else{
    header('Location: index.php');
  }

  

  
 

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

    <link rel="stylesheet" href="../../assets/css/estilos.css">
  </head>

  <body>

  <nav>
      <ul >
          <li>
              <a href="../index.php">Mi Tienda</a>
          </li>
          <li>
              <a href="../pedidos/index.php" >Pedidos</a>
          </li>
          <li>
              <a href="../productos/index.php" >Productos</a>
          </li>
          <li><a <?php print $_SESSION ['usuario_info']['nombre_usuario'] ?> href="../cerrar_sesion.php">Salir</a>
          </li>
      </ul>
  </nav>

    <div class="container" id="main">
      <div class="row">
        <div class="col-md-12">
          <fieldset>
            <legend>Datos del Producto</legend>
            <form method="POST" action="../acciones.php" enctype="multipart/form-data" >
              <input type="hidden" name="id" value="<?php print $resultado['id'] ?>">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Titulo</label>
                          <input value="<?php print $resultado['titulo'] ?>" type="text" class="form-control" name="titulo" required>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Descripción</label>
                          <textarea class="form-control" name="descripcion" id="" cols="3" required><?php print $resultado['descripcion']?></textarea>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Categorias</label>
                          <select class="form-control" name="categoria_id" required>
                            <option value="">--SELECCIONE--</option>
                            <?php
                             require '../../vendor/autoload.php';
                              $categoria = new Kawschool\Categoria;
                              $info_categoria = $categoria->mostrar();
                              $cantidad = count($info_categoria);
                                for($x =0; $x< $cantidad;$x++){
                                  $item = $info_categoria[$x];
                              ?>
                                <option value="<?php print $item['id'] ?>"
                                 <?php print $resultado['categoria_id']== $item['id'] ?'selected':'' ?>
                                ><?php print $item['nombre'] ?></option>
                              <?php

                                }
                              ?>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Foto</label>
                          <input type="file" class="form-control" name="foto">
                          <input type="hidden" name="foto_temp" value="<?php print $resultado['foto']?>">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Precio</label>
                          <input value="<?php print $resultado['precio']?>" type="text" class="form-control" name="precio" placeholder="0.00" required>
                      </div>
                  </div>
              </div>
              <input type="submit" class="btn btn-primary" name="accion" value="Actualizar">
              <a href="index.php" class="btn btn-default">Cancelar</a>
            </form>
          </fieldset>
        
        </div>
      </div>

    </div>


  </body>
</html>
