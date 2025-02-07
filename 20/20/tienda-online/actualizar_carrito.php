<?php

// Inicio la sesión para tener acceso a las variables de sesión, en este caso el carrito
session_start();

// Verifico si el formulario fue enviado mediante el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Incluyo el archivo de funciones para poder utilizar la función 'actualizarProducto'
    require 'funciones.php';

    // Obtengo el ID del producto y la cantidad desde el formulario enviado
    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    // Verifico si la cantidad es un valor numérico válido
    if (is_numeric($cantidad)) {

        // Verifico si el producto ya existe en el carrito (utilizo el ID como clave)
        if (array_key_exists($id, $_SESSION['carrito'])) {
            // Si el producto existe, llamo a la función 'actualizarProducto' para actualizar su cantidad
            actualizarProducto($id, $cantidad);
        }
    }

    // Después de actualizar, redirijo al usuario de vuelta a la página del carrito para mostrar los cambios
    header('Location: carrito.php');
}
