<?php

namespace Kawschool;

class Producto{

    // Declaro las propiedades privadas de la clase
    private $config;
    private $cn = null;

    // El constructor se ejecuta cuando se crea una nueva instancia de la clase
    public function __construct(){
        // Cargo la configuración desde el archivo config.ini
        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        // Establezco la conexión con la base de datos usando PDO y los datos de configuración
        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // Aseguro que la conexión use UTF-8
        ));
    }

    // Función para registrar un nuevo producto en la base de datos
    public function registrar($_params){
        // Preparo la consulta SQL para insertar un nuevo producto
        $sql = "INSERT INTO `productos`(`titulo`, `descripcion`, `foto`, `precio`, `categoria_id`, `fecha`) 
        VALUES (:titulo,:descripcion,:foto,:precio,:categoria_id,:fecha)";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Asigno los parámetros de la consulta con los valores que recibo
        $_array = array(
            ":titulo" => $_params['titulo'],
            ":descripcion" => $_params['descripcion'],
            ":foto" => $_params['foto'],
            ":precio" => $_params['precio'],
            ":categoria_id" => $_params['categoria_id'],
            ":fecha" => $_params['fecha'],
        );

        // Si la consulta se ejecuta correctamente, devuelvo true, indicando que el producto fue registrado
        if ($resultado->execute($_array))
            return true;

        // Si algo sale mal, devuelvo false
        return false;
    }

    // Función para actualizar los datos de un producto existente
    public function actualizar($_params){
        // Preparo la consulta SQL para actualizar un producto específico
        $sql = "UPDATE `productos` SET `titulo`=:titulo,`descripcion`=:descripcion,`foto`=:foto,`precio`=:precio,`categoria_id`=:categoria_id,`fecha`=:fecha  WHERE `id`=:id";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Asigno los parámetros de la consulta con los valores que recibo
        $_array = array(
            ":titulo" => $_params['titulo'],
            ":descripcion" => $_params['descripcion'],
            ":foto" => $_params['foto'],
            ":precio" => $_params['precio'],
            ":categoria_id" => $_params['categoria_id'],
            ":fecha" => $_params['fecha'],
            ":id" =>  $_params['id'] // Añado el ID para actualizar el producto correcto
        );

        // Si la consulta se ejecuta correctamente, devuelvo true, indicando que el producto fue actualizado
        if ($resultado->execute($_array))
            return true;

        // Si algo sale mal, devuelvo false
        return false;
    }

    // Función para eliminar un producto de la base de datos
    public function eliminar($id){
        // Preparo la consulta SQL para eliminar un producto por su ID
        $sql = "DELETE FROM `productos` WHERE `id`=:id ";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Asigno el ID del producto que quiero eliminar
        $_array = array(
            ":id" =>  $id
        );

        // Si la consulta se ejecuta correctamente, devuelvo true, indicando que el producto fue eliminado
        if ($resultado->execute($_array))
            return true;

        // Si algo sale mal, devuelvo false
        return false;
    }

    // Función para mostrar todos los productos con sus categorías
    public function mostrar(){
        // Preparo la consulta SQL para obtener todos los productos con la información de sus categorías
        $sql = "SELECT productos.id, titulo, descripcion, foto, nombre, precio, fecha, estado FROM productos 
        INNER JOIN categorias
        ON productos.categoria_id = categorias.id ORDER BY productos.id DESC";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Si la consulta se ejecuta correctamente, devuelvo todos los productos
        if ($resultado->execute())
            return $resultado->fetchAll();

        // Si algo sale mal, devuelvo false
        return false;
    }

    // Función para mostrar un producto específico por su ID
    public function mostrarPorId($id){
        // Preparo la consulta SQL para obtener un producto por su ID
        $sql = "SELECT * FROM `productos` WHERE `id`=:id ";

        // Preparo la consulta en PDO
        $resultado = $this->cn->prepare($sql);

        // Asigno el ID del producto que quiero mostrar
        $_array = array(
            ":id" =>  $id
        );

        // Si la consulta se ejecuta correctamente, devuelvo el producto encontrado
        if ($resultado->execute($_array))
            return $resultado->fetch();

        // Si algo sale mal, devuelvo false
        return false;
    }
}



