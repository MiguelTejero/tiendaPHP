<?php

namespace Kawschool;

class Pedido{

    // Declaro las propiedades privadas de la clase
    private $config;
    private $cn = null;

    // El constructor se ejecuta cuando se crea una nueva instancia de la clase
    public function __construct(){

        // Cargo la configuración desde el archivo config.ini
        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        // Establezco la conexión con la base de datos usando PDO y los datos de configuración
        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // Aseguro que la conexión use UTF-8
        ));

    }

    // Función para registrar un nuevo pedido en la base de datos
    public function registrar($_params){
        // Preparo la consulta SQL para insertar un nuevo pedido
        $sql = "INSERT INTO `pedidos`(`cliente_id`, `total`, `fecha`) 
        VALUES (:cliente_id,:total,:fecha)";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Asigno los parámetros de la consulta con los valores que recibo
        $_array = array(
            ":cliente_id" => $_params['cliente_id'],
            ":total" => $_params['total'],
            ":fecha" => $_params['fecha'],
        );

        // Si la consulta se ejecuta correctamente, devuelvo el ID del nuevo pedido
        if($resultado->execute($_array))
            return $this->cn->lastInsertId();

        // Si algo sale mal, devuelvo false
        return false;
    }

    // Función para registrar los detalles de un pedido (los productos)
    public function registrarDetalle($_params){
        // Preparo la consulta SQL para insertar un nuevo detalle de pedido
        $sql = "INSERT INTO `detalle_pedidos`(`pedido_id`, `producto_id`, `precio`, `cantidad`) 
        VALUES (:pedido_id,:producto_id,:precio,:cantidad)";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Asigno los parámetros de la consulta con los valores que recibo
        $_array = array(
            ":pedido_id" => $_params['pedido_id'],
            ":producto_id" => $_params['producto_id'],
            ":precio" => $_params['precio'],
            ":cantidad" => $_params['cantidad'],
        );

        // Si la consulta se ejecuta correctamente, devuelvo true indicando que el detalle fue registrado
        if($resultado->execute($_array))
            return true;

        // Si algo sale mal, devuelvo false
        return false;
    }

    // Función para mostrar todos los pedidos
    public function mostrar()
    {
        // Preparo la consulta SQL para obtener todos los pedidos con la información del cliente
        $sql = "SELECT p.id, nombre, apellidos, email, total, fecha FROM pedidos p 
        INNER JOIN clientes c ON p.cliente_id = c.id ORDER BY p.id DESC";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Si la consulta se ejecuta correctamente, devuelvo todos los pedidos
        if($resultado->execute())
            return $resultado->fetchAll();

        // Si algo sale mal, devuelvo false
        return false;
    }

    // Función para mostrar los últimos 10 pedidos
    public function mostrarUltimos()
    {
        // Preparo la consulta SQL para obtener los últimos 10 pedidos con la información del cliente
        $sql = "SELECT p.id, nombre, apellidos, email, total, fecha FROM pedidos p 
        INNER JOIN clientes c ON p.cliente_id = c.id ORDER BY p.id DESC LIMIT 10";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Si la consulta se ejecuta correctamente, devuelvo los últimos 10 pedidos
        if($resultado->execute())
            return $resultado->fetchAll();

        // Si algo sale mal, devuelvo false
        return false;
    }

    // Función para mostrar un pedido específico por su ID
    public function mostrarPorId($id)
    {
        // Preparo la consulta SQL para obtener un pedido por su ID con la información del cliente
        $sql = "SELECT p.id, nombre, apellidos, email, total, fecha FROM pedidos p 
        INNER JOIN clientes c ON p.cliente_id = c.id WHERE p.id = :id";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Asigno el ID del pedido que quiero mostrar
        $_array = array(
            ':id' => $id
        );

        // Si la consulta se ejecuta correctamente, devuelvo el pedido encontrado
        if($resultado->execute($_array))
            return $resultado->fetch();

        // Si algo sale mal, devuelvo false
        return false;
    }

    // Función para mostrar los detalles de un pedido específico por su ID
    public function mostrarDetallePorIdPedido($id)
    {
        // Preparo la consulta SQL para obtener los detalles de un pedido específico
        $sql = "SELECT 
                dp.id,
                pe.titulo,
                dp.precio,
                dp.cantidad,
                pe.foto
                FROM detalle_pedidos dp
                INNER JOIN productos pe ON pe.id = dp.producto_id
                WHERE dp.pedido_id = :id";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Asigno el ID del pedido que quiero obtener los detalles
        $_array = array(
            ':id' => $id
        );

        // Si la consulta se ejecuta correctamente, devuelvo los detalles del pedido
        if($resultado->execute($_array))
            return $resultado->fetchAll();

        // Si algo sale mal, devuelvo false
        return false;
    }
}
