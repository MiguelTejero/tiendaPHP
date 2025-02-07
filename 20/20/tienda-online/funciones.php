<?php

// Función para agregar un producto al carrito
function agregarProducto($resultado, $id, $cantidad = 1) {
    // Aquí guardo los datos del producto en la sesión, utilizando el ID como clave
    $_SESSION['carrito'][$id] = array(
        'id' => $resultado['id'],
        'titulo' => $resultado['titulo'],
        'foto' => $resultado['foto'],
        'precio' => $resultado['precio'],
        'cantidad' => $cantidad
    );
}

// Función para actualizar la cantidad de un producto en el carrito
function actualizarProducto($id, $cantidad = FALSE) {
    // Si recibo una cantidad específica, la actualizo directamente
    if ($cantidad)
        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
    else
        // Si no, simplemente incremento en 1 la cantidad existente
        $_SESSION['carrito'][$id]['cantidad'] += 1;
}

// Función para calcular el total del carrito
function calcularTotal() {
    $total = 0;
    // Verifico si hay productos en el carrito antes de hacer los cálculos
    if (isset($_SESSION['carrito'])) {
        // Recorro cada producto y multiplico su precio por la cantidad
        foreach ($_SESSION['carrito'] as $indice => $value) {
            $total += $value['precio'] * $value['cantidad'];
        }
    }
    // Devuelvo el total calculado
    return $total;
}

// Función para contar la cantidad de productos en el carrito
function cantidadProducto() {
    $cantidad = 0;
    // Verifico si hay productos en el carrito
    if (isset($_SESSION['carrito'])) {
        // Recorro el carrito y cuento cuántos productos hay
        foreach ($_SESSION['carrito'] as $indice => $value) {
            $cantidad++;
        }
    }
    // Devuelvo la cantidad total de productos en el carrito
    return $cantidad;
}
