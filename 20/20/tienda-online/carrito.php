<?php
//ACTIVAR LAS SESSIONES EN PHP
session_start();
require 'funciones.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = $_GET['id'];
    require 'vendor/autoload.php';
    $producto = new Kawschool\Producto;
    $resultado = $producto->mostrarPorId($id);
    
    if(!$resultado)
       header('Location: index.php');

       

    if(isset($_SESSION['carrito'])){ //SI EL CARRITO EXISTE
        //SI EL Producto EXISTE EN EL CARRITO
        if(array_key_exists($id,$_SESSION['carrito'])){
            actualizarProducto($id);
        }else{
            //  SI EL CARRITO NO EXISTE EN EL CARRITO
            agregarProducto($resultado, $id);
        }

    }else{
        //  SI EL CARRITO NO EXISTE
        agregarProducto($resultado, $id);

    }

   

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

    <link rel="stylesheet" href="assets/css/estilos.css">
  </head>

  <body>

    <nav>
        <ul>
            <li>
                <a href="index.php">Mi Tienda</a>
            </li>
            <li>
                <a href="carrito.php">CARRITO <span class="badge"><?php print cantidadProducto(); ?></span></a>
            </li>
        </ul>
    </nav>

    <div class="main">
            <table>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Producto</th>
                      <th>Foto</th>
                      <th>Precio</th>
                      <th>Cantidad</th>
                      <th>Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
                            $c=0;
                            foreach($_SESSION['carrito'] as $indice => $value){
                                $c++;
                                $total = $value['precio'] * $value['cantidad'];
                      ?>
                        <tr>
                            <form action="actualizar_carrito.php" method="post">
                                <td><?php print $c ?></td>
                                <td><?php print $value['titulo']  ?></td>
                                <td>
                                    <?php
                                        $foto = 'upload/'.$value['foto'];
                                        if(file_exists($foto)){
                                        ?>
                                        <img src="<?php print $foto; ?>" width="35">
                                    <?php }else{?>
                                        <img src="assets/imagenes/not-found.jpg" width="35">
                                    <?php }?>
                                </td>
                                <td><?php print $value['precio']  ?> €</td>
                                <td>
                                <input type="hidden" name="id"  value="<?php print $value['id'] ?>">
                                    <input type="text" name="cantidad" class="form-control u-size-100" value="<?php print $value['cantidad'] ?>">
                                </td>
                                <td>
                                    <?php print $total  ?> €
                                </td>
                                <td>
                                    <a href="eliminar_carrito.php?id=<?php print $value['id']  ?>" class="btn btn-danger btn-xs">Eliminar
                                        <span class="glyphicon glyphicon-trash"></span> 
                                    </a>


                                </td>
                            </form>
                        </tr>

                    <?php
                        }
                        }else{
                    ?>
                        <tr>
                            <td colspan="7">NO HAY PRODUCTOS EN EL CARRITO</td>

                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                        <tr>
                            <td colspan="5" class="text-right">Total</td>
                            <td><?php print calcularTotal(); ?> €</td>
                            <td></td>
                        </tr>

                </tfoot>
            </table>
            <hr>
            <?php
                if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
            ?>  
            <div class="finalizar">
                    <div class="">
                        <a href="index.php" class="btn btn-info">Seguir Comprando</a>
                    </div>
                    <div class="">
                        <a href="finalizar.php" class="btn btn-success">Finalizar Compra</a>
                    </div>
            </div>

            <?php
                }
            ?>

    </div>



  </body>
</html>
