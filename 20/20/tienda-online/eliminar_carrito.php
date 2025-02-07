<?php
// Inicio la sesión para poder acceder a las variables de sesión
session_start();

// Verifico si el parámetro 'id' está presente en la URL y si es un número válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Si el 'id' no es válido, redirijo al carrito para evitar errores
    header('Location: carrito.php');
    exit();
}

// Guardo el ID del producto que quiero eliminar
$id = $_GET['id'];

// Verifico si el carrito existe en la sesión
if (isset($_SESSION['carrito'])) {
    // Si el producto está en el carrito, lo elimino con unset()
    unset($_SESSION['carrito'][$id]);
    // Luego redirijo nuevamente al carrito para reflejar los cambios
    header('Location: carrito.php');
    exit();
} else {
    // Si no hay carrito activo, redirijo al usuario a la página principal
    header('Location: index.php');
    exit();
}

