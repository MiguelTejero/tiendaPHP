<?php

// Inicio la sesión para acceder a las variables de sesión
session_start();

// Verifico si el formulario ha sido enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Requiere los archivos necesarios para el proceso
    require 'funciones.php';
    require 'vendor/autoload.php';

    // Verifico si el carrito tiene productos y no está vacío
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        // Creo una nueva instancia de la clase Cliente
        $cliente = new Kawschool\Cliente;

        // Preparo los parámetros que voy a enviar para registrar al cliente
        $_params = array(
            'nombre' => $_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'email' => $_POST['email'],
            'telefono' => $_POST['telefono'],
            'comentario' => $_POST['comentario']
        );

        // Registro al cliente y obtengo su ID
        $cliente_id = $cliente->registrar($_params);

        // Creo una nueva instancia de la clase Pedido
        $pedido = new Kawschool\Pedido;

        // Preparo los parámetros para registrar el pedido con el total y la fecha actual
        $_params = array(
            'cliente_id' => $cliente_id,
            'total' => calcularTotal(), // Calculo el total del carrito
            'fecha' => date('Y-m-d') // Fecha actual
        );

        // Registro el pedido y obtengo el ID del pedido registrado
        $pedido_id = $pedido->registrar($_params);

        // Ahora recorro los productos del carrito para registrar los detalles del pedido
        foreach ($_SESSION['carrito'] as $indice => $value) {
            // Preparo los parámetros para registrar cada producto dentro del pedido
            $_params = array(
                "pedido_id" => $pedido_id,
                "pelicula_id" => $value['id'], // ID de la película (producto)
                "precio" => $value['precio'], // Precio del producto
                "cantidad" => $value['cantidad'], // Cantidad del producto
            );

            // Registro los detalles del pedido
            $pedido->registrarDetalle($_params);
        }

        // Vacío el carrito de la sesión, ya que el pedido ha sido realizado
        $_SESSION['carrito'] = array();

        // Redirijo a la página de agradecimiento después de realizar el pedido
        header('Location: gracias.php');
    }
}
