
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mi Tienda</title>

    <link rel="stylesheet" href="../assets/css/estilos.css">
  </head>

  <body>

    <nav>
      <ul>
           <li>
               <a href="../index.php">Salir de admin</a>
           </li>
      </ul>
    </nav>

    <div class="container_formulario" id="main">
        <div class="main-login">
            <form action="login.php" method="post">
                <h3>ACCESOS AL PANEL</h3>
                <p>
                    <img src="../assets/imagenes/logo.png" alt="">
                </p>
                <div>
                    <label>Usuario</label>
                    <input type="text" name="nombre_usuario" placeholder="Usuario" required>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="clave" placeholder="Password" required>
                </div>
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>



  </body>
</html>