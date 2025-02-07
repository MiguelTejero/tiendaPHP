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
              <div class="pull-right">
                <a href="form_registrar.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo</a>
              </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
             <fieldset>
              <legend>Listado de Productos</legend>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Titulo</th>
                      <th>Categoria</th>
                      <th>Precio</th>
                      <th class="text-center">Foto</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php
                      require '../../vendor/autoload.php';
                      $producto = new Kawschool\Producto;
                      $info_producto = $producto->mostrar();

                    
                      $cantidad = count($info_producto);
                      if($cantidad > 0){
                        $c=0;
                      for($x =0; $x < $cantidad; $x++){
                        $c++;
                        $item = $info_producto[$x];
                    ?>


                    <tr>
                      <td><?php print $c?></td>
                      <td><?php print $item['titulo']?></td>
                      <td><?php print $item['nombre']?></td>
                      <td><?php print $item['precio']?></td>
                      <td class="text-center">
                        <?php
                          $foto = '../../upload/'.$item['foto'];
                          if(file_exists($foto)){
                        ?>
                          <img src="<?php print $foto; ?>" width="50">
                      <?php }else{?>
                          SIN FOTO
                      <?php }?>
                      </td>
                      <td class="text-center">
                        <a href="../acciones.php?id=<?php print $item['id'] ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                        <a href="form_actualizar.php?id=<?php print $item['id']  ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
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
