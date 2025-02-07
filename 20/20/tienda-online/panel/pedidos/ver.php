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
                <?php
                    require '../../vendor/autoload.php';
                    $id = $_GET['id'];
                    $pedido = new Kawschool\Pedido;

                    $info_pedido = $pedido->mostrarPorId($id);

                    $info_detalle_pedido = $pedido->mostrarDetallePorIdPedido($id);

                ?>


                <legend>Información de la Compra</legend>
                <div class="form-group">
                    <label>Nombre</label>
                    <input value="<?php print $info_pedido['nombre'] ?>" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input value="<?php print $info_pedido['apellidos'] ?>" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input value="<?php print $info_pedido['email'] ?>" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Fecha</label>
                    <input value="<?php print $info_pedido['fecha'] ?>" type="text" class="form-control" readonly>
                </div>
               


                <hr>
                    Productos Comprados
                <hr>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Titulo</th>
                      <th>Foto</th>
                      <th>Precio</th>
                      <th>Cantidad</th>
                      <th>
                          Total
                      </th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php
                   
                    
                      $cantidad = count($info_detalle_pedido);
                      if($cantidad > 0){
                        $c=0;
                      for($x =0; $x < $cantidad; $x++){
                        $c++;
                        $item = $info_detalle_pedido[$x];
                        $total = $item['precio'] * $item['cantidad'];
                    ?>


                    <tr>
                      <td><?php print $c?></td>
                      <td><?php print $item['titulo']?></td>
                      <td>
                      <?php
                          $foto = '../../upload/'.$item['foto'];
                          if(file_exists($foto)){
                        ?>
                          <img src="<?php print $foto; ?>" width="35">
                      <?php }else{?>
                          SIN FOTO
                      <?php }?>
                      </td>
                      <td><?php print $item['precio']?> PEN</td>
                      <td><?php print $item['cantidad']?></td>
                    <td>
                    <?php print $total?>
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
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Total Compra</label>
                        <input value="<?php print $info_pedido['total'] ?>" type="text" class="form-control" readonly>
                    </div>
                </div>
                
            </fieldset>
            <div class="pull-left">
                <a href="index.php" class="btn btn-default hidden-print">Cancelar</a>
            </div>

            <div class="pull-right">
                <a href="javascript:;" id="btnImprimir" class="btn btn-danger hidden-print">Imprimir</a>
            </div>

            
             
          </div>
        </div>


    </div>

    <script>
        $('#btnImprimir').on('click',function(){

            window.print();

            return false;

        })
                        
    </script>

  </body>
</html>
