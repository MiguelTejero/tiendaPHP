<?php
session_start();

if(!isset($_SESSION['usuario_info']) or empty($_SESSION['usuario_info']))
    header('Location: ../index.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
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
              <legend>Listado de Pedidos</legend>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Cliente</th>
                      <th>N° Pedido</th>
                      <th>Total</th>
                      <th>Fecha</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php
                      require '../../vendor/autoload.php';
                      $pedido = new Kawschool\Pedido;
                      $info_pedido = $pedido->mostrar();

                    
                      $cantidad = count($info_pedido);
                      if($cantidad > 0){
                        $c=0;
                      for($x =0; $x < $cantidad; $x++){
                        $c++;
                        $item = $info_pedido[$x];
                    ?>


                    <tr>
                      <td><?php print $c?></td>
                      <td><?php print $item['nombre'].' '.$item['apellidos']?></td>
                      <td><?php print $item['id']?></td>
                      <td><?php print $item['total']?> PEN</td>
                      <td><?php print $item['fecha']?></td>
                       
                      <td class="text-center">
                        <a href="ver.php?id=<?php print $item['id'] ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>
                        
                      </td>
                    
                    </tr>

                    <?php
                      }
                    }else{

                    ?>
                    <tr>
                      <td colspan="6">NO HAY REGISTROS</td>
                    </tr>

                    <?php }?>
                  
                  
                  </tbody>

                </table>
             </fieldset>
          </div>
        </div>


    </div>

  </body>
</html>
