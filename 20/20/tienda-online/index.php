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

    <!-- Fixed navbar -->
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

    <div class="container" id="main">
        <div class="product">
            <?php
            require 'vendor/autoload.php';
            $producto = new Kawschool\Producto;
            $info_productos = $producto->mostrar();
            $cantidad = count($info_productos);
            if($cantidad > 0){
                for($x =0; $x < $cantidad; $x++){
                    $item = $info_productos[$x];
                    ?>
                    <div class="product-item">
                        <h1><?php print $item['titulo'] ?></h1>
                        <div>
                            <?php
                            $foto = 'upload/'.$item['foto'];
                            if(file_exists($foto)){
                                ?>
                                <img src="<?php print $foto; ?>">
                            <?php }else{?>
                                <img src="assets/imagenes/not-found.jpg">
                            <?php }?>
                        </div>
                        <a href="carrito.php?id=<?php print $item['id'] ?>">
                            Comprar
                        </a>
                    </div>
                    <?php
                }
            }else{?>
                <h4>NO HAY REGISTROS</h4>
            <?php }?>
        </div>
    </div>



  </body>
</html>
